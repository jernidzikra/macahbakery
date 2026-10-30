<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan ringkasan / statistik untuk dashboard admin.
     */
    public function index()
    {
        $totalPelanggan = Pelanggan::count();
        $totalProduk = Produk::count();
        $totalPesanan = Pesanan::count();
        $pesananPending = Pesanan::where('status_pesanan', 'pending')->count();

        $totalPendapatan = Pesanan::where('status_pesanan', 'selesai')->sum('total');

        $pesananTerbaru = Pesanan::with('pelanggan')
            ->orderByDesc('tgl_pesanan')
            ->orderByDesc('id_pesanan')
            ->limit(8)
            ->get();

        $produkStokMenipis = Produk::orderBy('stok_produk', 'asc')
            ->limit(5)
            ->get();

        $statusPesananCount = Pesanan::selectRaw('status_pesanan, count(*) as jumlah')
            ->groupBy('status_pesanan')
            ->pluck('jumlah', 'status_pesanan');

        return view('admin.dashboard', compact(
            'totalPelanggan',
            'totalProduk',
            'totalPesanan',
            'pesananPending',
            'totalPendapatan',
            'pesananTerbaru',
            'produkStokMenipis',
            'statusPesananCount'
        ));
    }
}
