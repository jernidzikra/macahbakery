@extends('admin.layouts.app')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk Baru')

@section('content')

<a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Produk
</a>

<div class="card-panel">
    <div class="card-panel-header"><span><i class="fas fa-plus me-2" style="color:#C9943A;"></i>Detail Produk</span></div>
    <div class="p-4">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.products._form', ['produk' => new \App\Models\Produk()])
            <button type="submit" class="btn btn-gold mt-2">
                <i class="fas fa-save me-1"></i> Simpan Produk
            </button>
        </form>
    </div>
</div>

@endsection
