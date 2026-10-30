<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Produk Terlaris (berdasarkan terjual)
        $bestSellers = Produk::orderBy('terjual', 'desc')->limit(5)->get();
        
        // Produk untuk setiap kategori (masing-masing 4)
        $kategoriProduk = [
            'Roti' => Produk::where('kategori', 'Puff pastry')->limit(4)->get(),
            'Cake' => Produk::where('kategori', 'Kue')->limit(4)->get(),
            'Brownies' => Produk::where('kategori', 'Brownies')->limit(4)->get(),
            'Bolu Tape' => Produk::where('kategori', 'Kue')->where('nama_produk', 'like', '%tape%')->limit(4)->get(),
            'Hampers' => Produk::where('kategori', 'Hampers')->limit(4)->get(),
            'Kue Kering' => Produk::where('kategori', 'Cemilan KS')->limit(4)->get(),
        ];
        
        // Testimoni/Ulasan
        $testimonials = Ulasan::with(['pelanggan', 'produk'])
                            ->orderBy('tgl_ulasan', 'desc')
                            ->limit(6)
                            ->get();
        
        // Produk promo (diskon random)
        $promoProducts = Produk::inRandomOrder()->limit(4)->get();
        
        return view('home', compact('bestSellers', 'kategoriProduk', 'testimonials', 'promoProducts'));
    }

    public function about()
    {
        $locations = [
            [
                'nama' => 'Macah Bakery - Pasir Kaliki',
                'alamat' => 'Jl. H. Akbar No.4, Pasir Kaliki, Bandung 40173',
                'lat' => -6.9175,
                'lng' => 107.6191,
                'jam' => '08.00 - 21.00 WIB',
                'telepon' => '(022) 1234567',
                'foto' => 'https://placehold.co/600x400/F5E6D3/8B4513?text=Pasir+Kaliki'
            ],
            [
                'nama' => 'Macah Bakery - Dago',
                'alamat' => 'Jl. Ir. H. Djuanda No. 85-87, Dago, Bandung 40135',
                'lat' => -6.8934,
                'lng' => 107.6138,
                'jam' => '08.00 - 21.00 WIB',
                'telepon' => '(022) 3456789',
                'foto' => 'https://placehold.co/600x400/F5E6D3/8B4513?text=Dago'
            ],
            [
                'nama' => 'Macah Bakery - Buah Batu',
                'alamat' => 'Jl. Buah Batu No. 165 A, Bandung 40283',
                'lat' => -6.9394,
                'lng' => 107.6370,
                'jam' => '08.00 - 21.00 WIB',
                'telepon' => '(022) 4567890',
                'foto' => 'https://placehold.co/600x400/F5E6D3/8B4513?text=Buah+Batu'
            ],
        ];
        
        return view('about', compact('locations'));
    }
}