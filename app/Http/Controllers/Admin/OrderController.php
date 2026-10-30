<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Daftar semua pesanan pelanggan, bisa difilter berdasarkan status/pencarian.
     */
    public function index(Request $request)
    {
        $query = Pesanan::with('pelanggan', 'detailPesanan', 'pembayaran');

        if ($request->filled('status')) {
            $query->where('status_pesanan', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id_pesanan', 'like', "%{$search}%")
                    ->orWhereHas('pelanggan', function ($qq) use ($search) {
                        $qq->where('nama_pelanggan', 'like', "%{$search}%");
                    });
            });
        }

        $pesanans = $query->orderByDesc('tgl_pesanan')
            ->orderByDesc('id_pesanan')
            ->paginate(10)
            ->withQueryString();

        return view('admin.orders.index', compact('pesanans'));
    }

    /**
     * Detail satu pesanan lengkap dengan item produk, pembayaran, dan komplain.
     */
    public function show($id)
    {
        $pesanan = Pesanan::with(['pelanggan', 'detailPesanan.produk', 'pembayaran', 'komplain'])
            ->findOrFail($id);

        return view('admin.orders.show', compact('pesanan'));
    }

    /**
     * Perbarui status pesanan (pending, diproses, dikirim, selesai, dibatalkan).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_pesanan' => 'required|in:pending,diproses,dikirim,selesai,dibatalkan',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status_pesanan = $request->status_pesanan;
        $pesanan->save();

        return back()->with('success', 'Status pesanan ' . $pesanan->id_pesanan . ' berhasil diperbarui.');
    }

    /**
     * Perbarui status pembayaran pesanan (menunggu, lunas, gagal).
     * Dipakai admin untuk mengonfirmasi pembayaran yang sudah diterima.
     */
    public function updatePayment(Request $request, $id)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:menunggu,lunas,gagal',
        ]);

        $pesanan = Pesanan::with('pembayaran')->findOrFail($id);

        $pembayaran = $pesanan->pembayaran;

        // Jaga-jaga kalau pesanan lama belum punya record pembayaran
        if (!$pembayaran) {
            $idPembayaran = 'PAY' . str_pad(Pembayaran::count() + 1, 3, '0', STR_PAD_LEFT);
            while (Pembayaran::find($idPembayaran)) {
                $idPembayaran = 'PAY' . str_pad((int) substr($idPembayaran, 3) + 1, 3, '0', STR_PAD_LEFT);
            }

            $pembayaran = Pembayaran::create([
                'id_pembayaran' => $idPembayaran,
                'id_pesanan' => $pesanan->id_pesanan,
                'tgl_bayar' => date('Y-m-d'),
                'metode_bayar' => 'Tidak diketahui',
                'jumlah_bayar' => $pesanan->total,
                'status_pembayaran' => 'menunggu',
            ]);
        }

        $pembayaran->status_pembayaran = $request->status_pembayaran;
        $pembayaran->tgl_bayar = date('Y-m-d');
        $pembayaran->save();

        return back()->with('success', 'Status pembayaran pesanan ' . $pesanan->id_pesanan . ' berhasil diperbarui.');
    }

    /**
     * Hapus pesanan (beserta detail pesanannya yang otomatis terhapus lewat cascade).
     */
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
