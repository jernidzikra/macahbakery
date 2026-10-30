<?php $__env->startSection('title', 'Edit Produk'); ?>
<?php $__env->startSection('page-title', 'Edit Produk'); ?>

<?php $__env->startSection('content'); ?>

<a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-sm btn-outline-secondary mb-3">
    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Produk
</a>

<div class="card-panel">
    <div class="card-panel-header"><span><i class="fas fa-pen me-2" style="color:#C9943A;"></i><?php echo e($produk->nama_produk); ?> <span class="text-muted small">(<?php echo e($produk->id_produk); ?>)</span></span></div>
    <div class="p-4">
        <form method="POST" action="<?php echo e(route('admin.products.update', $produk->id_produk)); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <?php echo $__env->make('admin.products._form', ['produk' => $produk], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <button type="submit" class="btn btn-gold mt-2">
                <i class="fas fa-save me-1"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\macahbakery\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>