<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Daftar semua pelanggan beserta ringkasan jumlah & total pesanan mereka.
     */
    public function index(Request $request)
    {
        $query = Pelanggan::withCount('pesanan')
            ->withSum('pesanan as total_belanja', 'total');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pelanggan', 'like', "%{$search}%")
                    ->orWhere('id_pelanggan', 'like', "%{$search}%")
                    ->orWhere('no_telp', 'like', "%{$search}%");
            });
        }

        $pelanggans = $query->orderBy('nama_pelanggan')->paginate(10)->withQueryString();

        return view('admin.customers.index', compact('pelanggans'));
    }

    /**
     * Detail satu pelanggan beserta seluruh riwayat pesanannya.
     */
    public function show($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $pesanans = Pesanan::with(['detailPesanan.produk', 'pembayaran', 'komplain'])
            ->where('id_pelanggan', $id)
            ->orderByDesc('tgl_pesanan')
            ->orderByDesc('id_pesanan')
            ->get();

        return view('admin.customers.show', compact('pelanggan', 'pesanans'));
    }
}
