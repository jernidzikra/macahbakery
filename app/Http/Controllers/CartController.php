<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Update cart count di session
     */
    private function updateCartCount()
    {
        $cart = session()->get('cart', []);
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['jumlah'];
        }
        session()->put('cart_count', $count);
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|string',
            'jumlah' => 'nullable|integer|min:1'
        ]);

        $product = Produk::find($request->id_produk);

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan!');
        }

        $cart = session()->get('cart', []);
        $jumlah = $request->jumlah ?? 1;

        if (isset($cart[$product->id_produk])) {
            $cart[$product->id_produk]['jumlah'] += $jumlah;
        } else {
            $cart[$product->id_produk] = [
                'id_produk' => $product->id_produk,
                'nama_produk' => $product->nama_produk,
                'harga' => $product->harga_produk,
                'jumlah' => $jumlah,
                'foto' => $product->foto_produk
            ];
        }

        session()->put('cart', $cart);
        $this->updateCartCount();

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['jumlah'] = $request->jumlah;
            session()->put('cart', $cart);
            $this->updateCartCount();
        }

        return redirect()->back();
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            $this->updateCartCount();
        }

        return redirect()->back();
    }

    public function clear()
    {
        session()->forget('cart');
        session()->forget('cart_count');
        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan!');
    }
}