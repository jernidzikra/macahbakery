@extends('admin.layouts.app')

@section('title', 'Detail Pelanggan')
@section('page-title', 'Detail Pelanggan')

@section('content')

<a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Pelanggan
</a>

<div class="row g-3 mb-3">
    <div class="col-lg-4">
        <div class="card-panel p-4 h-100">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="stat-icon" style="background:#C9943A; margin:0;"><i class="fas fa-user"></i></div>
                <div>
                    <div class="fw-bold fs-5">{{ $pelanggan->nama_pelanggan }}</div>
                    <div class="text-muted small">{{ $pelanggan->id_pelanggan }}</div>
                </div>
            </div>
            <hr>
            <p class="mb-2 small"><i class="fas fa-map-marker-alt me-2 text-muted"></i>{{ $pelanggan->alamat ?: '-' }}</p>
            <p class="mb-2 small"><i class="fas fa-phone me-2 text-muted"></i>{{ $pelanggan->no_telp ?: '-' }}</p>
            <p class="mb-0 small"><i class="fas fa-tag me-2 text-muted"></i>Tipe: {{ $pelanggan->tipe_pelanggan ?: 'regular' }}</p>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="row g-3 h-100">
            <div class="col-6">
                <div class="stat-card">
                    <div class="stat-icon" style="background:#8B4513;"><i class="fas fa-receipt"></i></div>
                    <div class="stat-value">{{ $pesanans->count() }}</div>
                    <div class="stat-label">Total Pesanan</div>
                </div>
            </div>
            <div class="col-6">
                <div class="stat-card">
                    <div class="stat-icon" style="background:#4CAF50;"><i class="fas fa-sack-dollar"></i></div>
                    <div class="stat-value">Rp{{ number_format($pesanans->sum('total'), 0, ',', '.') }}</div>
                    <div class="stat-label">Total Belanja</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card-panel">
    <div class="card-panel-header">
        <span><i class="fas fa-receipt me-2" style="color:#C9943A;"></i>Riwayat Pesanan</span>
    </div>
    <div class="accordion accordion-flush" id="orderAccordion">
        @forelse ($pesanans as $pesanan)
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#order-{{ $pesanan->id_pesanan }}">
                    <div class="d-flex justify-content-between align-items-center w-100 me-3 flex-wrap gap-2">
                        <span class="fw-semibold">{{ $pesanan->id_pesanan }}</span>
                        <span class="text-muted small">{{ \Carbon\Carbon::parse($pesanan->tgl_pesanan)->translatedFormat('d M Y') }}</span>
                        <span class="fw-semibold">Rp{{ number_format($pesanan->total, 0, ',', '.') }}</span>
                        <span class="badge-status badge-{{ $pesanan->status_pesanan }}">{{ ucfirst($pesanan->status_pesanan) }}</span>
                    </div>
                </button>
            </h2>
            <div id="order-{{ $pesanan->id_pesanan }}" class="accordion-collapse collapse" data-bs-parent="#orderAccordion">
                <div class="accordion-body">
                    <p class="small mb-2"><i class="fas fa-truck me-2 text-muted"></i>Dikirim ke: {{ $pesanan->alamat_pengiriman ?: '-' }}</p>
                    <table class="table table-sm mb-2">
                        <thead>
                            <tr><th>Produk</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th></tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan->detailPesanan as $item)
                            <tr>
                                <td>{{ $item->produk->nama_produk ?? $item->id_produk }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($item->jumlah * $item->harga, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('admin.orders.show', $pesanan->id_pesanan) }}" class="btn btn-sm btn-gold">
                        <i class="fas fa-arrow-up-right-from-square me-1"></i> Kelola Pesanan Ini
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center text-muted py-4">Pelanggan ini belum pernah memesan.</div>
        @endforelse
    </div>
</div>

@endsection
