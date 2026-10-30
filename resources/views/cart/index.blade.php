@extends('layouts.app')

@section('title', 'Keranjang Belanja - Macah Bakery')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-lg-8">
            <!-- HEADER -->
            <h2 style="color: #5C2E0A; font-weight: 700; margin-bottom: 20px;">🛒 Keranjang Belanja</h2>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(empty($cart))
            <!-- KERANJANG KOSONG -->
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-4x text-muted"></i>
                <h3 class="mt-3" style="color: #5D4037;">Keranjang Kosong</h3>
                <p class="text-muted">Yuk, mulai belanja!</p>
                <a href="/products" class="btn" style="background: #C9943A; color: #fff; border-radius: 30px; padding: 10px 30px;">
                    <i class="fas fa-shopping-bag me-2"></i> Belanja Sekarang
                </a>
            </div>
            @else
            <!-- LIST ITEMS -->
            @foreach($cart as $id => $item)
            <div class="card border-0 shadow-sm rounded-3 mb-3 p-3">
                <div class="row align-items-center">
                    <div class="col-3 col-md-2">
                        <img src="{{ $item['foto'] ? asset($item['foto']) : 'https://placehold.co/80x80/F5E6D3/8B4513' }}" 
                             alt="{{ $item['nama_produk'] }}" 
                             style="width: 100%; height: 80px; object-fit: cover; border-radius: 8px;">
                    </div>
                    <div class="col-5 col-md-5">
                        <h6 style="color: #5D4037; font-weight: 600; margin-bottom: 2px;">{{ $item['nama_produk'] }}</h6>
                        <div style="font-size: 13px; color: #C9943A; font-weight: 600;">
                            Rp {{ number_format($item['harga'], 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <form action="/cart/update/{{ $id }}" method="POST" class="d-flex align-items-center gap-2">
                            @csrf
                            @method('PUT')
                            <label class="small text-muted me-1">Qty:</label>
                            <input type="number" name="jumlah" value="{{ $item['jumlah'] }}" min="1" 
                                   class="form-control form-control-sm" style="width: 60px; text-align: center;">
                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-12 col-md-2 text-end mt-2 mt-md-0">
                        <form action="/cart/remove/{{ $id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- CLEAR CART -->
            <div class="text-end mt-2">
                <form action="/cart/clear" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-trash-alt me-1"></i> Kosongkan Keranjang
                    </button>
                </form>
            </div>
            @endif
        </div>

        <!-- ===== SIDEBAR KANAN: ORDER SUMMARY ===== -->
        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm rounded-3 p-4" style="position: sticky; top: 80px;">
                <h5 style="color: #5C2E0A; font-weight: 700; margin-bottom: 20px;">Order Summary</h5>

                @if(!empty($cart))
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Subtotal ({{ count($cart) }} Products)</span>
                    <span class="fw-bold" style="color: #5D4037;">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <span style="font-weight: 600; color: #5C2E0A;">Total</span>
                    <span style="font-size: 1.3rem; font-weight: 700; color: #C9943A;">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <!-- TOMBOL CHECKOUT (CEK LOGIN) -->
                @auth
                    <a href="/checkout" class="btn w-100" style="background: #C9943A; color: #fff; border-radius: 30px; padding: 12px; font-weight: 600;">
                        <i class="fas fa-check me-2"></i> Checkout
                    </a>
                @else
                    <div class="alert alert-warning alert-sm text-center" role="alert">
                        <i class="fas fa-exclamation-triangle me-1"></i> 
                        Silakan <a href="/login" style="color: #C9943A; font-weight: 600;">Login</a> untuk checkout
                    </div>
                    <a href="/login" class="btn w-100" style="background: #C9943A; color: #fff; border-radius: 30px; padding: 12px; font-weight: 600;">
                        <i class="fas fa-sign-in-alt me-2"></i> Login untuk Checkout
                    </a>
                @endauth

                <!-- CATATAN -->
                <div class="mt-3">
                    <label class="small text-muted">Catatan:</label>
                    <textarea class="form-control form-control-sm" rows="2" placeholder="Tambah catatan..." style="border-radius: 8px;"></textarea>
                </div>

                <div class="mt-3 p-2" style="background: #FDF6EE; border-radius: 8px;">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1" style="color: #C9943A;"></i>
                        Jika anda memesan untuk orang lain, beritahu kami dengan menuliskan NAMA PENGIRIM pada catatan.
                    </small>
                </div>

                @else
                <div class="text-center py-4">
                    <i class="fas fa-shopping-bag fa-3x text-muted"></i>
                    <p class="text-muted mt-2">Keranjang kosong</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection