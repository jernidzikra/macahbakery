@extends('admin.layouts.app')

@section('title', 'Pelanggan')
@section('page-title', 'Daftar Pelanggan')

@section('content')

<div class="card-panel">
    <div class="card-panel-header">
        <span><i class="fas fa-users me-2" style="color:#C9943A;"></i>Semua Pelanggan</span>
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari nama / ID / no. telp..." style="min-width:230px;">
            <button class="btn btn-sm btn-gold"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-admin mb-0">
            <thead>
                <tr>
                    <th class="ps-3">ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Tipe</th>
                    <th>Jumlah Pesanan</th>
                    <th>Total Belanja</th>
                    <th class="text-end pe-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pelanggans as $pelanggan)
                <tr>
                    <td class="ps-3 fw-semibold">{{ $pelanggan->id_pelanggan }}</td>
                    <td>{{ $pelanggan->nama_pelanggan }}</td>
                    <td class="text-muted small">{{ \Illuminate\Support\Str::limit($pelanggan->alamat, 40) ?: '-' }}</td>
                    <td>{{ $pelanggan->no_telp ?: '-' }}</td>
                    <td><span class="badge bg-light text-dark border">{{ $pelanggan->tipe_pelanggan ?: 'regular' }}</span></td>
                    <td>{{ $pelanggan->pesanan_count }}</td>
                    <td>Rp{{ number_format($pelanggan->total_belanja ?? 0, 0, ',', '.') }}</td>
                    <td class="text-end pe-3">
                        <a href="{{ route('admin.customers.show', $pelanggan->id_pelanggan) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-4">Belum ada data pelanggan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($pelanggans->hasPages())
    <div class="p-3 border-top">
        {{ $pelanggans->links() }}
    </div>
    @endif
</div>

@endsection
