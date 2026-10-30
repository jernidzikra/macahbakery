<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#C9943A;"><i class="fas fa-users"></i></div>
            <div class="stat-value"><?php echo e($totalPelanggan); ?></div>
            <div class="stat-label">Total Pelanggan</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#8B4513;"><i class="fas fa-receipt"></i></div>
            <div class="stat-value"><?php echo e($totalPesanan); ?></div>
            <div class="stat-label">Total Pesanan</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#5C2E0A;"><i class="fas fa-box-open"></i></div>
            <div class="stat-value"><?php echo e($totalProduk); ?></div>
            <div class="stat-label">Total Produk</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#4CAF50;"><i class="fas fa-sack-dollar"></i></div>
            <div class="stat-value">Rp<?php echo e(number_format($totalPendapatan, 0, ',', '.')); ?></div>
            <div class="stat-label">Pendapatan (Selesai)</div>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-lg-6">
        <div class="card-panel h-100">
            <div class="card-panel-header">
                <span><i class="fas fa-chart-pie me-2" style="color:#C9943A;"></i>Status Pesanan</span>
            </div>
            <div class="p-3">
                <?php
                    $statuses = ['pending' => 'Pending', 'diproses' => 'Diproses', 'dikirim' => 'Dikirim', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'];
                ?>
                <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge-status badge-<?php echo e($key); ?>"><?php echo e($label); ?></span>
                        <span class="fw-semibold"><?php echo e($statusPesananCount[$key] ?? 0); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card-panel h-100">
            <div class="card-panel-header">
                <span><i class="fas fa-triangle-exclamation me-2" style="color:#C9943A;"></i>Stok Menipis</span>
                <a href="<?php echo e(route('admin.products.index')); ?>" class="small text-decoration-none">Kelola <i class="fas fa-arrow-right"></i></a>
            </div>
            <ul class="list-group list-group-flush">
                <?php $__empty_1 = true; $__currentLoopData = $produkStokMenipis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="small"><?php echo e($produk->nama_produk); ?></span>
                        <span class="badge <?php echo e($produk->stok_produk <= 10 ? 'bg-danger' : 'bg-secondary'); ?>"><?php echo e($produk->stok_produk); ?> pcs</span>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li class="list-group-item text-muted small text-center py-3">Belum ada data produk.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-12">
        <div class="card-panel">
            <div class="card-panel-header">
                <span><i class="fas fa-clock-rotate-left me-2" style="color:#C9943A;"></i>Pesanan Terbaru</span>
                <a href="<?php echo e(route('admin.orders.index')); ?>" class="small text-decoration-none">Lihat semua <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="table-responsive">
                <table class="table table-admin mb-0">
                    <thead>
                        <tr>
                            <th class="ps-3">ID Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $pesananTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="ps-3">
                                <a href="<?php echo e(route('admin.orders.show', $pesanan->id_pesanan)); ?>" class="text-decoration-none fw-semibold">
                                    <?php echo e($pesanan->id_pesanan); ?>

                                </a>
                            </td>
                            <td><?php echo e($pesanan->pelanggan->nama_pelanggan ?? '-'); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($pesanan->tgl_pesanan)->translatedFormat('d M Y')); ?></td>
                            <td>Rp<?php echo e(number_format($pesanan->total, 0, ',', '.')); ?></td>
                            <td><span class="badge-status badge-<?php echo e($pesanan->status_pesanan); ?>"><?php echo e(ucfirst($pesanan->status_pesanan)); ?></span></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada pesanan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\macahbakery\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>