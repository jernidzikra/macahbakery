@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#C9943A;"><i class="fas fa-users"></i></div>
            <div class="stat-value">{{ $totalPelanggan }}</div>
            <div class="stat-label">Total Pelanggan</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#8B4513;"><i class="fas fa-receipt"></i></div>
            <div class="stat-value">{{ $totalPesanan }}</div>
            <div class="stat-label">Total Pesanan</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#5C2E0A;"><i class="fas fa-box-open"></i></div>
            <div class="stat-value">{{ $totalProduk }}</div>
            <div class="stat-label">Total Produk</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#4CAF50;"><i class="fas fa-sack-dollar"></i></div>
            <div class="stat-value">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            <div class="stat-label">Pendapatan (Selesai)</div>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-lg-6">
        <div class="card-panel h-100">
            <div class="card-panel-header">
                <span><i class="fas fa-chart-pie me-2" style="color:#C9943A;"></i>Status Pesanan</span>
            </div>
            <div class="p-3">
                @php
                    $statuses = ['pending' => 'Pending', 'diproses' => 'Diproses', 'dikirim' => 'Dikirim', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'];
                @endphp
                @foreach ($statuses as $key => $label)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge-status badge-{{ $key }}">{{ $label }}</span>
                        <span class="fw-semibold">{{ $statusPesananCount[$key] ?? 0 }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card-panel h-100">
            <div class="card-panel-header">
                <span><i class="fas fa-triangle-exclamation me-2" style="color:#C9943A;"></i>Stok Menipis</span>
                <a href="{{ route('admin.products.index') }}" class="small text-decoration-none">Kelola <i class="fas fa-arrow-right"></i></a>
            </div>
            <ul class="list-group list-group-flush">
                @forelse ($produkStokMenipis as $produk)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="small">{{ $produk->nama_produk }}</span>
                        <span class="badge {{ $produk->stok_produk <= 10 ? 'bg-danger' : 'bg-secondary' }}">{{ $produk->stok_produk }} pcs</span>
                    </li>
                @empty
                    <li class="list-group-item text-muted small text-center py-3">Belum ada data produk.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-12">
        <div class="card-panel">
            <div class="card-panel-header">
                <span><i class="fas fa-clock-rotate-left me-2" style="color:#C9943A;"></i>Pesanan Terbaru</span>
                <a href="{{ route('admin.orders.index') }}" class="small text-decoration-none">Lihat semua <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="table-responsive">
                <table class="table table-admin mb-0">
                    <thead>
                        <tr>
                            <th class="ps-3">ID Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pesananTerbaru as $pesanan)
                        <tr>
                            <td class="ps-3">
                                <a href="{{ route('admin.orders.show', $pesanan->id_pesanan) }}" class="text-decoration-none fw-semibold">
                                    {{ $pesanan->id_pesanan }}
                                </a>
                            </td>
                            <td>{{ $pesanan->pelanggan->nama_pelanggan ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($pesanan->tgl_pesanan)->translatedFormat('d M Y') }}</td>
                            <td>Rp{{ number_format($pesanan->total, 0, ',', '.') }}</td>
                            <td><span class="badge-status badge-{{ $pesanan->status_pesanan }}">{{ ucfirst($pesanan->status_pesanan) }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada pesanan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection