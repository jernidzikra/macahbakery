<?php $__env->startSection('title', 'Pelanggan'); ?>
<?php $__env->startSection('page-title', 'Daftar Pelanggan'); ?>

<?php $__env->startSection('content'); ?>

<div class="card-panel">
    <div class="card-panel-header">
        <span><i class="fas fa-users me-2" style="color:#C9943A;"></i>Semua Pelanggan</span>
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control form-control-sm" placeholder="Cari nama / ID / no. telp..." style="min-width:230px;">
            <button class="btn btn-sm btn-gold"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-admin mb-0">
            <thead>
                <tr>
                    <th class="ps-3">ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Tipe</th>
                    <th>Jumlah Pesanan</th>
                    <th>Total Belanja</th>
                    <th class="text-end pe-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $pelanggans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pelanggan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="ps-3 fw-semibold"><?php echo e($pelanggan->id_pelanggan); ?></td>
                    <td><?php echo e($pelanggan->nama_pelanggan); ?></td>
                    <td class="text-muted small"><?php echo e(\Illuminate\Support\Str::limit($pelanggan->alamat, 40) ?: '-'); ?></td>
                    <td><?php echo e($pelanggan->no_telp ?: '-'); ?></td>
                    <td><span class="badge bg-light text-dark border"><?php echo e($pelanggan->tipe_pelanggan ?: 'regular'); ?></span></td>
                    <td><?php echo e($pelanggan->pesanan_count); ?></td>
                    <td>Rp<?php echo e(number_format($pelanggan->total_belanja ?? 0, 0, ',', '.')); ?></td>
                    <td class="text-end pe-3">
                        <a href="<?php echo e(route('admin.customers.show', $pelanggan->id_pelanggan)); ?>" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="8" class="text-center text-muted py-4">Belum ada data pelanggan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($pelanggans->hasPages()): ?>
    <div class="p-3 border-top">
        <?php echo e($pelanggans->links()); ?>

    </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\macahbakery\resources\views/admin/customers/index.blade.php ENDPATH**/ ?>