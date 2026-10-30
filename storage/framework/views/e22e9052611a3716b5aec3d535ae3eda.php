

<?php $__env->startSection('title', 'Keranjang Belanja - Macah Bakery'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row">
        <div class="col-lg-8">
            <!-- HEADER -->
            <h2 style="color: #5C2E0A; font-weight: 700; margin-bottom: 20px;">🛒 Keranjang Belanja</h2>

            <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <?php if(empty($cart)): ?>
            <!-- KERANJANG KOSONG -->
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-4x text-muted"></i>
                <h3 class="mt-3" style="color: #5D4037;">Keranjang Kosong</h3>
                <p class="text-muted">Yuk, mulai belanja!</p>
                <a href="/products" class="btn" style="background: #C9943A; color: #fff; border-radius: 30px; padding: 10px 30px;">
                    <i class="fas fa-shopping-bag me-2"></i> Belanja Sekarang
                </a>
            </div>
            <?php else: ?>
            <!-- LIST ITEMS -->
            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card border-0 shadow-sm rounded-3 mb-3 p-3">
                <div class="row align-items-center">
                    <div class="col-3 col-md-2">
                        <img src="<?php echo e($item['foto'] ? asset($item['foto']) : 'https://placehold.co/80x80/F5E6D3/8B4513'); ?>" 
                             alt="<?php echo e($item['nama_produk']); ?>" 
                             style="width: 100%; height: 80px; object-fit: cover; border-radius: 8px;">
                    </div>
                    <div class="col-5 col-md-5">
                        <h6 style="color: #5D4037; font-weight: 600; margin-bottom: 2px;"><?php echo e($item['nama_produk']); ?></h6>
                        <div style="font-size: 13px; color: #C9943A; font-weight: 600;">
                            Rp <?php echo e(number_format($item['harga'], 0, ',', '.')); ?>

                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <form action="/cart/update/<?php echo e($id); ?>" method="POST" class="d-flex align-items-center gap-2">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <label class="small text-muted me-1">Qty:</label>
                            <input type="number" name="jumlah" value="<?php echo e($item['jumlah']); ?>" min="1" 
                                   class="form-control form-control-sm" style="width: 60px; text-align: center;">
                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-12 col-md-2 text-end mt-2 mt-md-0">
                        <form action="/cart/remove/<?php echo e($id); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <!-- CLEAR CART -->
            <div class="text-end mt-2">
                <form action="/cart/clear" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-trash-alt me-1"></i> Kosongkan Keranjang
                    </button>
                </form>
            </div>
            <?php endif; ?>
        </div>

        <!-- ===== SIDEBAR KANAN: ORDER SUMMARY ===== -->
        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm rounded-3 p-4" style="position: sticky; top: 80px;">
                <h5 style="color: #5C2E0A; font-weight: 700; margin-bottom: 20px;">Order Summary</h5>

                <?php if(!empty($cart)): ?>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Subtotal (<?php echo e(count($cart)); ?> Products)</span>
                    <span class="fw-bold" style="color: #5D4037;">Rp <?php echo e(number_format($total, 0, ',', '.')); ?></span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <span style="font-weight: 600; color: #5C2E0A;">Total</span>
                    <span style="font-size: 1.3rem; font-weight: 700; color: #C9943A;">Rp <?php echo e(number_format($total, 0, ',', '.')); ?></span>
                </div>

                <!-- TOMBOL CHECKOUT (CEK LOGIN) -->
                <?php if(auth()->guard()->check()): ?>
                    <a href="/checkout" class="btn w-100" style="background: #C9943A; color: #fff; border-radius: 30px; padding: 12px; font-weight: 600;">
                        <i class="fas fa-check me-2"></i> Checkout
                    </a>
                <?php else: ?>
                    <div class="alert alert-warning alert-sm text-center" role="alert">
                        <i class="fas fa-exclamation-triangle me-1"></i> 
                        Silakan <a href="/login" style="color: #C9943A; font-weight: 600;">Login</a> untuk checkout
                    </div>
                    <a href="/login" class="btn w-100" style="background: #C9943A; color: #fff; border-radius: 30px; padding: 12px; font-weight: 600;">
                        <i class="fas fa-sign-in-alt me-2"></i> Login untuk Checkout
                    </a>
                <?php endif; ?>

                <!-- CATATAN -->
                <div class="mt-3">
                    <label class="small text-muted">Catatan:</label>
                    <textarea class="form-control form-control-sm" rows="2" placeholder="Tambah catatan..." style="border-radius: 8px;"></textarea>
                </div>

                <div class="mt-3 p-2" style="background: #FDF6EE; border-radius: 8px;">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1" style="color: #C9943A;"></i>
                        Jika anda memesan untuk orang lain, beritahu kami dengan menuliskan NAMA PENGIRIM pada catatan.
                    </small>
                </div>

                <?php else: ?>
                <div class="text-center py-4">
                    <i class="fas fa-shopping-bag fa-3x text-muted"></i>
                    <p class="text-muted mt-2">Keranjang kosong</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\macahbakery\resources\views/cart/index.blade.php ENDPATH**/ ?>