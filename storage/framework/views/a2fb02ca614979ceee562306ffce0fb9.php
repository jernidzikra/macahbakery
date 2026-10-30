<?php $__env->startSection('title', 'Produk'); ?>
<?php $__env->startSection('page-title', 'Kelola Produk'); ?>

<?php $__env->startSection('content'); ?>

<div class="card-panel">
    <div class="card-panel-header d-flex align-items-center justify-content-between gap-3 flex-nowrap">
        <span class="text-nowrap"><i class="fas fa-box-open me-2" style="color:#C9943A;"></i>Semua Produk</span>

        <div class="d-flex align-items-center gap-2 flex-nowrap ms-auto">
            <form method="GET" class="d-flex align-items-center gap-2 flex-nowrap">
                <select name="kategori" class="form-select form-select-sm" onchange="this.form.submit()" style="min-width:160px;">
                    <option value="">Semua Kategori</option>
                    <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($kategori); ?>" <?php echo e(request('kategori') == $kategori ? 'selected' : ''); ?>><?php echo e($kategori); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control form-control-sm" placeholder="Cari produk..." style="min-width:220px;">
                <button class="btn btn-sm btn-outline-secondary flex-shrink-0"><i class="fas fa-search"></i></button>
            </form>

            <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-sm btn-gold text-nowrap flex-shrink-0">
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
                <?php $__empty_1 = true; $__currentLoopData = $produks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="ps-3">
                        <?php if($produk->foto_produk && file_exists(public_path($produk->foto_produk))): ?>
                            <img src="<?php echo e(asset($produk->foto_produk)); ?>" class="prod-thumb" alt="<?php echo e($produk->nama_produk); ?>">
                        <?php else: ?>
                            <div class="prod-thumb bg-light d-flex align-items-center justify-content-center text-muted">
                                <i class="fas fa-image"></i>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="fw-semibold"><?php echo e($produk->nama_produk); ?></div>
                        <div class="text-muted small"><?php echo e($produk->id_produk); ?></div>
                    </td>
                    <td><span class="badge bg-light text-dark border"><?php echo e($produk->kategori ?: '-'); ?></span></td>
                    <td>Rp<?php echo e(number_format($produk->harga_produk, 0, ',', '.')); ?></td>
                    <td>
                        <span class="badge <?php echo e($produk->stok_produk <= 10 ? 'bg-danger' : 'bg-success'); ?>">
                            <?php echo e($produk->stok_produk); ?> pcs
                        </span>
                    </td>
                    <td><?php echo e($produk->terjual); ?></td>
                    <td class="text-end pe-3">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?php echo e(route('admin.products.edit', $produk->id_produk)); ?>" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form method="POST" action="<?php echo e(route('admin.products.destroy', $produk->id_produk)); ?>" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data produk.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($produks->hasPages()): ?>
    <div class="p-3 border-top">
        <?php echo e($produks->links()); ?>

    </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\macahbakery\resources\views/admin/products/index.blade.php ENDPATH**/ ?>