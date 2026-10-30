<?php $__env->startSection('title', 'Checkout - Macah Bakery'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h1 class="text-center mb-4" style="color: #5C2E0A;">📦 Checkout</h1>

    <div class="row">
        <!-- KOLOM KIRI: FORM -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 style="color: #5C2E0A; font-weight: 600; margin-bottom: 20px;">
                    <i class="fas fa-user me-2"></i> Informasi Pengiriman
                </h5>

                <form action="<?php echo e(route('checkout.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" value="<?php echo e(Auth::user()->name); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="<?php echo e(Auth::user()->email); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Pengiriman <span class="text-danger">*</span></label>
                        <textarea name="alamat" class="form-control <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3" required placeholder="Masukkan alamat lengkap..."><?php echo e(old('alamat')); ?></textarea>
                        <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="no_telp" class="form-control" placeholder="0812-xxxx-xxxx" value="<?php echo e(old('no_telp')); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea name="catatan" class="form-control" rows="2" placeholder="Tambah catatan untuk pemesanan..."><?php echo e(old('catatan')); ?></textarea>
                        <small class="text-muted d-block mt-1" style="font-size: 11px;">
                            <i class="fas fa-info-circle me-1"></i>
                            Jika anda memesan untuk orang lain, beritahu kami dengan menuliskan NAMA PENGIRIM pada catatan.
                        </small>
                    </div>

                    <hr>

                    <h5 style="color: #5C2E0A; font-weight: 600; margin-bottom: 16px;">
                        <i class="fas fa-wallet me-2"></i> Metode Pembayaran
                    </h5>

                    <!-- ============================================================ -->
                    <!-- METODE PEMBAYARAN (DIPISAH PER GRUP)                        -->
                    <!-- ============================================================ -->

                    <!-- ===== TRANSFER BANK ===== -->
                    <div class="mb-3">
                        <label class="fw-bold mb-2" style="font-size: 13px; color: #5C2E0A;">
                            <i class="fas fa-university me-1" style="color: #C9943A;"></i> TRANSFER BANK
                        </label>
                        <div class="d-flex flex-wrap gap-2">
                            <div class="form-check p-2 rounded-3" style="border: 1px solid #F5E6D3; flex: 1; min-width: 100px;">
                                <input class="form-check-input metode-bayar-radio" type="radio" name="metode_bayar" id="bank_bca" value="Transfer Bank BCA" <?php echo e(old('metode_bayar') == 'Transfer Bank BCA' ? 'checked' : ''); ?>>
                                <label class="form-check-label w-100" for="bank_bca" style="font-size: 13px;">
                                    <i class="fas fa-building-columns me-1" style="color: #C9943A;"></i> BCA
                                </label>
                            </div>
                            <div class="form-check p-2 rounded-3" style="border: 1px solid #F5E6D3; flex: 1; min-width: 100px;">
                                <input class="form-check-input metode-bayar-radio" type="radio" name="metode_bayar" id="bank_mandiri" value="Transfer Bank Mandiri" <?php echo e(old('metode_bayar') == 'Transfer Bank Mandiri' ? 'checked' : ''); ?>>
                                <label class="form-check-label w-100" for="bank_mandiri" style="font-size: 13px;">
                                    <i class="fas fa-building-columns me-1" style="color: #C9943A;"></i> Mandiri
                                </label>
                            </div>
                            <div class="form-check p-2 rounded-3" style="border: 1px solid #F5E6D3; flex: 1; min-width: 100px;">
                                <input class="form-check-input metode-bayar-radio" type="radio" name="metode_bayar" id="bank_bri" value="Transfer Bank BRI" <?php echo e(old('metode_bayar') == 'Transfer Bank BRI' ? 'checked' : ''); ?>>
                                <label class="form-check-label w-100" for="bank_bri" style="font-size: 13px;">
                                    <i class="fas fa-building-columns me-1" style="color: #C9943A;"></i> BRI
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- ===== E-WALLET ===== -->
                    <div class="mb-3">
                        <label class="fw-bold mb-2" style="font-size: 13px; color: #5C2E0A;">
                            <i class="fas fa-wallet me-1" style="color: #C9943A;"></i> E-WALLET
                        </label>
                        <div class="d-flex flex-wrap gap-2">
                            <div class="form-check p-2 rounded-3" style="border: 1px solid #F5E6D3; flex: 1; min-width: 100px;">
                                <input class="form-check-input metode-bayar-radio" type="radio" name="metode_bayar" id="ewallet_dana" value="DANA" <?php echo e(old('metode_bayar') == 'DANA' ? 'checked' : ''); ?>>
                                <label class="form-check-label w-100" for="ewallet_dana" style="font-size: 13px;">
                                    <i class="fas fa-mobile-screen-button me-1" style="color: #C9943A;"></i> DANA
                                </label>
                            </div>
                            <div class="form-check p-2 rounded-3" style="border: 1px solid #F5E6D3; flex: 1; min-width: 100px;">
                                <input class="form-check-input metode-bayar-radio" type="radio" name="metode_bayar" id="ewallet_gopay" value="GoPay" <?php echo e(old('metode_bayar') == 'GoPay' ? 'checked' : ''); ?>>
                                <label class="form-check-label w-100" for="ewallet_gopay" style="font-size: 13px;">
                                    <i class="fas fa-mobile-screen-button me-1" style="color: #C9943A;"></i> GoPay
                                </label>
                            </div>
                            <div class="form-check p-2 rounded-3" style="border: 1px solid #F5E6D3; flex: 1; min-width: 100px;">
                                <input class="form-check-input metode-bayar-radio" type="radio" name="metode_bayar" id="ewallet_shopeepay" value="ShopeePay" <?php echo e(old('metode_bayar') == 'ShopeePay' ? 'checked' : ''); ?>>
                                <label class="form-check-label w-100" for="ewallet_shopeepay" style="font-size: 13px;">
                                    <i class="fas fa-mobile-screen-button me-1" style="color: #C9943A;"></i> ShopeePay
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- ===== QRIS ===== -->
                    <div class="mb-3">
                        <label class="fw-bold mb-2" style="font-size: 13px; color: #5C2E0A;">
                            <i class="fas fa-qrcode me-1" style="color: #C9943A;"></i> QRIS
                        </label>
                        <div class="d-flex flex-wrap gap-2">
                            <div class="form-check p-2 rounded-3" style="border: 1px solid #F5E6D3; flex: 1; min-width: 100px;">
                                <input class="form-check-input metode-bayar-radio" type="radio" name="metode_bayar" id="qris" value="QRIS" <?php echo e(old('metode_bayar') == 'QRIS' ? 'checked' : ''); ?>>
                                <label class="form-check-label w-100" for="qris" style="font-size: 13px;">
                                    <i class="fas fa-qrcode me-1" style="color: #C9943A;"></i> QRIS
                                </label>
                            </div>
                        </div>
                        <small class="text-muted d-block mt-1" style="font-size: 11px;">
                            <i class="fas fa-info-circle me-1"></i>
                            Silakan scan QRIS yang akan kami kirimkan melalui WhatsApp setelah pesanan dibuat, lalu upload bukti pembayaran di halaman status pesanan.
                        </small>
                    </div>

                    <!-- ===== COD ===== -->
                    <div class="mb-3">
                        <label class="fw-bold mb-2" style="font-size: 13px; color: #5C2E0A;">
                            <i class="fas fa-hand-holding-usd me-1" style="color: #C9943A;"></i> COD (Bayar di Tempat)
                        </label>
                        <div class="d-flex flex-wrap gap-2">
                            <div class="form-check p-2 rounded-3" style="border: 1px solid #F5E6D3; flex: 1; min-width: 100px;">
                                <input class="form-check-input metode-bayar-radio" type="radio" name="metode_bayar" id="cod" value="COD (Bayar di Tempat)" <?php echo e(old('metode_bayar') == 'COD (Bayar di Tempat)' ? 'checked' : ''); ?>>
                                <label class="form-check-label w-100" for="cod" style="font-size: 13px;">
                                    <i class="fas fa-money-bill-wave me-1" style="color: #C9943A;"></i> Bayar di Tempat
                                </label>
                            </div>
                        </div>
                        <small class="text-muted d-block mt-1" style="font-size: 11px;">
                            <i class="fas fa-info-circle me-1"></i>
                            Pembayaran dilakukan tunai langsung kepada kurir saat pesanan diantar.
                        </small>
                    </div>

                    <!-- ===== INFO TAMBAHAN ===== -->
                    <div class="p-3 mb-3" id="info-transfer" style="background: #FDF6EE; border-radius: 8px; display:none;">
                        <p class="small mb-1"><strong>Rekening Tujuan:</strong></p>
                        <p class="small mb-1">BCA: 1234567890 a.n. Macah Bakery</p>
                        <p class="small mb-2">Mandiri: 0987654321 a.n. Macah Bakery</p>
                        <label class="form-label small mb-1">Upload Bukti Transfer (opsional, bisa juga menyusul)</label>
                        <input type="file" name="bukti_bayar" class="form-control form-control-sm" accept="image/*">
                        <?php $__errorArgs = ['bukti_bayar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <button type="submit" class="btn w-100" style="background: #C9943A; color: #fff; border-radius: 30px; padding: 12px; font-weight: 600;">
                        <i class="fas fa-check me-2"></i> Buat Pesanan
                    </button>
                </form>
            </div>
        </div>

        <!-- KOLOM KANAN: RINGKASAN -->
        <div class="col-lg-5 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm rounded-4 p-4" style="position: sticky; top: 80px;">
                <h5 style="color: #5C2E0A; font-weight: 600; margin-bottom: 20px;">
                    <i class="fas fa-shopping-bag me-2"></i> Ringkasan Pesanan
                </h5>

                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex justify-content-between mb-2">
                    <span><?php echo e($item['nama_produk']); ?> <span class="text-muted">x<?php echo e($item['jumlah']); ?></span></span>
                    <span>Rp <?php echo e(number_format($item['harga'] * $item['jumlah'], 0, ',', '.')); ?></span>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <hr>

                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold">Total</span>
                    <span class="fw-bold" style="color: #C9943A; font-size: 1.2rem;">
                        Rp <?php echo e(number_format($total, 0, ',', '.')); ?>

                    </span>
                </div>

                <div class="mt-3 p-2" style="background: #FDF6EE; border-radius: 8px;">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1" style="color: #C9943A;"></i>
                        Jika anda memesan untuk orang lain, beritahu kami dengan menuliskan NAMA PENGIRIM pada catatan.
                    </small>
                </div>

                <a href="/cart" class="btn btn-outline-secondary w-100 mt-3" style="border-radius: 20px;">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Keranjang
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleMetodeInfo() {
        const selected = document.querySelector('.metode-bayar-radio:checked')?.value || '';
        const isTransfer = selected.includes('Transfer');
        const isQRIS = selected === 'QRIS';
        const isCOD = selected.includes('COD');

        document.getElementById('info-transfer').style.display = isTransfer ? 'block' : 'none';
        document.getElementById('info-qris')?.style.display = isQRIS ? 'block' : 'none';
        document.getElementById('info-cod')?.style.display = isCOD ? 'block' : 'none';
    }

    document.querySelectorAll('.metode-bayar-radio').forEach(el => el.addEventListener('change', toggleMetodeInfo));
    toggleMetodeInfo();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\macahbakery\resources\views/checkout/index.blade.php ENDPATH**/ ?>