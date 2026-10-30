<?php $__env->startSection('title', 'Detail Pesanan ' . $pesanan->id_pesanan . ' - Macah Bakery'); ?>

<?php
    $steps = ['pending' => 'Pesanan Diterima', 'diproses' => 'Diproses', 'dikirim' => 'Dikirim', 'selesai' => 'Selesai'];
    $stepKeys = array_keys($steps);
    $currentIndex = array_search($pesanan->status_pesanan, $stepKeys);
    $isCancelled = $pesanan->status_pesanan === 'dibatalkan';
?>

<?php $__env->startSection('content'); ?>
<div class="container py-4" style="max-width: 900px;">
    <a href="<?php echo e(route('orders.index')); ?>" class="text-decoration-none small text-muted mb-3 d-inline-block">
        <i class="fas fa-arrow-left me-1"></i> Kembali ke Pesanan Saya
    </a>

    <?php if(session('success')): ?>
    <div class="alert alert-success rounded-4"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session('error')): ?>
    <div class="alert alert-danger rounded-4"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm rounded-4 p-4 mb-3">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
            <div>
                <h4 class="mb-1" style="color:#5C2E0A;">Pesanan <?php echo e($pesanan->id_pesanan); ?></h4>
                <p class="text-muted small mb-0"><i class="fas fa-calendar me-1"></i><?php echo e(\Carbon\Carbon::parse($pesanan->tgl_pesanan)->translatedFormat('d M Y')); ?></p>
            </div>
            <span class="badge-status badge-<?php echo e($pesanan->status_pesanan); ?>" style="font-size:13px; padding:8px 16px;">
                <?php echo e(ucfirst($pesanan->status_pesanan)); ?>

            </span>
        </div>

        <?php if($isCancelled): ?>
        <div class="alert alert-danger rounded-4 mb-0">
            <i class="fas fa-circle-xmark me-2"></i> Pesanan ini telah dibatalkan.
        </div>
        <?php else: ?>
        
        <div class="order-timeline">
            <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $idx = array_search($key, $stepKeys);
                $stateClass = $idx < $currentIndex ? 'done' : ($idx === $currentIndex ? 'active' : '');
            ?>
            <div class="step <?php echo e($stateClass); ?>">
                <div class="dot">
                    <?php if($stateClass === 'done'): ?>
                        <i class="fas fa-check"></i>
                    <?php else: ?>
                        <?php echo e($idx + 1); ?>

                    <?php endif; ?>
                </div>
                <div class="label"><?php echo e($label); ?></div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="row g-3">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-3">
                <h6 class="fw-bold mb-3" style="color:#5C2E0A;"><i class="fas fa-box me-2"></i>Item Pesanan</h6>
                <?php $__currentLoopData = $pesanan->detailPesanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex align-items-center gap-3 mb-3 pb-3" style="border-bottom: 1px solid #F5E6D3;">
                    <?php if($item->produk && $item->produk->foto_produk): ?>
                    <img src="<?php echo e(asset($item->produk->foto_produk)); ?>" style="width:56px;height:56px;object-fit:cover;border-radius:10px;">
                    <?php endif; ?>
                    <div class="flex-grow-1">
                        <p class="mb-0 fw-semibold"><?php echo e($item->produk->nama_produk ?? $item->id_produk); ?></p>
                        <p class="mb-0 small text-muted"><?php echo e($item->jumlah); ?> x Rp<?php echo e(number_format($item->harga, 0, ',', '.')); ?></p>
                    </div>
                    <p class="mb-0 fw-semibold">Rp<?php echo e(number_format($item->jumlah * $item->harga, 0, ',', '.')); ?></p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex justify-content-between">
                    <span class="fw-bold">Total</span>
                    <span class="fw-bold" style="color:#C9943A; font-size:1.1rem;">Rp<?php echo e(number_format($pesanan->total, 0, ',', '.')); ?></span>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h6 class="fw-bold mb-2" style="color:#5C2E0A;"><i class="fas fa-map-marker-alt me-2"></i>Alamat Pengiriman</h6>
                <p class="mb-0 small"><?php echo e($pesanan->alamat_pengiriman ?: '-'); ?></p>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h6 class="fw-bold mb-3" style="color:#5C2E0A;"><i class="fas fa-wallet me-2"></i>Pembayaran</h6>

                <?php if($pesanan->pembayaran): ?>
                    <p class="small mb-1"><strong>Metode:</strong> <?php echo e($pesanan->pembayaran->metode_bayar); ?></p>
                    <p class="small mb-1"><strong>Jumlah:</strong> Rp<?php echo e(number_format($pesanan->pembayaran->jumlah_bayar, 0, ',', '.')); ?></p>
                    <p class="small mb-2">
                        <strong>Status:</strong>
                        <span class="badge-status badge-<?php echo e($pesanan->pembayaran->status_pembayaran); ?>"><?php echo e(ucfirst($pesanan->pembayaran->status_pembayaran)); ?></span>
                    </p>

                    <?php if($pesanan->pembayaran->status_pembayaran === 'lunas'): ?>
                    <div class="alert alert-success small rounded-3 mb-0"><i class="fas fa-circle-check me-1"></i> Pembayaran sudah dikonfirmasi. Terima kasih!</div>
                    <?php elseif($pesanan->pembayaran->status_pembayaran === 'gagal'): ?>
                    <div class="alert alert-danger small rounded-3 mb-2"><i class="fas fa-circle-exclamation me-1"></i> Pembayaran gagal/ditolak. Silakan hubungi admin atau upload ulang bukti pembayaran.</div>
                    <?php else: ?>
                    <div class="alert alert-warning small rounded-3 mb-2"><i class="fas fa-clock me-1"></i> Menunggu konfirmasi pembayaran dari admin.</div>
                    <?php endif; ?>

                    <?php if($pesanan->pembayaran->bukti_bayar): ?>
                    <p class="small fw-semibold mb-1">Bukti Pembayaran:</p>
                    <img src="<?php echo e(asset($pesanan->pembayaran->bukti_bayar)); ?>" class="img-fluid rounded-3 mb-2" style="max-height:180px;">
                    <?php endif; ?>

                    <?php if(in_array($pesanan->pembayaran->status_pembayaran, ['menunggu', 'gagal']) && !str_contains($pesanan->pembayaran->metode_bayar, 'COD')): ?>
                    <form method="POST" action="<?php echo e(route('orders.uploadBukti', $pesanan->id_pesanan)); ?>" enctype="multipart/form-data" class="mt-2">
                        <?php echo csrf_field(); ?>
                        <label class="form-label small mb-1"><?php echo e($pesanan->pembayaran->bukti_bayar ? 'Ganti' : 'Upload'); ?> Bukti Pembayaran</label>
                        <input type="file" name="bukti_bayar" class="form-control form-control-sm mb-2" accept="image/*" required>
                        <button type="submit" class="btn btn-sm w-100" style="background:#C9943A; color:#fff; border-radius:20px;">
                            <i class="fas fa-upload me-1"></i> Kirim Bukti
                        </button>
                    </form>
                    <?php endif; ?>
                <?php else: ?>
                    <p class="text-muted small mb-0">Data pembayaran tidak ditemukan.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\macahbakery\resources\views/orders/show.blade.php ENDPATH**/ ?>