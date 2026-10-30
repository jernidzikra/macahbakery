@extends('admin.layouts.app')

@section('title', 'Pesanan')
@section('page-title', 'Kelola Pesanan')

@section('content')

<div class="card-panel">
    <div class="card-panel-header d-flex align-items-center justify-content-between gap-3 flex-nowrap">
        <span class="text-nowrap"><i class="fas fa-receipt me-2" style="color:#C9943A;"></i>Semua Pesanan</span>

        <form method="GET" class="d-flex align-items-center gap-2 flex-nowrap ms-auto">
            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="min-width:160px;">
                <option value="">Semua Status</option>
                @foreach (['pending','diproses','dikirim','selesai','dibatalkan'] as $status)
                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari ID / nama pelanggan..." style="min-width:220px;">
            <button class="btn btn-sm btn-gold flex-shrink-0"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <style>
        /* Tetap rapi di layar sempit tanpa turun berantakan */
        @media (max-width: 767.98px) {
            .card-panel-header.flex-nowrap {
                flex-wrap: wrap !important;
            }
            .card-panel-header form.ms-auto {
                width: 100%;
                margin-left: 0 !important;
            }
            .card-panel-header form .form-select,
            .card-panel-header form .form-control {
                min-width: 0;
                flex: 1 1 auto;
            }
        }
    </style>
    <div class="table-responsive">
        <table class="table table-admin mb-0">
            <thead>
                <tr>
                    <th class="ps-3">ID Pesanan</th>
                    <th>Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Jumlah Item</th>
                    <th>Total</th>
                    <th>Status Pesanan</th>
                    <th>Pembayaran</th>
                    <th class="text-end pe-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pesanans as $pesanan)
                <tr>
                    <td class="ps-3 fw-semibold">{{ $pesanan->id_pesanan }}</td>
                    <td>{{ $pesanan->pelanggan->nama_pelanggan ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($pesanan->tgl_pesanan)->translatedFormat('d M Y') }}</td>
                    <td>{{ $pesanan->detailPesanan->sum('jumlah') }} pcs</td>
                    <td>Rp{{ number_format($pesanan->total, 0, ',', '.') }}</td>
                    <td><span class="badge-status badge-{{ $pesanan->status_pesanan }}">{{ ucfirst($pesanan->status_pesanan) }}</span></td>
                    <td>
                        @if ($pesanan->pembayaran)
                            <span class="badge-status badge-{{ $pesanan->pembayaran->status_pembayaran }}">{{ ucfirst($pesanan->pembayaran->status_pembayaran) }}</span>
                        @else
                            <span class="badge-status badge-dibatalkan">Belum Bayar</span>
                        @endif
                    </td>
                    <td class="text-end pe-3">
                        <a href="{{ route('admin.orders.show', $pesanan->id_pesanan) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-4">Belum ada pesanan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($pesanans->hasPages())
    <div class="p-3 border-top">
        {{ $pesanans->links() }}
    </div>
    @endif
</div>

@endsection