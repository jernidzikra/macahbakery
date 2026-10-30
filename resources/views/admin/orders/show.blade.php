@extends('admin.layouts.app')

@section('title', 'Detail Pesanan')
@section('page-title', 'Detail Pesanan ' . $pesanan->id_pesanan)

@section('content')

<a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Pesanan
</a>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="card-panel mb-3">
            <div class="card-panel-header">
                <span><i class="fas fa-box me-2" style="color:#C9943A;"></i>Item Pesanan</span>
                <span class="badge-status badge-{{ $pesanan->status_pesanan }}">{{ ucfirst($pesanan->status_pesanan) }}</span>
            </div>
            <div class="table-responsive">
                <table class="table table-admin mb-0">
                    <thead>
                        <tr>
                            <th class="ps-3">Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th class="pe-3">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan->detailPesanan as $item)
                        <tr>
                            <td class="ps-3">
                                <div class="d-flex align-items-center gap-2">
                                    @if($item->produk && $item->produk->foto_produk)
                                        <img src="{{ asset($item->produk->foto_produk) }}" class="prod-thumb" alt="">
                                    @endif
                                    {{ $item->produk->nama_produk ?? $item->id_produk }}
                                </div>
                            </td>
                            <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td class="pe-3">Rp{{ number_format($item->jumlah * $item->harga, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-semibold ps-3">Total Pesanan</td>
                            <td class="fw-bold pe-3">Rp{{ number_format($pesanan->total, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @if ($pesanan->pembayaran)
        <div class="card-panel mb-3">
            <div class="card-panel-header">
                <span><i class="fas fa-credit-card me-2" style="color:#C9943A;"></i>Pembayaran</span>
                <span class="badge-status badge-{{ $pesanan->pembayaran->status_pembayaran }}">{{ ucfirst($pesanan->pembayaran->status_pembayaran) }}</span>
            </div>
            <div class="p-3">
                <p class="mb-1 small"><strong>Metode:</strong> {{ $pesanan->pembayaran->metode_bayar }}</p>
                <p class="mb-1 small"><strong>Jumlah Bayar:</strong> Rp{{ number_format($pesanan->pembayaran->jumlah_bayar, 0, ',', '.') }}</p>
                <p class="mb-1 small"><strong>Tanggal Bayar:</strong> {{ \Carbon\Carbon::parse($pesanan->pembayaran->tgl_bayar)->translatedFormat('d M Y') }}</p>
                <p class="mb-2 small"><strong>Status:</strong> {{ ucfirst($pesanan->pembayaran->status_pembayaran) }}</p>

                @if ($pesanan->pembayaran->bukti_bayar)
                <p class="mb-1 small fw-semibold">Bukti Transfer:</p>
                <a href="{{ asset($pesanan->pembayaran->bukti_bayar) }}" target="_blank">
                    <img src="{{ asset($pesanan->pembayaran->bukti_bayar) }}" alt="Bukti Bayar" class="img-fluid rounded mb-3" style="max-height:220px;">
                </a>
                @endif

                <form method="POST" action="{{ route('admin.orders.updatePayment', $pesanan->id_pesanan) }}" class="d-flex gap-2">
                    @csrf
                    @method('PATCH')
                    <select name="status_pembayaran" class="form-select form-select-sm">
                        @foreach (['menunggu','lunas','gagal'] as $status)
                            <option value="{{ $status }}" {{ $pesanan->pembayaran->status_pembayaran == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-sm btn-gold text-nowrap">
                        <i class="fas fa-check me-1"></i> Konfirmasi
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="card-panel mb-3">
            <div class="card-panel-header"><span><i class="fas fa-credit-card me-2" style="color:#C9943A;"></i>Pembayaran</span></div>
            <div class="p-3">
                <p class="text-muted small mb-3">Belum ada data pembayaran untuk pesanan ini.</p>
                <form method="POST" action="{{ route('admin.orders.updatePayment', $pesanan->id_pesanan) }}" class="d-flex gap-2">
                    @csrf
                    @method('PATCH')
                    <select name="status_pembayaran" class="form-select form-select-sm">
                        @foreach (['menunggu','lunas','gagal'] as $status)
                            <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-sm btn-gold text-nowrap">
                        <i class="fas fa-check me-1"></i> Simpan
                    </button>
                </form>
            </div>
        </div>
        @endif

        @if ($pesanan->komplain)
        <div class="card-panel">
            <div class="card-panel-header"><span><i class="fas fa-circle-exclamation me-2" style="color:#C9943A;"></i>Komplain</span></div>
            <div class="p-3">
                <p class="mb-1 small"><strong>Jenis:</strong> {{ $pesanan->komplain->jenis_komplain }}</p>
                <p class="mb-1 small"><strong>Deskripsi:</strong> {{ $pesanan->komplain->desk_komplain }}</p>
                <p class="mb-0 small"><strong>Status:</strong> {{ ucfirst($pesanan->komplain->status_komplain) }}</p>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <div class="card-panel mb-3">
            <div class="card-panel-header"><span><i class="fas fa-user me-2" style="color:#C9943A;"></i>Pelanggan</span></div>
            <div class="p-3">
                <p class="mb-1"><strong>{{ $pesanan->pelanggan->nama_pelanggan ?? '-' }}</strong></p>
                <p class="mb-1 small text-muted">{{ $pesanan->pelanggan->id_pelanggan ?? '' }}</p>
                <p class="mb-1 small"><i class="fas fa-phone me-2 text-muted"></i>{{ $pesanan->pelanggan->no_telp ?? '-' }}</p>
                <p class="mb-2 small"><i class="fas fa-map-marker-alt me-2 text-muted"></i>{{ $pesanan->alamat_pengiriman ?: '-' }}</p>
                @if ($pesanan->pelanggan)
                <a href="{{ route('admin.customers.show', $pesanan->pelanggan->id_pelanggan) }}" class="btn btn-sm btn-outline-secondary w-100">
                    <i class="fas fa-eye me-1"></i> Lihat Profil Pelanggan
                </a>
                @endif
            </div>
        </div>

        <div class="card-panel mb-3">
            <div class="card-panel-header"><span><i class="fas fa-pen-to-square me-2" style="color:#C9943A;"></i>Update Status</span></div>
            <div class="p-3">
                <form method="POST" action="{{ route('admin.orders.update', $pesanan->id_pesanan) }}">
                    @csrf
                    @method('PATCH')
                    <select name="status_pesanan" class="form-select mb-3">
                        @foreach (['pending','diproses','dikirim','selesai','dibatalkan'] as $status)
                            <option value="{{ $status }}" {{ $pesanan->status_pesanan == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-gold w-100">
                        <i class="fas fa-check me-1"></i> Simpan Status
                    </button>
                </form>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.orders.destroy', $pesanan->id_pesanan) }}" onsubmit="return confirm('Yakin ingin menghapus pesanan ini? Tindakan ini tidak dapat dibatalkan.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger w-100">
                <i class="fas fa-trash me-1"></i> Hapus Pesanan
            </button>
        </form>
    </div>
</div>

@endsection
