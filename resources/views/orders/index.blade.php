@extends('layouts.app')

@section('title', 'Pesanan Saya - Macah Bakery')

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-1" style="color: #5C2E0A;">📋 Pesanan Saya</h1>
    <p class="text-center text-muted mb-4">Pantau status pesanan dan pembayaran Anda di sini</p>

    @if (session('success'))
    <div class="alert alert-success rounded-4">{{ session('success') }}</div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger rounded-4">{{ session('error') }}</div>
    @endif

    @forelse ($pesanans as $pesanan)
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-3">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
            <div>
                <h6 class="mb-1 fw-bold" style="color:#5C2E0A;">{{ $pesanan->id_pesanan }}</h6>
                <p class="mb-1 small text-muted">
                    <i class="fas fa-calendar me-1"></i> {{ \Carbon\Carbon::parse($pesanan->tgl_pesanan)->translatedFormat('d M Y') }}
                    &nbsp;•&nbsp; {{ $pesanan->detailPesanan->sum('jumlah') }} pcs
                </p>
                <span class="badge-status badge-{{ $pesanan->status_pesanan }}">{{ ucfirst($pesanan->status_pesanan) }}</span>
                @if ($pesanan->pembayaran)
                <span class="badge-status badge-{{ $pesanan->pembayaran->status_pembayaran }}">
                    <i class="fas fa-wallet me-1"></i>{{ ucfirst($pesanan->pembayaran->status_pembayaran) }}
                </span>
                @endif
            </div>
            <div class="text-end">
                <p class="mb-2 fw-bold" style="color:#C9943A; font-size:1.1rem;">Rp{{ number_format($pesanan->total, 0, ',', '.') }}</p>
                <a href="{{ route('orders.show', $pesanan->id_pesanan) }}" class="btn btn-sm" style="background:#C9943A; color:#fff; border-radius:20px;">
                    Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-5">
        <i class="fas fa-box-open fa-3x mb-3" style="color:#C9943A;"></i>
        <p class="text-muted mb-3">Anda belum memiliki pesanan.</p>
        <a href="/products" class="btn" style="background:#C9943A; color:#fff; border-radius:20px; padding:10px 24px;">Mulai Belanja</a>
    </div>
    @endforelse

    @if (method_exists($pesanans, 'hasPages') && $pesanans->hasPages())
    <div class="mt-3">{{ $pesanans->links() }}</div>
    @endif
</div>
@endsection
