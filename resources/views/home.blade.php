@extends('layouts.app')

@section('title', 'Macah Bakery - Kue & Oleh-oleh Khas Bandung')

@section('content')
<!--- HERO SECTION --->
<section class="hero-section" style="
    background: linear-gradient(135deg, #2C1810 0%, #5C2E0A 50%, #8B4513 100%);
    min-height: 550px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    padding: 40px 0;
    ">
    <!-- Decorative bulatan -->
    <div style="
        position: absolute;
        right: -100px;
        top: -100px;
        width: 400px;
        height: 400px;
        border-radius: 50%;
        background: rgba(244, 208, 63, 0.06);
        "></div>
    <div style="
        position: absolute;
        left: -150px;
        bottom: -150px;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: rgba(244, 208, 63, 0.04);
        "></div>

    <div class="container position-relative" style="z-index: 2;">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">

                <!--- MACAH BAKERY (CSS, TIDAK KEPOTONG) --->
                <h1 style="
                    font-family: 'Playfair Display', serif;
                    font-size: 4.5rem;
                    font-weight: 700;
                    color: #F4D03F;
                    letter-spacing: 6px;
                    text-shadow: 0 2px 20px rgba(0,0,0,0.3);
                    margin-bottom: 10px;
                ">
                    Macah Bakery
                </h1>

                <!--- TAGLINE --->
                <h2 style="
                    font-family: 'Playfair Display', serif;
                    font-size: 1.8rem;
                    font-weight: 500;
                    color: #fff;
                    line-height: 1.4;
                    text-shadow: 0 2px 20px rgba(0,0,0,0.2);
                    margin-bottom: 16px;
                    letter-spacing: 1px;
                ">
                    Temani Setiap Momen<br>
                    <span style="color: #F4D03F; font-weight: 600;">Dengan Rasa yang Berkesan</span>
                </h2>

                <!-- Deskripsi -->
                <p style="
                    font-size: 1rem;
                    color: rgba(255,255,255,0.7);
                    max-width: 550px;
                    margin: 0 auto 24px;
                    line-height: 1.7;
                ">
                    Nikmati berbagai pilihan bakery, cake, dan hampers yang cocok untuk keluarga, sahabat, dan orang terkasih.
                </p>

                <!-- Tombol -->
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="/products" class="btn btn-lg" style="
                        background: #F4D03F;
                        color: #5C2E0A;
                        border-radius: 30px;
                        padding: 12px 40px;
                        font-weight: 700;
                        box-shadow: 0 4px 20px rgba(244, 208, 63, 0.3);
                        transition: all 0.3s;
                    ">
                        <i class="fas fa-shopping-bag me-2"></i> Belanja Sekarang
                    </a>
                    <a href="/products" class="btn btn-lg" style="
                        background: rgba(255,255,255,0.08);
                        backdrop-filter: blur(6px);
                        color: #fff;
                        border-radius: 30px;
                        padding: 12px 40px;
                        font-weight: 600;
                        border: 2px solid rgba(255,255,255,0.25);
                        transition: all 0.3s;
                    ">
                        <i class="fas fa-eye me-2"></i> Lihat Katalog
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!--- KATEGORI PRODUK ----->
<section class="py-5" style="background: #FDF6EE;">
    <div class="container">
        <h2 class="text-center mb-5" style="color: #5C2E0A; font-weight: 700; position: relative;">
            Kategori Produk
            <span style="display: block; width: 60px; height: 4px; background: #C9943A; margin: 10px auto 0; border-radius: 4px;"></span>
        </h2>
        <div class="row g-4 justify-content-center">
            @php
                $kategoriList = [
                    ['name' => 'Roti & Kue', 'image' => 'images/products/donat ring.jpg', 'link' => 'Roti-Kue', 'color' => '#D4A373'],
                    ['name' => 'Bolu', 'image' => 'images/products/bolu tape keju.jpg', 'link' => 'Bolu', 'color' => '#F4A261'],
                    ['name' => 'Kue Lebaran', 'image' => 'images/products/nastar.jpg', 'link' => 'Kue Lebaran', 'color' => '#E76F51'],
                    ['name' => 'Hampers', 'image' => 'images/products/hempers 1.png', 'link' => 'Hampers', 'color' => '#2A9D8F'],
                ];
            @endphp
            @foreach($kategoriList as $kat)
            <div class="col-6 col-md-3 text-center">
                <a href="/products?kategori={{ $kat['link'] }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden kategori-card" 
                         style="transition: all 0.3s; background: #fff; cursor: pointer;">
                        <div style="height: 180px; overflow: hidden; background: #F5EDE5;">
                            <img src="{{ asset($kat['image']) }}" 
                                 alt="{{ $kat['name'] }}" 
                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;"
                                 onerror="this.src='https://placehold.co/300x200/F5E6D3/8B4513?text={{ urlencode($kat['name']) }}'">
                        </div>
                        <div class="py-3" style="background: #fff;">
                            <p class="mb-0 fw-bold" style="color: #5C2E0A; font-size: 15px;">{{ $kat['name'] }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .kategori-card {
        transition: all 0.3s ease;
    }
    .kategori-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.15) !important;
    }
    .kategori-card:hover img {
        transform: scale(1.08);
    }
