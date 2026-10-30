<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Macah Bakery')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --brown-dark:   #5C2E0A;
            --brown-mid:    #8B4513;
            --brown-warm:   #C1622A;
            --cream-light:  #FDF6EE;
            --cream-mid:    #F5E6D3;
            --gold:         #C9943A;
            --text-dark:    #2C1810;
            --text-mid:     #5D4037;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--cream-light);
            color: var(--text-dark);
            margin: 0;
        }

        /* ===== NAVBAR ===== */
        .main-navbar {
            background: #fff;
            border-bottom: 1px solid var(--cream-mid);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 12px rgba(92,46,10,0.07);
        }
        .main-navbar .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 68px;
            position: relative;
            flex-wrap: nowrap;
        }
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--brown-dark) !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }
        .navbar-brand .brand-logo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .navbar-brand .brand-icon-fallback {
            width: 40px;
            height: 40px;
            background: var(--brown-dark);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            font-size: 18px;
            flex-shrink: 0;
        }
        .nav-links {
            display: flex;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 2px;
        }
        .nav-links li a {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            color: var(--text-mid);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .nav-links li a:hover {
            color: var(--brown-dark);
            background: var(--cream-mid);
        }
        .cart-badge {
            background: var(--brown-warm);
            color: #fff;
            font-size: 11px;
            padding: 2px 6px;
            border-radius: 20px;
            font-weight: 600;
        }
        .navbar-toggler {
            display: none;
            border: none;
            padding: 8px;
            color: var(--brown-dark);
            background: none;
            cursor: pointer;
            flex-shrink: 0;
        }

        /* ===== MOBILE NAVBAR ===== */
        @media (max-width: 991px) {
            .navbar-toggler {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .nav-links {
                display: none;
                flex-direction: column;
                align-items: stretch;
                position: absolute;
                top: 68px;
                left: 0;
                right: 0;
                background: #fff;
                border-top: 1px solid var(--cream-mid);
                padding: 12px 20px;
                box-shadow: 0 8px 24px rgba(0,0,0,0.1);
                gap: 4px;
            }
            .nav-links.open { display: flex; }
            .nav-links li { width: 100%; }
            .nav-links li a { border-radius: 8px; }
        }

        /* MAIN */
        main { min-height: 60vh; }

        /* ===== ORDER/PAYMENT STATUS BADGES ===== */
        .badge-status { font-size: 11.5px; padding: 5px 12px; border-radius: 20px; font-weight: 600; display: inline-block; }
        .badge-pending { background: #FFF3CD; color: #8a6d1c; }
        .badge-diproses { background: #D6E4FF; color: #1c4b8a; }
        .badge-dikirim { background: #E0D6FF; color: #5b2c8a; }
        .badge-selesai { background: #D4EDDA; color: #1e7e34; }
        .badge-dibatalkan { background: #F8D7DA; color: #a12833; }
        .badge-menunggu { background: #FFF3CD; color: #8a6d1c; }
        .badge-lunas { background: #D4EDDA; color: #1e7e34; }
        .badge-gagal { background: #F8D7DA; color: #a12833; }

        /* ===== ORDER TRACKING TIMELINE ===== */
        .order-timeline { display: flex; justify-content: space-between; position: relative; margin: 30px 0; }
        .order-timeline::before {
            content: ''; position: absolute; top: 18px; left: 0; right: 0; height: 3px;
            background: var(--cream-mid); z-index: 0;
        }
        .order-timeline .step { flex: 1; text-align: center; position: relative; z-index: 1; }
        .order-timeline .step .dot {
            width: 36px; height: 36px; border-radius: 50%; background: #fff;
            border: 3px solid var(--cream-mid); display: flex; align-items: center; justify-content: center;
            margin: 0 auto 8px; color: var(--cream-mid); font-size: 14px;
        }
        .order-timeline .step.active .dot { border-color: var(--gold); background: var(--gold); color: #fff; }
        .order-timeline .step.done .dot { border-color: var(--gold); background: #fff; color: var(--gold); }
        .order-timeline .step .label { font-size: 12px; color: var(--text-mid); font-weight: 500; }
        .order-timeline .step.active .label, .order-timeline .step.done .label { color: var(--brown-dark); font-weight: 600; }

        /* ===== FOOTER ===== */
        .footer {
            background: var(--brown-dark);
            color: rgba(255,255,255,0.85);
            padding: 60px 0 0;
            margin-top: 80px;
        }
        .footer-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: #fff;
            margin-bottom: 12px;
        }
        .footer p, .footer address {
            font-size: 14px;
            line-height: 1.7;
            font-style: normal;
        }
        .footer-heading {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--gold);
            margin-bottom: 16px;
            font-weight: 600;
        }
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer-links li { margin-bottom: 10px; }
        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }
        .footer-links a:hover { color: var(--gold); }
        .footer-social {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .footer-social a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 15px;
            transition: all 0.2s;
        }
        .footer-social a:hover {
            background: var(--gold);
            border-color: var(--gold);
            color: #fff;
        }
        .footer-marketplace {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .market-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .market-link:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
            border-color: rgba(255,255,255,0.3);
        }
        .market-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding: 20px 0;
            margin-top: 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }
        .footer-bottom p {
            margin: 0;
            font-size: 13px;
            color: rgba(255,255,255,0.5);
        }
        .footer-ops {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.08);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            color: rgba(255,255,255,0.7);
        }
        .footer-ops .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
            animation: blink 2s infinite;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        /* ===== WHATSAPP FLOAT ===== */
        .wa-float {
            position: fixed;
            bottom: 28px;
            right: 28px;
            width: 56px;
            height: 56px;
            background: #25D366;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #fff;
            text-decoration: none;
            z-index: 999;
            box-shadow: 0 4px 20px rgba(37,211,102,0.45);
            transition: transform 0.2s;
        }
        .wa-float:hover {
            transform: scale(1.08);
            color: #fff;
        }
        .btn-primary {
            background: #C9943A;
            border: none;
        }
        .btn-primary:hover {
            background: #8B4513;
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- NAVBAR --}}
<nav class="main-navbar">
    <div class="container">

        {{-- LOGO + NAMA (kiri) --}}
        <a href="/" class="navbar-brand">
            <img src="{{ asset('images/logo-macah.jpg') }}"
                 alt="Macah Bakery"
                 class="brand-logo"
                 onerror="this.style.display='none'; document.getElementById('brand-icon-fallback').style.display='flex';">
            <div class="brand-icon-fallback" id="brand-icon-fallback" style="display:none;">
                <i class="fas fa-bread-slice"></i>
            </div>
            Macah Bakery
        </a>

        {{-- MENU LINKS (kanan, desktop) --}}
        <ul class="nav-links" id="navLinks">
            <li><a href="/">Beranda</a></li>
            <li><a href="/products">Belanja</a></li>
            <li><a href="/about">Lokasi Toko</a></li>
            <li><a href="/ulasan"><i class="fas fa-star"></i> Ulasan</a></li>
            <li>
                <a href="/cart">
                    <i class="fas fa-shopping-bag"></i> Keranjang
                    <span class="cart-badge" id="cart-count">{{ session()->get('cart_count', 0) }}</span>
                </a>
            </li>
            @auth
            <li>
                <a href="{{ route('orders.index') }}">
                    <i class="fas fa-receipt"></i> Pesanan Saya
                </a>
            </li>
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="/logout" method="POST" style="display:none;">
                    @csrf
                </form>
            </li>
            @else
            <li><a href="/login"><i class="fas fa-sign-in-alt"></i> Login</a></li>
            @endauth
        </ul>

        {{-- HAMBURGER (ujung kanan, mobile only) --}}
        <button class="navbar-toggler" onclick="document.getElementById('navLinks').classList.toggle('open')" aria-label="Toggle navigation">
            <i class="fas fa-bars fa-lg"></i>
        </button>

    </div>
</nav>

{{-- MAIN CONTENT --}}
<main>
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="footer">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="footer-brand"><i class="fas fa-bread-slice me-2" style="color: var(--gold)"></i>Macah Bakery</div>
                <p>Toko kue dan oleh-oleh khas Bandung dengan bahan berkualitas dan resep turun-temurun.</p>
                <address>
                    <div class="mb-1"><i class="fas fa-map-marker-alt me-2" style="color: var(--gold)"></i>Eden Sports Center, Jl. Raya Pengasinan, RT.0.4/RW.01, Pengasinan, Kec. Sawangan, Kota Depok, Jawa Barat 16518</div>
                    <div class="mb-1"><i class="fas fa-phone-alt me-2" style="color: var(--gold)"></i>0812-1122-1984</div>
                    <div><i class="fas fa-clock me-2" style="color: var(--gold)"></i>07:00 – 19:00 WIB</div>
                </address>
                <div class="footer-social">
                    <a href="https://wa.me/6281211221984" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.instagram.com/macah.bakery" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-6 col-lg-2">
                <p class="footer-heading">Menu</p>
                <ul class="footer-links">
                    <li><a href="/">Beranda</a></li>
                    <li><a href="/products">Belanja</a></li>
                    <li><a href="/about">Lokasi Toko</a></li>
                    <li><a href="/ulasan">Ulasan</a></li>
                    <li><a href="/cart">Keranjang</a></li>
                    @auth
                    <li><a href="{{ route('orders.index') }}">Pesanan Saya</a></li>
                    @endauth
                </ul>
            </div>
            <div class="col-6 col-lg-2">
                <p class="footer-heading">Kategori</p>
                <ul class="footer-links">
                    <li><a href="/products?kategori=Bolu">Bolu</a></li>
                    <li><a href="/products?kategori=Roti & Kue">Roti & Kue</a></li>
                    <li><a href="/products?kategori=Kue Lebaran">Kue Lebaran</a></li>
                    <li><a href="/products?kategori=Hampers">Hampers</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <p class="footer-heading">Pesan via Marketplace</p>
                <div class="footer-marketplace">
                    <a href="https://spf.shopee.co.id/40Z5OFTzYL" class="market-link" target="_blank">
                        <span class="market-dot" style="background:#EE4D2D"></span> ShopeeFood
                    </a>
                    <a href="https://wa.me/6281211221984" class="market-link" target="_blank">
                        <span class="market-dot" style="background:#25D366"></span> WhatsApp Order
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Macah Bakery. All rights reserved.</p>
            @php
                use Carbon\Carbon;
                $now = Carbon::now('Asia/Jakarta');
                $jam = $now->format('H:i');
                $isOpen = $jam >= '07:00' && $jam <= '19:00';
                $statusText = $isOpen ? 'Buka Sekarang' : 'Tutup';
                $statusColor = $isOpen ? '#4CAF50' : '#dc3545';
            @endphp
            <span class="footer-ops">
                <span class="dot" style="background: {{ $statusColor }};"></span>
                {{ $statusText }} · 07:00 – 19:00 WIB
            </span>
        </div>
    </div>
</footer>

{{-- WHATSAPP FLOAT --}}
<a href="https://wa.me/6281211221984" class="wa-float" target="_blank" title="Chat via WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Update cart count
    function updateCartCount() {
        fetch('/cart/count')
            .then(response => response.json())
            .then(data => {
                const el = document.getElementById('cart-count');
                if (el) el.textContent = data.count;
            })
            .catch(() => {});
    }
</script>
@stack('scripts')
</body>
</html>