<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::query();
        
        // Filter kategori - perbaiki untuk menangani URL encoding
        if ($request->kategori && $request->kategori != 'semua') {
            // Decode URL encoding untuk kategori dengan spasi atau karakter khusus
            $kategori = urldecode($request->kategori);
            $query->where('kategori', $kategori);
        }
        
        // Filter harga
        if ($request->min_price) {
            $query->where('harga_produk', '>=', $request->min_price);
        }
        if ($request->max_price) {
            $query->where('harga_produk', '<=', $request->max_price);
        }
        
        // Sorting
        switch ($request->sort) {
            case 'termurah':
                $query->orderBy('harga_produk', 'asc');
                break;
            case 'termahal':
                $query->orderBy('harga_produk', 'desc');
                break;
            case 'terlaris':
                $query->orderBy('terjual', 'desc');
                break;
            default:
                $query->orderBy('id_produk', 'desc');
                break;
        }
        
        $products = $query->get();
        
        // ===== AMBIL SEMUA KATEGORI =====
        $kategoris = Produk::select('kategori')->distinct()->whereNotNull('kategori')->pluck('kategori');
        
        // ===== HARGA MIN & MAX UNTUK SLIDER =====
        $minHarga = 0;
        $maxHarga = 500000;
        
        return view('products.index', compact('products', 'kategoris', 'minHarga', 'maxHarga'));
    }

    public function show($id)
    {
        // Cek apakah tabel varian_produk ada
        $withRelations = ['ulasan.pelanggan'];
        
        if (Schema::hasTable('varian_produk')) {
            $withRelations[] = 'varian';
        }
        
        $product = Produk::with($withRelations)->findOrFail($id);
        
        // ===== PASTIKAN FOTO_PRODUK PUNYA PATH YANG BENAR =====
        // Kalau foto_produk kosong, pakai placeholder
        if (empty($product->foto_produk)) {
            $product->foto_produk = 'https://placehold.co/600x500/F5E6D3/8B4513?text=' . urlencode($product->nama_produk);
        } else {
            // Cek apakah file ada di server
            $filePath = public_path($product->foto_produk);
            if (!file_exists($filePath)) {
                // Kalau file tidak ada, pakai placeholder
                $product->foto_produk = 'https://placehold.co/600x500/F5E6D3/8B4513?text=' . urlencode($product->nama_produk);
            }
        }
        
        $ratings = [
            'average' => $product->ulasan->avg('rating') ?? 0,
            'total' => $product->ulasan->count(),
            '5star' => $product->ulasan->where('rating', 5)->count(),
            '4star' => $product->ulasan->where('rating', 4)->count(),
            '3star' => $product->ulasan->where('rating', 3)->count(),
            '2star' => $product->ulasan->where('rating', 2)->count(),
            '1star' => $product->ulasan->where('rating', 1)->count(),
        ];
        
        $rekomendasi = Produk::where('id_produk', '!=', $id)
                            ->inRandomOrder()
                            ->limit(4)
                            ->get();
        
        return view('products.show', compact('product', 'ratings', 'rekomendasi'));
    }
}