</style>

<!--- PRODUK TERLARIS --->
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 style="color: #5C2E0A; font-weight: 700;">Produk Terlaris</h2>
            <a href="/products" class="text-decoration-none" style="color: #C9943A;">Lihat Semua →</a>
        </div>
        <div class="row g-4">
            @forelse($bestSellers as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 h-100" style="overflow: hidden; transition: transform 0.3s;">
                    <div style="height: 200px; background: #FDF6EE; overflow: hidden;">
                        <img src="{{ $product->foto_produk ? asset($product->foto_produk) : 'https://placehold.co/300x300/F5E6D3/8B4513?text='.urlencode($product->nama_produk) }}" 
                             class="w-100 h-100" alt="{{ $product->nama_produk }}" style="object-fit: cover;">
                    </div>
                    <div class="card-body">
                        <h6 class="card-title" style="color: #5C2E0A; font-weight: 600;">{{ $product->nama_produk }}</h6>
                        <p class="fw-bold" style="color: #C9943A;">Rp {{ number_format($product->harga_produk, 0, ',', '.') }}</p>
                        <a href="/products/{{ $product->id_produk }}" class="btn btn-sm w-100" style="background: #C9943A; color: #fff; border-radius: 20px;">
                            <i class="fas fa-shopping-bag me-1"></i> Beli Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-4">
                <p class="text-muted">Belum ada data produk</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!--- PROGRAM GRATIS ONGKIR --->
<section class="py-5" style="background: linear-gradient(135deg, #5C2E0A, #8B4513);">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-white" style="font-family: 'Playfair Display', serif;">
                <span style="color: #F4D03F;">Program Gratis Ongkir
            </h2>
            <p class="text-white-50">Nikmati gratis ongkir untuk setiap pembelian di Macah Bakery!</p>
        </div>
        
        <div class="row g-3 justify-content-center">
            <!-- DEPOK -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 rounded-4 p-3 text-center h-100" style="background: rgba(255,255,255,0.12); backdrop-filter: blur(10px); color: #fff;">
                    <div style="font-size: 2rem; margin-bottom: 5px;">📍</div>
                    <h6 class="fw-bold mb-1" style="color: #F4D03F;">DEPOK</h6>
                    <p class="mb-0" style="font-size: 13px;">Min Order</p>
                    <p class="fw-bold" style="font-size: 18px; color: #F4D03F;">Rp 40.000</p>
                </div>
            </div>
            
            <!-- JAKSEL TANGSEL -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 rounded-4 p-3 text-center h-100" style="background: rgba(255,255,255,0.12); backdrop-filter: blur(10px); color: #fff;">
                    <div style="font-size: 2rem; margin-bottom: 5px;">📍</div>
                    <h6 class="fw-bold mb-1" style="color: #F4D03F;">JAKSEL · TANGSEL</h6>
                    <p class="mb-0" style="font-size: 13px;">Min Order</p>
                    <p class="fw-bold" style="font-size: 18px; color: #F4D03F;">Rp 60.000</p>
                </div>
            </div>
            
            <!-- JAKTIM · JAKPUS -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 rounded-4 p-3 text-center h-100" style="background: rgba(255,255,255,0.12); backdrop-filter: blur(10px); color: #fff;">
                    <div style="font-size: 2rem; margin-bottom: 5px;">📍</div>
                    <h6 class="fw-bold mb-1" style="color: #F4D03F;">JAKTIM · JAKPUS</h6>
                    <p class="mb-0" style="font-size: 13px;">Min Order</p>
                    <p class="fw-bold" style="font-size: 18px; color: #F4D03F;">Rp 70.000</p>
                </div>
            </div>
            
            <!-- JAKUT · JAKBAR -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 rounded-4 p-3 text-center h-100" style="background: rgba(255,255,255,0.12); backdrop-filter: blur(10px); color: #fff;">
                    <div style="font-size: 2rem; margin-bottom: 5px;">📍</div>
                    <h6 class="fw-bold mb-1" style="color: #F4D03F;">JAKUT · JAKBAR</h6>
                    <p class="mb-0" style="font-size: 13px;">Min Order</p>
                    <p class="fw-bold" style="font-size: 18px; color: #F4D03F;">Rp 80.000</p>
                </div>
            </div>
            
            <!-- BOGOR · GUN.SINDUR -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 rounded-4 p-3 text-center h-100" style="background: rgba(255,255,255,0.12); backdrop-filter: blur(10px); color: #fff;">
                    <div style="font-size: 2rem; margin-bottom: 5px;">📍</div>
                    <h6 class="fw-bold mb-1" style="color: #F4D03F;">BOGOR · GUN.SINDUR</h6>
                    <p class="mb-0" style="font-size: 13px;">Min Order</p>
                    <p class="fw-bold" style="font-size: 18px; color: #F4D03F;">Rp 40.000</p>
                </div>
            </div>
            
            <!-- TANGERANG -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 rounded-4 p-3 text-center h-100" style="background: rgba(255,255,255,0.12); backdrop-filter: blur(10px); color: #fff;">
                    <div style="font-size: 2rem; margin-bottom: 5px;">📍</div>
                    <h6 class="fw-bold mb-1" style="color: #F4D03F;">TANGERANG</h6>
                    <p class="mb-0" style="font-size: 13px;">Min Order</p>
                    <p class="fw-bold" style="font-size: 18px; color: #F4D03F;">Rp 100.000</p>
                </div>
            </div>
            
            <!-- BOGOR KOTA -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 rounded-4 p-3 text-center h-100" style="background: rgba(255,255,255,0.12); backdrop-filter: blur(10px); color: #fff;">
                    <div style="font-size: 2rem; margin-bottom: 5px;">📍</div>
                    <h6 class="fw-bold mb-1" style="color: #F4D03F;">BOGOR KOTA</h6>
                    <p class="mb-0" style="font-size: 13px;">Min Order</p>
                    <p class="fw-bold" style="font-size: 18px; color: #F4D03F;">Rp 100.000</p>
                </div>
            </div>
        </div>
        
        <!-- CTA WhatsApp -->
        <div class="text-center mt-5">
            <a href="https://wa.me/6281211221984?text=Halo%20Macah%20Bakery%2C%20saya%20mau%20order" 
               class="btn btn-lg" 
               target="_blank"
               style="background: #25D366; color: #fff; border-radius: 30px; padding: 14px 50px; font-weight: 700; box-shadow: 0 4px 20px rgba(37,211,102,0.3);">
                <i class="fab fa-whatsapp me-2"></i> Order? WA 0812-1122-1984
            </a>
        </div>
    </div>
</section>

<!--- TENTANG KAMI --->
<section class="py-5" style="background: #FDF6EE;">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- KOLOM KIRI: TEKS -->
            <div class="col-lg-6">
                <h2 style="color: #5C2E0A; font-weight: 700; position: relative; padding-bottom: 15px;">
                    Tentang Macah Bakery
                    <span style="display: block; width: 60px; height: 4px; background: #C9943A; margin-top: 10px; border-radius: 4px;"></span>
                </h2>
                <p style="color: #5D4037; font-size: 1.05rem; line-height: 1.9;">
                    Macah Bakery adalah usaha bakery yang menyediakan berbagai pilihan dessert, kue, roti, dan hampers untuk berbagai kebutuhan dan acara spesial. 
                </p>
                <p style="color: #5D4037; font-size: 1.05rem; line-height: 1.9;">
                    Dengan bahan yang berkualitas dan proses pembuatan yang higienis, Macah Bakery berkomitmen memberikan produk terbaik serta pelayanan yang baik kepada setiap pelanggan.
                </p>
            </div>
            
            <!-- KOLOM KANAN: GAMBAR/LOGO -->
            <div class="col-lg-6 text-center">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="background: #fff; padding: 20px;">
                    <div style="background: #FDF6EE; border-radius: 16px; padding: 30px;">
                        <img src="{{ asset('images/logo-macah.jpg') }}" 
                             alt="Macah Bakery" 
                             style="max-width: 100%; max-height: 300px; width: auto;"
                             onerror="this.src='https://placehold.co/400x300/F5E6D3/8B4513?text=Macah+Bakery'">
                    </div>
                    <div style="margin-top: 15px;">
                        <h5 style="color: #5C2E0A; font-weight: 700;">Macah Bakery</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--- TESTIMONI --->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5" style="color: #5C2E0A; font-weight: 700;">💬 Apa Kata Pelanggan Kami</h2>
        <div class="row g-4">
            @forelse($testimonials as $testimonial)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 50px; height: 50px; background: #C9943A; color: #fff; font-weight: bold; font-size: 18px;">
                            {{ substr($testimonial->pelanggan->nama_pelanggan ?? 'A', 0, 1) }}
                        </div>
                        <div>
                            <h6 class="mb-0" style="color: #5C2E0A;">{{ $testimonial->pelanggan->nama_pelanggan ?? 'Anonymous' }}</h6>
                            <div>
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}" style="font-size: 12px;"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 text-muted" style="font-size: 14px;">"{{ $testimonial->komentar ?? 'Produknya enak banget!' }}"</p>
                    <small class="text-muted">- {{ $testimonial->produk->nama_produk ?? '' }}</small>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-4">
                <p class="text-muted">Belum ada ulasan</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!--- LOKASI TOKO --->
<section class="py-5" style="background: #FDF6EE;">
    <div class="container">
        <h2 class="text-center mb-5" style="color: #5C2E0A; font-weight: 700; position: relative;">
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
                        <a href="https://wa.me/6281211221984?text=Halo%20Macah%20Bakery%2C%20saya%20mau%20order" class="btn btn-success" style="border-radius: 20px; padding: 8px 20px; font-size: 13px;">
                            <i class="fab fa-whatsapp me-1"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- KOLOM KANAN: GOOGLE MAPS IFrame -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div style="height: 100%; min-height: 350px; width: 100%;">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.500526815293!2d106.7492159!3d-6.4240858!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e929bdf16a11%3A0x7f030940c827157!2sEden%20Sports%20Center!5e0!3m2!1sid!2sid!4v1719999999999" 
                            width="100%" 
                            height="100%" 
                            style="border:0; min-height: 350px;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection