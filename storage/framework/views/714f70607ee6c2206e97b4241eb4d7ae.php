

<?php
use App\Models\Produk;
?>

<?php $__env->startSection('title', 'Belanja - Macah Bakery'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <!--- SIDEBAR KIRI --->
        <div class="col-lg-3 col-md-4 mb-4">
            <!-- Card Kategori -->
            <div class="card shadow-sm mb-4 border-0 rounded-3">
                <div class="card-header bg-white fw-bold border-0 pt-3 pb-2" style="color: #5D4037; font-size: 16px;">
                    <i class="fas fa-tags me-2" style="color: #C9943A;"></i> Kategori
                </div>
                <div class="card-body p-0">
                    <ul class="list-unstyled m-0">
                        <li>
                            <a href="/products?kategori=semua" 
                               class="d-flex align-items-center px-3 py-2 text-decoration-none <?php echo e(!request('kategori') || request('kategori') == 'semua' ? 'active-cat' : ''); ?>"
                               style="color: #5D4037; transition: all 0.2s; font-size: 14px;">
                                <i class="fas fa-th-list me-2" style="width: 20px; color: #C9943A;"></i>
                                Semua Produk
                            </a>
                        </li>
                        <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="/products?kategori=<?php echo e($kat); ?>" 
                               class="d-flex align-items-center px-3 py-2 text-decoration-none <?php echo e(request('kategori') == $kat ? 'active-cat' : ''); ?>"
                               style="color: #5D4037; transition: all 0.2s; font-size: 14px;">
                                <i class="fas fa-chevron-right me-2" style="width: 20px; font-size: 10px; color: #C9943A;"></i>
                                <?php echo e($kat); ?>

                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            
            <!-- Card Filter Harga -->
            <div class="card shadow-sm mb-4 border-0 rounded-3">
                <div class="card-header bg-white fw-bold border-0 pt-3 pb-2" style="color: #5D4037; font-size: 16px;">
                    <i class="fas fa-sliders-h me-2" style="color: #C9943A;"></i> Filter Harga
                </div>
                <div class="card-body">
                    <form action="/products" method="GET" id="filterForm">
                        <?php if(request('kategori') && request('kategori') != 'semua'): ?>
                        <input type="hidden" name="kategori" value="<?php echo e(request('kategori')); ?>">
                        <?php endif; ?>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted small">Rp <?php echo e(number_format($minHarga, 0, ',', '.')); ?></span>
                                <span class="text-muted small">Rp <?php echo e(number_format($maxHarga, 0, ',', '.')); ?></span>
                            </div>
                            <input type="range" class="form-range" id="priceRange" 
                                   min="<?php echo e($minHarga); ?>" max="<?php echo e($maxHarga); ?>" 
                                   step="1000"
                                   value="<?php echo e(request('max_price', $maxHarga)); ?>"
                                   oninput="updatePriceDisplay(this.value)"
                                   style="accent-color: #C9943A;">
                        </div>
                        
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label small text-muted">Min</label>
                                <input type="number" name="min_price" id="minPrice" 
                                       class="form-control form-control-sm" 
                                       placeholder="0"
                                       value="<?php echo e(request('min_price', 0)); ?>"
                                       min="<?php echo e($minHarga); ?>" max="<?php echo e($maxHarga); ?>">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Max</label>
                                <input type="number" name="max_price" id="maxPrice" 
                                       class="form-control form-control-sm" 
                                       placeholder="<?php echo e(number_format($maxHarga, 0, ',', '.')); ?>"
                                       value="<?php echo e(request('max_price', $maxHarga)); ?>"
                                       min="<?php echo e($minHarga); ?>" max="<?php echo e($maxHarga); ?>">
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 mt-3">
                            <button type="submit" class="btn btn-primary btn-sm" style="background: #C9943A; border: none;">
                                <i class="fas fa-search me-1"></i> Terapkan Filter
                            </button>
                            <a href="/products" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-undo me-1"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!--- PRODUCT LIST --->
        <div class="col-lg-9 col-md-8">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <h4 class="mb-0" style="color: #5D4037;">
                    <?php if(request('kategori') && request('kategori') != 'semua'): ?>
                        <?php echo e(request('kategori')); ?>

                    <?php else: ?>
                        Semua Produk
                    <?php endif; ?>
                    <span class="badge bg-secondary ms-2" style="background: #C9943A !important;"><?php echo e($products->count()); ?></span>
                </h4>
                
                <div class="d-flex gap-2">
                    <form action="/products" method="GET" id="sortForm">
                        <?php if(request('kategori') && request('kategori') != 'semua'): ?>
                        <input type="hidden" name="kategori" value="<?php echo e(request('kategori')); ?>">
                        <?php endif; ?>
                        <?php if(request('min_price')): ?>
                        <input type="hidden" name="min_price" value="<?php echo e(request('min_price')); ?>">
                        <?php endif; ?>
                        <?php if(request('max_price')): ?>
                        <input type="hidden" name="max_price" value="<?php echo e(request('max_price')); ?>">
                        <?php endif; ?>
                        
                        <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()" style="width: 150px; border-color: #C9943A;">
                            <option value="terbaru" <?php echo e(request('sort') == 'terbaru' ? 'selected' : ''); ?>>Terbaru</option>
                            <option value="termurah" <?php echo e(request('sort') == 'termurah' ? 'selected' : ''); ?>>Termurah</option>
                            <option value="termahal" <?php echo e(request('sort') == 'termahal' ? 'selected' : ''); ?>>Termahal</option>
                            <option value="terlaris" <?php echo e(request('sort') == 'terlaris' ? 'selected' : ''); ?>>Terlaris</option>
                        </select>
                    </form>
                </div>
            </div>
            
            <!-- Products Grid -->
            <div class="row" id="productGrid">
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-6 col-md-4 col-lg-3 mb-4 product-item">
                    <div class="card card-product h-100 border-0 rounded-3 shadow-sm" style="overflow: hidden;">
                        <div class="position-relative" style="background: #FDF6EE; padding-top: 100%;">
                            <?php
                                $imagePath = $product->foto_produk ?? '';
                                $imageUrl = 'https://placehold.co/300x300/F5E6D3/8B4513?text=' . urlencode($product->nama_produk);
                                
                                if (!empty($imagePath)) {
                                    $fullPath = public_path($imagePath);
                                    if (file_exists($fullPath)) {
                                        $imageUrl = asset($imagePath);
                                    } else {
                                        $cleanName = str_replace(' ', '-', $imagePath);
                                        $fullPathClean = public_path($cleanName);
                                        if (file_exists($fullPathClean)) {
                                            $imageUrl = asset($cleanName);
                                        }
                                    }
                                }
                            ?>
                            <img src="<?php echo e($imageUrl); ?>" 
                                 class="position-absolute top-0 start-0 w-100 h-100" 
                                 alt="<?php echo e($product->nama_produk); ?>" 
                                 style="object-fit: cover;">
                            
                            <?php if($product->stok_produk <= 0): ?>
                            <span class="badge bg-danger position-absolute top-0 end-0 m-2">Habis</span>
                            <?php elseif($product->stok_produk < 10): ?>
                            <span class="badge bg-warning position-absolute top-0 end-0 m-2" style="color: #fff;">Stok Terbatas</span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="card-body d-flex flex-column p-3">
                            <!-- Nama Produk -->
                            <h6 class="card-title text-truncate" style="color: #5D4037; font-size: 14px; font-weight: 600; margin-bottom: 2px;">
                                <?php echo e($product->nama_produk); ?>

                            </h6>
                            
                            <!-- Kategori -->
                            <div class="small text-muted text-truncate" style="font-size: 12px; margin-bottom: 2px;">
                                <?php echo e($product->kategori ?? 'Umum'); ?>

                            </div>
                            
                            <!--- UKURAN / DESKRIPSI --->
                            <div class="small text-muted" style="font-size: 11px; margin-bottom: 6px; line-height: 1.5;">
                                <?php
                                    $ukuran = '';
                                    $kategori = $product->kategori ?? '';
                                    $nama = $product->nama_produk ?? '';
                                    
                                    // PRIORITAS UTAMA: CEK PAKET-PAKET
                                    if (strpos($nama, 'Paket Kue Sus') !== false) {
                                        $ukuran = '1 Box (12 pcs)';
                                    } elseif (strpos($nama, 'Paket Tart Potong') !== false) {
                                        $ukuran = '1 Box (12 pcs)';
                                    } elseif (strpos($nama, 'Paket Bomboloni') !== false) {
                                        $ukuran = '1 Box (12 pcs)';
                                    } elseif (strpos($nama, 'Paket Donat Bulat') !== false) {
                                        $ukuran = '1 Box (12 pcs)';
                                    } 
                                    
                                    // PAKET 1 & 2 (DIBEDAKAN BERDASARKAN KATEGORI) 
                                    elseif (strpos($nama, 'Paket 1') !== false && $kategori == 'Hampers') {
                                        $ukuran = '3 jenis kue kering (600ml), kartu ucapan, paperbox + pita';
                                    } elseif (strpos($nama, 'Paket 2') !== false && $kategori == 'Hampers') {
                                        $ukuran = '6 jenis kue kering (600ml), kartu ucapan, paperbox + pita, mini gift';
                                    } elseif (strpos($nama, 'Paket 1') !== false && (strpos($kategori, 'Brownies') !== false)) {
                                        $ukuran = 'Paket 1 (3 pcs)';
                                    } elseif (strpos($nama, 'Paket 2') !== false && (strpos($kategori, 'Brownies') !== false)) {
                                        $ukuran = 'Paket 2 (6 pcs)';
                                    } 
                                    
                                    // KEDUA: CEK PRODUK REGULER BERDASARKAN NAMA
                                    elseif (strpos($nama, 'Kue Sus') !== false) {
                                        $ukuran = '(3 pcs)'; 
                                    } elseif (strpos($nama, 'Lapis Surabaya') !== false) {
                                        $ukuran = '1 loyang (24x24)';
                                    } elseif (strpos($nama, 'Bolu Gulung Pandan') !== false || 
                                              strpos($nama, 'Bolu Gulung Vanilla') !== false ||
                                              strpos($nama, 'Bolu Gulung Batik') !== false || 
                                              strpos($nama, 'Bolu Gulung Coklat') !== false) {
                                        $ukuran = '1 loyang (10x24)';
                                    } elseif (strpos($nama, 'Bolu Tape Keju') !== false || 
                                              strpos($nama, 'Bolu Pandan Keju') !== false) {
                                        $ukuran = '1 loyang (20x20)';
                                    } elseif (strpos($nama, 'Chiffon Cake') !== false) {
                                        $ukuran = '1 loyang (22x22)';
                                    } elseif (strpos($nama, 'Donat') !== false) {
                                        $ukuran = '(3 pcs)';
                                    } elseif (strpos($nama, 'Roti') !== false) {
                                        $ukuran = '(1 pcs)';
                                    } elseif (strpos($nama, 'Kue Tart Potong') !== false) {
                                        $ukuran = '(3 pcs)';
                                    } 
                                    
                                    // KUE LEBARAN 
                                    elseif (strpos($nama, 'Kastangel') !== false) {
                                        $ukuran = '1 toples (± 305gr)';
                                    } elseif (strpos($nama, 'Putri Salju') !== false) {
                                        $ukuran = '1 toples (± 360gr)';
                                    } elseif (strpos($nama, 'Nastar') !== false) {
                                        $ukuran = '1 toples (± 320gr)';
                                    } elseif (strpos($nama, 'Lidah Kucing') !== false) {
                                        $ukuran = '1 toples (± 180gr)';
                                    } elseif (strpos($nama, 'Coklat Kacang') !== false) {
                                        $ukuran = '1 toples (± 175gr)';
                                    } elseif (strpos($nama, 'Semprit') !== false) {
                                        $ukuran = '1 toples (± 160gr)';
                                    } elseif (strpos($nama, 'Chocochip Cookies') !== false) {
                                        $ukuran = '1 toples (± 160gr)';
                                    } 
                                    
                                    // KATEGORI BROWNIES (SEMUA VARIAN Brownies 1, Brownies 2, dll)
                                    elseif (strpos($kategori, 'Brownies') !== false) {
                                        if (strpos($nama, 'Paket 1') !== false) {
                                            $ukuran = 'Paket 1 (3 pcs)';
                                        } elseif (strpos($nama, 'Paket 2') !== false) {
                                            $ukuran = 'Paket 2 (6 pcs)';
                                        } elseif (strpos($nama, 'Brownies Coklat') !== false) {
                                            $ukuran = '1 loyang (20x20)';
                                        } elseif (strpos($nama, 'Brownies Keju') !== false) {
                                            $ukuran = '1 loyang (20x20)';
                                        } elseif (strpos($nama, 'Brownies Kukus') !== false) {
                                            $ukuran = '1 loyang (22x22)';
                                        } elseif (strpos($nama, 'Brownies 1') !== false) {
                                            $ukuran = 'Paket 1 (3 pcs)';
                                        } elseif (strpos($nama, 'Brownies 2') !== false) {
                                            $ukuran = 'Paket 2 (6 pcs)';
                                        }
                                    } elseif (strpos($kategori, 'Hampers') !== false) {
                                        $ukuran = 'Paket Hampers';
                                    }
                                    
                                    // CARA 3: CEK BERDASARKAN KATEGORI (FALLBACK)
                                    if (empty($ukuran)) {
                                        if ($kategori == 'Bolu') {
                                            $ukuran = '1 loyang';
                                        } elseif (strpos($kategori, 'Brownies 1') !== false) {
                                            $ukuran = 'Paket 1 (3 pcs)';
                                        } elseif (strpos($kategori, 'Brownies 2') !== false) {
                                            $ukuran = 'Paket 2 (6 pcs)';
                                        } elseif ($kategori == 'Kue Lebaran') {
                                            $ukuran = '1 toples';
                                        } elseif ($kategori == 'Roti & Kue' || $kategori == 'Roti-Kue' || $kategori == 'Roti') {
                                            $ukuran = '1 pcs';
                                        } elseif ($kategori == 'Hampers') {
                                            $ukuran = 'Paket Hampers';
                                        }
                                    }
                                    
                                    // DEBUG (HAPUS SETELAH JADI)
                                    // $debug = 'Kategori: "' . $kategori . '" | Nama: "' . $nama . '"';
                                ?>
                                <?php echo e($ukuran); ?>

                                
                                
                            </div>
                            
                            <!-- Harga & Tombol + -->
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <div class="fw-bold" style="color: #C9943A; font-size: 15px;">
                                    Rp <?php echo e(number_format($product->harga_produk, 0, ',', '.')); ?>

                                </div>
                                <a href="/products/<?php echo e($product->id_produk); ?>" 
                                   class="btn btn-sm" 
                                   style="background: transparent; color: #C9943A; border-radius: 50%; width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center; border: 2px solid #C9943A; font-size: 16px; font-weight: bold; transition: all 0.3s; flex-shrink: 0;"
                                   onmouseover="this.style.background='#C9943A'; this.style.color='#fff';"
                                   onmouseout="this.style.background='transparent'; this.style.color='#C9943A';">
                                    +
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-search fa-4x text-muted"></i>
                    <h4 class="mt-3">Produk Tidak Ditemukan</h4>
                    <p class="text-muted">Coba ubah filter atau kategori</p>
                    <a href="/products" class="btn btn-primary" style="background: #C9943A; border: none;">Reset Filter</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!--- STYLES --->
<?php $__env->startPush('styles'); ?>
<style>
    .card-product {
        transition: transform 0.3s, box-shadow 0.3s;
        background: #fff;
    }
    .card-product:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.12) !important;
    }
    .card-product .card-body {
        padding: 12px 14px 14px 14px;
    }
    .active-cat {
        background: #FDF6EE;
        color: #8B4513 !important;
        font-weight: 600;
        border-right: 3px solid #C9943A;
    }
    .active-cat:hover {
        background: #F5E6D3;
    }
    .list-unstyled li a {
        padding: 10px 16px !important;
        border-bottom: 1px solid #f8f0e8;
    }
    .list-unstyled li:last-child a {
        border-bottom: none;
    }
    .list-unstyled li a:hover {
        background: #FDF6EE;
        color: #8B4513 !important;
    }
    .form-range::-webkit-slider-thumb {
        background: #C9943A;
    }
    .form-range::-webkit-slider-thumb:hover {
        background: #8B4513;
    }
    .form-range::-moz-range-thumb {
        background: #C9943A;
        border: none;
    }
    .form-range {
        height: 6px;
    }
    
    /* Responsive */
    @media (max-width: 992px) {
        .col-lg-3 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        .col-lg-9 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
    @media (max-width: 576px) {
        .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<!--- SCRIPTS --->
<?php $__env->startPush('scripts'); ?>
<script>
    function updatePriceDisplay(value) {
        document.getElementById('maxPrice').value = value;
    }
    
    document.getElementById('maxPrice')?.addEventListener('input', function() {
        document.getElementById('priceRange').value = this.value;
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\macahbakery\resources\views/products/index.blade.php ENDPATH**/ ?>