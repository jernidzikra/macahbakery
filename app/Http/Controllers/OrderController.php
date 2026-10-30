<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Riwayat & status pesanan milik pelanggan yang sedang login.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user->id_pelanggan) {
            $pesanans = collect();
        } else {
            $pesanans = Pesanan::with(['detailPesanan', 'pembayaran'])
                ->where('id_pelanggan', $user->id_pelanggan)
                ->orderByDesc('tgl_pesanan')
                ->orderByDesc('id_pesanan')
                ->paginate(10);
        }

        return view('orders.index', compact('pesanans'));
    }

    /**
     * Detail satu pesanan milik pelanggan (status, item, & pembayaran).
     * Pelanggan hanya bisa melihat pesanan miliknya sendiri.
     */
    public function show($id)
    {
        $user = Auth::user();

        $pesanan = Pesanan::with(['detailPesanan.produk', 'pembayaran', 'komplain'])
            ->where('id_pesanan', $id)
            ->where('id_pelanggan', $user->id_pelanggan)
            ->firstOrFail();

        return view('orders.show', compact('pesanan'));
    }

    /**
     * Upload / ganti bukti transfer untuk pesanan yang pembayarannya masih menunggu.
     */
    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        $pesanan = Pesanan::with('pembayaran')
            ->where('id_pesanan', $id)
            ->where('id_pelanggan', $user->id_pelanggan)
            ->firstOrFail();

        if (!$pesanan->pembayaran) {
            return back()->with('error', 'Data pembayaran untuk pesanan ini tidak ditemukan.');
        }

        $filename = 'bukti-' . time() . '-' . uniqid() . '.' . $request->file('bukti_bayar')->getClientOriginalExtension();
        $request->file('bukti_bayar')->move(public_path('images/bukti_bayar'), $filename);

        $pesanan->pembayaran->bukti_bayar = 'images/bukti_bayar/' . $filename;
        $pesanan->pembayaran->save();

        return back()->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu konfirmasi admin.');
    }
}
