<?php $__env->startSection('title', 'Pesanan Saya - Macah Bakery'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h1 class="text-center mb-1" style="color: #5C2E0A;">📋 Pesanan Saya</h1>
    <p class="text-center text-muted mb-4">Pantau status pesanan dan pembayaran Anda di sini</p>

    <?php if(session('success')): ?>
    <div class="alert alert-success rounded-4"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session('error')): ?>
    <div class="alert alert-danger rounded-4"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <?php $__empty_1 = true; $__currentLoopData = $pesanans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-3">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
            <div>
                <h6 class="mb-1 fw-bold" style="color:#5C2E0A;"><?php echo e($pesanan->id_pesanan); ?></h6>
                <p class="mb-1 small text-muted">
                    <i class="fas fa-calendar me-1"></i> <?php echo e(\Carbon\Carbon::parse($pesanan->tgl_pesanan)->translatedFormat('d M Y')); ?>

                    &nbsp;•&nbsp; <?php echo e($pesanan->detailPesanan->sum('jumlah')); ?> pcs
                </p>
                <span class="badge-status badge-<?php echo e($pesanan->status_pesanan); ?>"><?php echo e(ucfirst($pesanan->status_pesanan)); ?></span>
                <?php if($pesanan->pembayaran): ?>
                <span class="badge-status badge-<?php echo e($pesanan->pembayaran->status_pembayaran); ?>">
                    <i class="fas fa-wallet me-1"></i><?php echo e(ucfirst($pesanan->pembayaran->status_pembayaran)); ?>

                </span>
                <?php endif; ?>
            </div>
            <div class="text-end">
                <p class="mb-2 fw-bold" style="color:#C9943A; font-size:1.1rem;">Rp<?php echo e(number_format($pesanan->total, 0, ',', '.')); ?></p>
                <a href="<?php echo e(route('orders.show', $pesanan->id_pesanan)); ?>" class="btn btn-sm" style="background:#C9943A; color:#fff; border-radius:20px;">
                    Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="text-center py-5">
        <i class="fas fa-box-open fa-3x mb-3" style="color:#C9943A;"></i>
        <p class="text-muted mb-3">Anda belum memiliki pesanan.</p>
        <a href="/products" class="btn" style="background:#C9943A; color:#fff; border-radius:20px; padding:10px 24px;">Mulai Belanja</a>
    </div>
    <?php endif; ?>

    <?php if(method_exists($pesanans, 'hasPages') && $pesanans->hasPages()): ?>
    <div class="mt-3"><?php echo e($pesanans->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\macahbakery\resources\views/orders/index.blade.php ENDPATH**/ ?>