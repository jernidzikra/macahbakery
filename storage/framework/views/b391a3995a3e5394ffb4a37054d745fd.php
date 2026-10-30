<?php $__env->startSection('title', 'Detail Pelanggan'); ?>
<?php $__env->startSection('page-title', 'Detail Pelanggan'); ?>

<?php $__env->startSection('content'); ?>

<a href="<?php echo e(route('admin.customers.index')); ?>" class="btn btn-sm btn-outline-secondary mb-3">
    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Pelanggan
</a>

<div class="row g-3 mb-3">
    <div class="col-lg-4">
        <div class="card-panel p-4 h-100">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="stat-icon" style="background:#C9943A; margin:0;"><i class="fas fa-user"></i></div>
                <div>
                    <div class="fw-bold fs-5"><?php echo e($pelanggan->nama_pelanggan); ?></div>
                    <div class="text-muted small"><?php echo e($pelanggan->id_pelanggan); ?></div>
                </div>
            </div>
            <hr>
            <p class="mb-2 small"><i class="fas fa-map-marker-alt me-2 text-muted"></i><?php echo e($pelanggan->alamat ?: '-'); ?></p>
            <p class="mb-2 small"><i class="fas fa-phone me-2 text-muted"></i><?php echo e($pelanggan->no_telp ?: '-'); ?></p>
            <p class="mb-0 small"><i class="fas fa-tag me-2 text-muted"></i>Tipe: <?php echo e($pelanggan->tipe_pelanggan ?: 'regular'); ?></p>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="row g-3 h-100">
            <div class="col-6">
                <div class="stat-card">
                    <div class="stat-icon" style="background:#8B4513;"><i class="fas fa-receipt"></i></div>
                    <div class="stat-value"><?php echo e($pesanans->count()); ?></div>
                    <div class="stat-label">Total Pesanan</div>
                </div>
            </div>
            <div class="col-6">
                <div class="stat-card">
                    <div class="stat-icon" style="background:#4CAF50;"><i class="fas fa-sack-dollar"></i></div>
                    <div class="stat-value">Rp<?php echo e(number_format($pesanans->sum('total'), 0, ',', '.')); ?></div>
                    <div class="stat-label">Total Belanja</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card-panel">
    <div class="card-panel-header">
        <span><i class="fas fa-receipt me-2" style="color:#C9943A;"></i>Riwayat Pesanan</span>
    </div>
    <div class="accordion accordion-flush" id="orderAccordion">
        <?php $__empty_1 = true; $__currentLoopData = $pesanans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#order-<?php echo e($pesanan->id_pesanan); ?>">
                    <div class="d-flex justify-content-between align-items-center w-100 me-3 flex-wrap gap-2">
                        <span class="fw-semibold"><?php echo e($pesanan->id_pesanan); ?></span>
                        <span class="text-muted small"><?php echo e(\Carbon\Carbon::parse($pesanan->tgl_pesanan)->translatedFormat('d M Y')); ?></span>
                        <span class="fw-semibold">Rp<?php echo e(number_format($pesanan->total, 0, ',', '.')); ?></span>
                        <span class="badge-status badge-<?php echo e($pesanan->status_pesanan); ?>"><?php echo e(ucfirst($pesanan->status_pesanan)); ?></span>
                    </div>
                </button>
            </h2>
            <div id="order-<?php echo e($pesanan->id_pesanan); ?>" class="accordion-collapse collapse" data-bs-parent="#orderAccordion">
                <div class="accordion-body">
                    <p class="small mb-2"><i class="fas fa-truck me-2 text-muted"></i>Dikirim ke: <?php echo e($pesanan->alamat_pengiriman ?: '-'); ?></p>
                    <table class="table table-sm mb-2">
                        <thead>
                            <tr><th>Produk</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th></tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $pesanan->detailPesanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->produk->nama_produk ?? $item->id_produk); ?></td>
                                <td><?php echo e($item->jumlah); ?></td>
                                <td>Rp<?php echo e(number_format($item->harga, 0, ',', '.')); ?></td>
                                <td>Rp<?php echo e(number_format($item->jumlah * $item->harga, 0, ',', '.')); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <a href="<?php echo e(route('admin.orders.show', $pesanan->id_pesanan)); ?>" class="btn btn-sm btn-gold">
                        <i class="fas fa-arrow-up-right-from-square me-1"></i> Kelola Pesanan Ini
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="text-center text-muted py-4">Pelanggan ini belum pernah memesan.</div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\macahbakery\resources\views/admin/customers/show.blade.php ENDPATH**/ ?>