

<?php $__env->startSection('title', 'Lokasi Toko - Macah Bakery'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="text-center mb-4" style="color: #5C2E0A; font-weight: 700; position: relative;">
        📍 Lokasi Toko Kami
        <span style="display: block; width: 60px; height: 4px; background: #C9943A; margin: 10px auto 0; border-radius: 4px;"></span>
    </h2>

    <div class="row g-4 align-items-stretch">
        <!-- KOLOM KIRI: INFO LOKASI -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-4">
                <h4 style="color: #5C2E0A;">
                    <i class="fas fa-store me-2" style="color: #C9943A;"></i>
                    Macah Bakery - Sawangan Depok
                </h4>
                <p class="text-muted mt-3" style="font-size: 14px; line-height: 1.8;">
                    <i class="fas fa-map-marker-alt me-2" style="color: #C9943A; width: 20px;"></i>
                    Eden Sports Center, Jl. Raya Pengasinan, RT.0.4/RW.01, Pengasinan, Kec. Sawangan, Kota Depok, Jawa Barat 16518
                </p>
                <p style="font-size: 14px;">
                    <i class="fas fa-clock me-2" style="color: #C9943A; width: 20px;"></i>
                    08.00 - 21.00 WIB
                </p>
                <p style="font-size: 14px;">
                    <i class="fas fa-phone me-2" style="color: #C9943A; width: 20px;"></i>
                    0812-1122-1984
                </p>
                <div class="d-flex gap-2 flex-wrap mt-2">
                    <a href="https://www.google.com/maps/place/Eden+Sports+Center/@-6.4240858,106.7492159,17z/data=!3m1!4b1!4m6!3m5!1s0x2e69e929bdf16a11:0x7f030940c827157!8m2!3d-6.4240911!4d106.7517908!16s%2Fg%2F11sd2yqtdj?entry=ttu&g_ep=EgoyMDI2MDYyMi4wIKXMDSoASAFQAw%3D%3D" 
                       target="_blank" class="btn" style="background: #C9943A; color: #fff; border-radius: 20px; padding: 8px 20px; font-size: 13px;">
                        <i class="fas fa-directions me-1"></i> Google Maps
                    </a>
                    <a href="https://wa.me/6281211221984" class="btn btn-success" style="border-radius: 20px; padding: 8px 20px; font-size: 13px;">
                        <i class="fab fa-whatsapp me-1"></i> WhatsApp
                    </a>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: GOOGLE MAPS -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.500526815293!2d106.7492159!3d-6.4240858!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e929bdf16a11%3A0x7f030940c827157!2sEden%20Sports%20Center!5e0!3m2!1sid!2sid!4v1719999999999" 
                    width="100%" 
                    height="100%" 
                    style="border:0; min-height: 400px;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="text-center mt-4">
        <a href="/" class="btn" style="background: #C9943A; color: #fff; border-radius: 30px; padding: 10px 35px;">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\macahbakery\resources\views/about.blade.php ENDPATH**/ ?>