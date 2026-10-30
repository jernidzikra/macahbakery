@extends('admin.layouts.app')

@section('title', 'Produk')
@section('page-title', 'Kelola Produk')

@section('content')

<div class="card-panel">
    <div class="card-panel-header d-flex align-items-center justify-content-between gap-3 flex-nowrap">
        <span class="text-nowrap"><i class="fas fa-box-open me-2" style="color:#C9943A;"></i>Semua Produk</span>

        <div class="d-flex align-items-center gap-2 flex-nowrap ms-auto">
            <form method="GET" class="d-flex align-items-center gap-2 flex-nowrap">
                <select name="kategori" class="form-select form-select-sm" onchange="this.form.submit()" style="min-width:160px;">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                    @endforeach
                </select>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari produk..." style="min-width:220px;">
                <button class="btn btn-sm btn-outline-secondary flex-shrink-0"><i class="fas fa-search"></i></button>
            </form>

            <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-gold text-nowrap flex-shrink-0">
                <i class="fas fa-plus me-1"></i> Tambah Produk
            </a>
        </div>
    </div>

    <style>
        /* Tetap rapi di layar sempit tanpa turun berantakan */
        @media (max-width: 767.98px) {
            .card-panel-header.flex-nowrap {
                flex-wrap: wrap !important;
            }
            .card-panel-header .ms-auto {
                width: 100%;
                margin-left: 0 !important;
            }
            .card-panel-header form.flex-nowrap {
                flex: 1 1 auto;
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
                    <th class="ps-3">Foto</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Terjual</th>
                    <th class="text-end pe-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produks as $produk)
                <tr>
                    <td class="ps-3">
                        @if($produk->foto_produk && file_exists(public_path($produk->foto_produk)))
                            <img src="{{ asset($produk->foto_produk) }}" class="prod-thumb" alt="{{ $produk->nama_produk }}">
                        @else
                            <div class="prod-thumb bg-light d-flex align-items-center justify-content-center text-muted">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="fw-semibold">{{ $produk->nama_produk }}</div>
                        <div class="text-muted small">{{ $produk->id_produk }}</div>
                    </td>
                    <td><span class="badge bg-light text-dark border">{{ $produk->kategori ?: '-' }}</span></td>
                    <td>Rp{{ number_format($produk->harga_produk, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $produk->stok_produk <= 10 ? 'bg-danger' : 'bg-success' }}">
                            {{ $produk->stok_produk }} pcs
                        </span>
                    </td>
                    <td>{{ $produk->terjual }}</td>
                    <td class="text-end pe-3">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.products.edit', $produk->id_produk) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.products.destroy', $produk->id_produk) }}" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data produk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($produks->hasPages())
    <div class="p-3 border-top">
        {{ $produks->links() }}
    </div>
    @endif
</div>

@endsection