

<?php $__env->startSection('title', $product->nama_produk . ' - Macah Bakery'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
            <li class="breadcrumb-item"><a href="/products">Belanja</a></li>
            <li class="breadcrumb-item active"><?php echo e($product->nama_produk); ?></li>
        </ol>
    </nav>

    <div class="row g-4">
        <!-- Gambar Produk -->
        <div class="col-md-6">
            <?php
                $imagePath = $product->foto_produk ?? '';
                $imageUrl = 'https://placehold.co/600x500/F5E6D3/8B4513?text=' . urlencode($product->nama_produk);
                
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
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <img src="<?php echo e($imageUrl); ?>" 
                     alt="<?php echo e($product->nama_produk); ?>" 
                     style="width: 100%; height: 450px; object-fit: cover;">
            </div>
        </div>
        
        <!-- Detail Produk -->
        <div class="col-md-6">
            <!-- Nama Produk -->
            <h1 class="display-6" style="color: #5D4037; font-weight: 700;"><?php echo e($product->nama_produk); ?></h1>
            
            <!-- Kategori -->
            <span class="badge mb-3" style="background: #C9943A; color: #fff; padding: 6px 14px; border-radius: 20px; font-weight: 500;">
                <?php echo e($product->kategori ?? 'Umum'); ?>

            </span>
            
            <!-- Rating -->
            <div class="mb-3">
                <?php
                    $avgRating = $ratings['average'] ?? 0;
                ?>
                <?php for($i = 1; $i <= 5; $i++): ?>
                    <i class="fas fa-star <?php echo e($i <= round($avgRating) ? 'text-warning' : 'text-muted'); ?>" style="font-size: 16px;"></i>
                <?php endfor; ?>
                <span class="ms-2" style="color: #5D4037; font-weight: 500;"><?php echo e(number_format($avgRating, 1)); ?> dari 5</span>
                <span class="text-muted ms-2">(<?php echo e($ratings['total'] ?? 0); ?> ulasan)</span>
            </div>
            
            <!-- Harga -->
            <p class="display-6 fw-bold" style="color: #C9943A;">Rp <?php echo e(number_format($product->harga_produk, 0, ',', '.')); ?></p>
            
            <!-- Deskripsi -->
            <p class="text-muted" style="font-size: 15px; line-height: 1.8;"><?php echo e($product->desk_produk ?? 'Tidak ada deskripsi'); ?></p>
            
            <!-- Stok -->
            <p class="mb-3">
                <strong style="color: #5D4037;">Stok:</strong> 
                <?php if($product->stok_produk > 0): ?>
                    <span class="text-success fw-bold"><?php echo e($product->stok_produk); ?> tersedia</span>
                <?php else: ?>
                    <span class="text-danger fw-bold">Habis</span>
                <?php endif; ?>
            </p>
            
            <!-- Jumlah & Tombol (SEJAJAR) -->
            <form action="/cart/add" method="POST" class="d-flex align-items-center gap-3 mt-3">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id_produk" value="<?php echo e($product->id_produk); ?>">
                
                <div class="d-flex align-items-center gap-2">
                    <label for="jumlah" class="fw-bold" style="color: #5D4037; font-size: 15px;">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" 
                           class="form-control" 
                           style="width: 70px; text-align: center; border-radius: 10px; border: 2px solid #F5E6D3;"
                           value="1" min="1" max="<?php echo e($product->stok_produk); ?>">
                </div>
                
                <button type="submit" class="btn btn-lg" style="background: #C9943A; color: #fff; border-radius: 30px; padding: 10px 35px; font-weight: 600; border: none; white-space: nowrap;">
                    <i class="fas fa-shopping-cart me-2"></i> Tambah ke Keranjang
                </button>
            </form>
            
            <!-- Marketplace Buttons (Cuma WA & ShopeeFood) -->
            <div class="mt-4">
                <h6 style="color: #5D4037; font-weight: 600; margin-bottom: 10px;">Pesan via Marketplace:</h6>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="https://wa.me/6281211221984?text=Halo%20Macah%20Bakery%2C%20saya%20mau%20pesan%20<?php echo e(urlencode($product->nama_produk)); ?>" 
                       class="btn" target="_blank" style="background: #25D366; color: #fff; border-radius: 30px; padding: 8px 24px; font-weight: 500;">
                        <i class="fab fa-whatsapp me-2"></i> WhatsApp
                    </a>
                    <a href="https://spf.shopee.co.id/40Z5OFTzYL" 
                       class="btn" target="_blank" style="background: #EE4D2D; color: #fff; border-radius: 30px; padding: 8px 24px; font-weight: 500;">
                        <i class="fas fa-shopping-bag me-2"></i> ShopeeFood
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Ulasan Pelanggan -->
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="mb-4" style="color: #5D4037; font-weight: 700;">📝 Ulasan Pelanggan</h3>
            
            <?php if(isset($product->ulasan) && $product->ulasan->count() > 0): ?>
                <?php $__currentLoopData = $product->ulasan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ulasan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                         style="width: 40px; height: 40px; background: #C9943A; color: #fff; font-weight: bold; font-size: 16px;">
                                        <?php echo e(substr($ulasan->pelanggan->nama_pelanggan ?? 'A', 0, 1)); ?>

                                    </div>
                                    <div>
                                        <strong style="color: #5D4037;"><?php echo e($ulasan->pelanggan->nama_pelanggan ?? 'Anonymous'); ?></strong>
                                        <div>
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <i class="fas fa-star <?php echo e($i <= $ulasan->rating ? 'text-warning' : 'text-muted'); ?>" style="font-size: 13px;"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted"><?php echo e(isset($ulasan->tgl_ulasan) ? $ulasan->tgl_ulasan->format('d M Y') : ''); ?></small>
                        </div>
                        <p class="mt-2 mb-1" style="color: #5D4037;"><?php echo e($ulasan->komentar ?? 'Tidak ada komentar'); ?></p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="text-center py-4">
                    <i class="fas fa-comment fa-3x text-muted"></i>
                    <p class="mt-2 text-muted">Belum ada ulasan untuk produk ini</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Rekomendasi Produk -->
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="mb-4" style="color: #5D4037; font-weight: 700;">🔄 Produk Lainnya</h3>
            <div class="row g-3">
                <?php if(isset($rekomendasi) && $rekomendasi->count() > 0): ?>
                    <?php $__currentLoopData = $rekomendasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rek): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <?php
                                $rekImage = $rek->foto_produk ? asset($rek->foto_produk) : 'https://placehold.co/300x200/F5E6D3/8B4513?text='.urlencode($rek->nama_produk);
                            ?>
                            <img src="<?php echo e($rekImage); ?>" 
                                 class="card-img-top" alt="<?php echo e($rek->nama_produk); ?>" 
                                 style="height: 160px; object-fit: cover; border-radius: 12px 12px 0 0;">
                            <div class="card-body">
                                <h6 class="card-title text-truncate" style="color: #5D4037; font-weight: 600;"><?php echo e($rek->nama_produk); ?></h6>
                                <p class="fw-bold" style="color: #C9943A; font-size: 14px;">Rp <?php echo e(number_format($rek->harga_produk, 0, ',', '.')); ?></p>
                                <a href="/products/<?php echo e($rek->id_produk); ?>" class="btn btn-sm w-100" style="background: #C9943A; color: #fff; border-radius: 20px; border: none;">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="col-12 text-center text-muted">
                        <p>Belum ada produk lain</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\macahbakery\resources\views/products/show.blade.php ENDPATH**/ ?>