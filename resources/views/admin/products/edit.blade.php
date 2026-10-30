@extends('admin.layouts.app')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')

<a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Produk
</a>

<div class="card-panel">
    <div class="card-panel-header"><span><i class="fas fa-pen me-2" style="color:#C9943A;"></i>{{ $produk->nama_produk }} <span class="text-muted small">({{ $produk->id_produk }})</span></span></div>
    <div class="p-4">
        <form method="POST" action="{{ route('admin.products.update', $produk->id_produk) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.products._form', ['produk' => $produk])
            <button type="submit" class="btn btn-gold mt-2">
                <i class="fas fa-save me-1"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>

@endsection
