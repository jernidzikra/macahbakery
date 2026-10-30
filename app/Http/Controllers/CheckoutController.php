<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Pembayaran;
use App\Models\Pelanggan;
use App\Models\Admin;
use App\Models\Produk;
use App\Models\Notification; // <-- TAMBAHKAN INI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Daftar metode pembayaran yang tersedia.
     */
    public const METODE_BAYAR = [
        'Transfer Bank BCA',
        'Transfer Bank Mandiri',
        'QRIS',
        'COD (Bayar di Tempat)',
    ];

    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Keranjang belanja kosong!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }

        $metodeBayar = self::METODE_BAYAR;

        return view('checkout.index', compact('cart', 'total', 'metodeBayar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
            'catatan' => 'nullable|string|max:500',
            'metode_bayar' => 'required|in:' . implode(',', self::METODE_BAYAR),
            'bukti_bayar' => 'nullable|image|max:2048',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Keranjang belanja kosong!');
        }

        $user = Auth::user();

        // Pastikan akun user ini selalu terhubung ke id_pelanggan yang sama
        $pelanggan = $user->getOrCreatePelanggan([
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp ?? $user->pelanggan?->no_telp,
        ]);
        $idPelanggan = $pelanggan->id_pelanggan;

        // Hitung total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }

        // Cari admin atau buat baru (pemilik toko default)
        $admin = Admin::first();
        if (!$admin) {
            $admin = Admin::create([
                'id_admin' => 'ADM001',
                'nama_admin' => 'Admin Macah',
                'username' => 'admin',
                'password' => bcrypt('password'),
                'no_telp' => '0812-1122-1984',
            ]);
        }

        // Buat pesanan
        $idPesanan = 'PSN' . str_pad(Pesanan::count() + 1, 3, '0', STR_PAD_LEFT);
        while (Pesanan::find($idPesanan)) {
            $idPesanan = 'PSN' . str_pad((int) substr($idPesanan, 3) + 1, 3, '0', STR_PAD_LEFT);
        }

        $pesanan = Pesanan::create([
            'id_pesanan' => $idPesanan,
            'id_pelanggan' => $idPelanggan,
            'id_admin' => $admin->id_admin,
            'tgl_pesanan' => date('Y-m-d'),
            'alamat_pengiriman' => $request->alamat,
            'total' => $total,
            'status_pesanan' => 'pending',
        ]);

        // Buat detail pesanan
        foreach ($cart as $item) {
            DetailPesanan::create([
                'id_pesanan' => $idPesanan,
                'id_produk' => $item['id_produk'],
                'jumlah' => $item['jumlah'],
                'harga' => $item['harga'],
            ]);
        }

        // Upload bukti pembayaran kalau ada
        $buktiBayar = null;
        if ($request->hasFile('bukti_bayar')) {
            $buktiBayar = $this->uploadBukti($request->file('bukti_bayar'));
        }

        // Buat record pembayaran.
        // Semua metode berstatus 'menunggu' sampai dikonfirmasi diterima oleh admin.
        $idPembayaran = 'PAY' . str_pad(Pembayaran::count() + 1, 3, '0', STR_PAD_LEFT);
        while (Pembayaran::find($idPembayaran)) {
            $idPembayaran = 'PAY' . str_pad((int) substr($idPembayaran, 3) + 1, 3, '0', STR_PAD_LEFT);
        }

        Pembayaran::create([
            'id_pembayaran' => $idPembayaran,
            'id_pesanan' => $idPesanan,
            'tgl_bayar' => date('Y-m-d'),
            'metode_bayar' => $request->metode_bayar,
            'jumlah_bayar' => $total,
            'bukti_bayar' => $buktiBayar,
            'status_pembayaran' => 'menunggu',
        ]);

        // ============================================================
        // ===== KIRIM NOTIFIKASI KE ADMIN =====
        // ============================================================
        $this->sendNotification(
            'Pesanan Baru #' . $idPesanan,
            'Ada pesanan baru dari ' . $user->name . ' dengan total Rp ' . number_format($total, 0, ',', '.'),
            'pesanan',
            route('admin.orders.show', $idPesanan),
            $idPesanan
        );

        // Kosongkan keranjang
        session()->forget('cart');
        session()->forget('cart_count');

        return redirect()->route('orders.show', $idPesanan)
            ->with('success', 'Pesanan berhasil dibuat! ID Pesanan: ' . $idPesanan . '. Silakan pantau status pesanan dan pembayaran Anda di sini.');
    }

    private function uploadBukti($file): string
    {
        $filename = 'bukti-' . time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/bukti_bayar'), $filename);

        return 'images/bukti_bayar/' . $filename;
    }

    // ============================================================
    // ===== FUNGSI NOTIFIKASI =====
    // ============================================================

    /**
     * Kirim notifikasi ke admin
     */
    private function sendNotification($title, $message, $type = 'pesanan', $link = null, $orderId = null)
    {
        Notification::create([
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'link' => $link,
            'order_id' => $orderId,
            'is_read' => false,
        ]);
    }

    /**
     * Ambil notifikasi yang belum dibaca (untuk AJAX)
     */
    public function getNotifications()
    {
        $notifications = Notification::where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        $count = Notification::where('is_read', false)->count();

        return response()->json([
            'notifications' => $notifications,
            'count' => $count
        ]);
    }

    /**
     * Tandai notifikasi sudah dibaca
     */
    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        if ($notification) {
            $notification->update(['is_read' => true]);
        }
        return response()->json(['success' => true]);
    }

    /**
     * Tandai semua notifikasi sudah dibaca
     */
    public function markAllAsRead()
    {
        Notification::where('is_read', false)->update(['is_read' => true]);
        return redirect()->back()->with('success', 'Semua notifikasi telah dibaca');
    }
}