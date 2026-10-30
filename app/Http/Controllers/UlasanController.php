<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function index()
    {
        $ulasans = Ulasan::with(['produk', 'pelanggan'])
                        ->orderBy('tgl_ulasan', 'desc')
                        ->paginate(10);
        
        $avgRating = Ulasan::avg('rating') ?? 0;
        $totalUlasan = Ulasan::count();
        
        $ratings = [
            5 => Ulasan::where('rating', 5)->count(),
            4 => Ulasan::where('rating', 4)->count(),
            3 => Ulasan::where('rating', 3)->count(),
            2 => Ulasan::where('rating', 2)->count(),
            1 => Ulasan::where('rating', 1)->count(),
        ];
        
        // Ambil SEMUA produk untuk dropdown (tanpa harus beli)
        $produks = Produk::orderBy('nama_produk')->get();
        
        return view('ulasan.index', compact('ulasans', 'avgRating', 'totalUlasan', 'ratings', 'produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|string|exists:produk,id_produk',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:500'
        ]);

        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Silakan login terlebih dahulu!');
        }

        $idPelanggan = Auth::id();
        $idProduk = $request->id_produk;

        // CEK APAKAH SUDAH PERNAH REVIEW
        $existing = Ulasan::where('id_produk', $idProduk)
                         ->where('id_pelanggan', $idPelanggan)
                         ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Anda sudah pernah memberikan ulasan untuk produk ini!');
        }

        Ulasan::create([
            'id_ulasan' => 'UL' . str_pad(Ulasan::count() + 1, 3, '0', STR_PAD_LEFT),
            'id_pesanan' => 'PES' . str_pad(1, 3, '0', STR_PAD_LEFT),
            'id_produk' => $idProduk,
            'id_pelanggan' => $idPelanggan,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
            'tgl_ulasan' => date('Y-m-d')
        ]);

        return redirect()->back()->with('success', 'Terima kasih atas ulasannya!');
    }
}