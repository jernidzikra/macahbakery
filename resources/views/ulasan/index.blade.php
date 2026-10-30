@extends('layouts.app')

@section('title', 'Ulasan Pelanggan - Macah Bakery')

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-4" style="color: #5C2E0A;">⭐ Ulasan Pelanggan</h1>
    
    <!-- FORM TAMBAH ULASAN -->
    @auth
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h5 style="color: #5C2E0A; font-weight: 600; margin-bottom: 15px;">
                <i class="fas fa-pen me-2"></i> Tulis Ulasan
            </h5>
            
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            
            <form action="{{ route('ulasan.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Pilih Produk</label>
                        <select name="id_produk" class="form-select" required id="produkSelect">
                            <option value="">-- Pilih Produk --</option>
                            @foreach($produks as $p)
                            <option value="{{ $p->id_produk }}" data-image="{{ $p->foto_produk ? asset($p->foto_produk) : 'https://placehold.co/50x50/F5E6D3/8B4513' }}" data-price="{{ $p->harga_produk }}">
                                {{ $p->nama_produk }}
                            </option>
                            @endforeach
                        </select>
                        
                        <!-- Preview Gambar Produk -->
                        <div class="mt-2" id="produkPreview" style="display: none;">
                            <div class="d-flex align-items-center gap-3 p-2" style="background: #FDF6EE; border-radius: 10px; border: 1px solid #F5E6D3;">
                                <img id="previewImage" src="" alt="Produk" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                <div>
                                    <div id="previewName" style="font-weight: 600; color: #5D4037;"></div>
                                    <div id="previewPrice" style="color: #C9943A; font-size: 14px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Rating</label>
                        <div class="d-flex gap-2" id="ratingStars">
                            @for($i = 5; $i >= 1; $i--)
                            <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" style="display: none;">
                            <label for="star{{ $i }}" class="fs-2" style="cursor: pointer; color: #ddd;" 
                                   onmouseover="this.style.color='#ffc107'"
                                   onmouseout="this.style.color='#ddd'"
                                   onclick="document.getElementById('star{{ $i }}').checked = true; updateStars({{ $i }})">
                                ★
                            </label>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="selectedRating" value="5">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Komentar</label>
                        <textarea name="komentar" class="form-control" rows="3" placeholder="Tulis pengalamanmu..." maxlength="500"></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn" style="background: #C9943A; color: #fff; border-radius: 30px; padding: 10px 35px;">
                            <i class="fas fa-paper-plane me-2"></i> Kirim Ulasan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @else
    <div class="alert alert-warning text-center mb-4">
        <i class="fas fa-exclamation-triangle me-2"></i>
        Silakan <a href="/login" style="color: #C9943A; font-weight: 600;">Login</a> untuk memberikan ulasan
    </div>
    @endif
    
    <!-- STATISTIK RATING -->
    <div class="row mb-4">
        <div class="col-md-4 text-center">
            <div class="card shadow-sm border-0 rounded-4 p-3">
                <h2 class="display-3 fw-bold" style="color: #C9943A;">{{ number_format($avgRating, 1) }}</h2>
                <div>
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= round($avgRating) ? 'text-warning' : 'text-muted' }}" style="font-size: 24px;"></i>
                    @endfor
                </div>
                <p class="text-muted">Dari {{ $totalUlasan }} ulasan</p>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4 p-3">
                @for($i = 5; $i >= 1; $i--)
                <div class="d-flex align-items-center gap-2 mb-1">
                    <span style="min-width: 40px;">{{ $i }} <i class="fas fa-star text-warning" style="font-size: 12px;"></i></span>
                    <div class="progress flex-grow-1" style="height: 8px; background: #f0e8e0;">
                        @php
                            $persen = $totalUlasan > 0 ? ($ratings[$i] / $totalUlasan) * 100 : 0;
                        @endphp
                        <div class="progress-bar" style="width: {{ $persen }}%; background: #C9943A;"></div>
                    </div>
                    <span class="text-muted small" style="min-width: 30px;">{{ $ratings[$i] }}</span>
                </div>
                @endfor
            </div>
        </div>
    </div>
    
    <!-- LIST ULASAN -->
    <div class="row">
        <div class="col-12">
            <h4 class="mb-3" style="color: #5D4037;">📝 Semua Ulasan</h4>
            
            @forelse($ulasans as $ulasan)
            <div class="card shadow-sm border-0 rounded-4 mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 40px; height: 40px; background: #C9943A !important; color: #fff; font-weight: bold; font-size: 18px;">
                                    {{ substr($ulasan->pelanggan->nama_pelanggan ?? 'A', 0, 1) }}
                                </div>
                                <div>
                                    <strong style="color: #5D4037;">{{ $ulasan->pelanggan->nama_pelanggan ?? 'Anonymous' }}</strong>
                                    <div>
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $ulasan->rating ? 'text-warning' : 'text-muted' }}" style="font-size: 14px;"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                        <small class="text-muted">{{ $ulasan->tgl_ulasan ? $ulasan->tgl_ulasan->format('d M Y') : '-' }}</small>
                    </div>
                    <p class="mt-2 mb-1">{{ $ulasan->komentar ?? 'Tidak ada komentar' }}</p>
                    <a href="/products/{{ $ulasan->id_produk }}" class="text-decoration-none small" style="color: #C9943A;">
                        <i class="fas fa-tag"></i> {{ $ulasan->produk->nama_produk ?? 'Produk' }}
                    </a>
                </div>
            </div>
            @empty
            <div class="text-center py-5">
                <i class="fas fa-comment fa-4x text-muted"></i>
                <h4 class="mt-3">Belum Ada Ulasan</h4>
                <p class="text-muted">Jadi yang pertama memberi ulasan!</p>
            </div>
            @endforelse
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $ulasans->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    function updateStars(rating) {
        document.getElementById('selectedRating').value = rating;
        for (let i = 1; i <= 5; i++) {
            const label = document.querySelector('label[for="star' + i + '"]');
            if (i <= rating) {
                label.style.color = '#ffc107';
            } else {
                label.style.color = '#ddd';
            }
        }
    }

    // Preview gambar saat memilih produk
    document.getElementById('produkSelect')?.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const previewDiv = document.getElementById('produkPreview');
        
        if (this.value) {
            const imageUrl = selectedOption.getAttribute('data-image');
            const productName = selectedOption.text;
            const price = selectedOption.getAttribute('data-price');
            
            document.getElementById('previewImage').src = imageUrl;
            document.getElementById('previewName').textContent = productName;
            document.getElementById('previewPrice').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(price);
            previewDiv.style.display = 'block';
        } else {
            previewDiv.style.display = 'none';
        }
    });
</script>
@endsection