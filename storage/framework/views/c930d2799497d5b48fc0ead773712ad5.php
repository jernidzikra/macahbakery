<?php $__env->startSection('title', 'Pesanan'); ?>
<?php $__env->startSection('page-title', 'Kelola Pesanan'); ?>

<?php $__env->startSection('content'); ?>

<div class="card-panel">
    <div class="card-panel-header d-flex align-items-center justify-content-between gap-3 flex-nowrap">
        <span class="text-nowrap"><i class="fas fa-receipt me-2" style="color:#C9943A;"></i>Semua Pesanan</span>

        <form method="GET" class="d-flex align-items-center gap-2 flex-nowrap ms-auto">
            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="min-width:160px;">
                <option value="">Semua Status</option>
                <?php $__currentLoopData = ['pending','diproses','dikirim','selesai','dibatalkan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($status); ?>" <?php echo e(request('status') == $status ? 'selected' : ''); ?>><?php echo e(ucfirst($status)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control form-control-sm" placeholder="Cari ID / nama pelanggan..." style="min-width:220px;">
            <button class="btn btn-sm btn-gold flex-shrink-0"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <style>
        /* Tetap rapi di layar sempit tanpa turun berantakan */
        @media (max-width: 767.98px) {
            .card-panel-header.flex-nowrap {
                flex-wrap: wrap !important;
            }
            .card-panel-header form.ms-auto {
                width: 100%;
                margin-left: 0 !important;
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
                    <th class="ps-3">ID Pesanan</th>
                    <th>Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Jumlah Item</th>
                    <th>Total</th>
                    <th>Status Pesanan</th>
                    <th>Pembayaran</th>
                    <th class="text-end pe-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $pesanans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="ps-3 fw-semibold"><?php echo e($pesanan->id_pesanan); ?></td>
                    <td><?php echo e($pesanan->pelanggan->nama_pelanggan ?? '-'); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($pesanan->tgl_pesanan)->translatedFormat('d M Y')); ?></td>
                    <td><?php echo e($pesanan->detailPesanan->sum('jumlah')); ?> pcs</td>
                    <td>Rp<?php echo e(number_format($pesanan->total, 0, ',', '.')); ?></td>
                    <td><span class="badge-status badge-<?php echo e($pesanan->status_pesanan); ?>"><?php echo e(ucfirst($pesanan->status_pesanan)); ?></span></td>
                    <td>
                        <?php if($pesanan->pembayaran): ?>
                            <span class="badge-status badge-<?php echo e($pesanan->pembayaran->status_pembayaran); ?>"><?php echo e(ucfirst($pesanan->pembayaran->status_pembayaran)); ?></span>
                        <?php else: ?>
                            <span class="badge-status badge-dibatalkan">Belum Bayar</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end pe-3">
                        <a href="<?php echo e(route('admin.orders.show', $pesanan->id_pesanan)); ?>" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="8" class="text-center text-muted py-4">Belum ada pesanan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($pesanans->hasPages()): ?>
    <div class="p-3 border-top">
        <?php echo e($pesanans->links()); ?>

    </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\macahbakery\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>