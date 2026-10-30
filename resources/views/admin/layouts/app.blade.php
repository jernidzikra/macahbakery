<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Macah Bakery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --admin-dark: #241209;
            --admin-sidebar: #2C1810;
            --brown-mid: #8B4513;
            --brown-warm: #C1622A;
            --gold: #C9943A;
            --cream-light: #FDF6EE;
            --cream-mid: #F5E6D3;
            --text-dark: #2C1810;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--cream-light);
            color: var(--text-dark);
            margin: 0;
        }
        .admin-wrapper { display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .admin-sidebar {
            width: 250px;
            flex-shrink: 0;
            background: var(--admin-sidebar);
            color: #fff;
            position: fixed;
            top: 0; bottom: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 1030;
            transition: transform 0.25s ease;
        }
        .admin-sidebar .brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1rem;
            color: #fff;
            padding: 18px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            gap: 12px;
            line-height: 1.15;
        }
        .admin-sidebar .brand i { color: var(--gold); }
        .admin-sidebar .brand .brand-logo {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
        }
        .admin-sidebar .brand .brand-icon-fallback {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            font-size: 18px;
            flex-shrink: 0;
        }
        .admin-nav { list-style: none; margin: 0; padding: 16px 12px; flex: 1; }
        .admin-nav li { margin-bottom: 4px; }
        .admin-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 8px;
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            font-size: 14.5px;
            font-weight: 500;
            transition: all .15s;
        }
        .admin-nav a i { width: 18px; text-align: center; }
        .admin-nav a:hover { background: rgba(255,255,255,0.08); color: #fff; }
        .admin-nav a.active {
            background: var(--gold);
            color: #fff;
        }
        .admin-sidebar .admin-user {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding: 16px 20px;
        }
        .admin-sidebar .admin-user .name { font-weight: 600; font-size: 14px; color: #fff; }
        .admin-sidebar .admin-user .role { font-size: 12px; color: rgba(255,255,255,0.55); margin-bottom: 10px; }
        .admin-sidebar .btn-logout {
            width: 100%;
            background: rgba(255,255,255,0.08);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px;
            font-size: 13px;
            transition: background .15s;
        }
        .admin-sidebar .btn-logout:hover { background: var(--brown-warm); color: #fff; }

        /* MAIN */
        .admin-main {
            margin-left: 250px;
            flex: 1;
            min-width: 0;
        }
        .admin-topbar {
            background: #fff;
            border-bottom: 1px solid var(--cream-mid);
            padding: 16px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1020;
        }
        .admin-topbar h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            margin: 0;
            color: var(--text-dark);
        }
        .admin-topbar .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .sidebar-toggle {
            display: none;
            border: none;
            background: none;
            font-size: 20px;
            color: var(--text-dark);
        }
        .admin-content { padding: 28px; }

        /* NOTIFICATION STYLES */
        .notification-bell {
            position: relative;
            cursor: pointer;
            padding: 8px 10px;
            border-radius: 30px;
            transition: all 0.3s;
            background: transparent;
            border: none;
            color: #5D4037;
            font-size: 18px;
            display: flex;
            align-items: center;
        }
        .notification-bell:hover {
            background: #FDF6EE;
        }
        .notification-bell .badge-notif {
            position: absolute;
            top: -2px;
            right: -2px;
            background: #e74c3c;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            min-width: 20px;
            height: 20px;
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 0 5px;
            animation: pulse 2s infinite;
        }
        .notification-bell .badge-notif.show {
            display: flex;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        .notification-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            width: 380px;
            max-height: 460px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            border: 1px solid #f0e6db;
            overflow: hidden;
            z-index: 9999;
            display: none;
        }
        .notification-dropdown.show {
            display: block;
        }
        .notification-dropdown .notif-header {
            padding: 14px 18px;
            border-bottom: 1px solid #f0e6db;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .notification-dropdown .notif-header h6 {
            margin: 0;
            font-weight: 600;
            color: #5D4037;
            font-size: 14px;
        }
        .notification-dropdown .notif-header .mark-all {
            font-size: 12px;
            color: #C9943A;
            cursor: pointer;
            background: none;
            border: none;
            text-decoration: underline;
        }
        .notification-dropdown .notif-header .mark-all:hover {
            color: #8B4513;
        }
        .notification-dropdown .notif-list {
            max-height: 360px;
            overflow-y: auto;
            padding: 0;
        }
        .notification-dropdown .notif-list::-webkit-scrollbar {
            width: 4px;
        }
        .notification-dropdown .notif-list::-webkit-scrollbar-thumb {
            background: #e0d5c8;
            border-radius: 10px;
        }
        .notification-dropdown .notif-item {
            display: flex;
            padding: 12px 18px;
            border-bottom: 1px solid #f8f0e8;
            transition: background 0.2s;
            cursor: pointer;
            text-decoration: none;
            color: #5D4037;
            gap: 12px;
            align-items: flex-start;
        }
        .notification-dropdown .notif-item:hover {
            background: #FDF6EE;
        }
        .notification-dropdown .notif-item.unread {
            background: #fcf9f6;
            border-left: 4px solid #C9943A;
        }
        .notification-dropdown .notif-item .notif-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }
        .notification-dropdown .notif-item .notif-icon.pesanan {
            background: #FDF6EE;
            color: #C9943A;
        }
        .notification-dropdown .notif-item .notif-icon.info {
            background: #e3f2fd;
            color: #1976d2;
        }
        .notification-dropdown .notif-item .notif-icon.warning {
            background: #fff3e0;
            color: #e65100;
        }
        .notification-dropdown .notif-item .notif-content {
            flex: 1;
            min-width: 0;
        }
        .notification-dropdown .notif-item .notif-content .notif-title {
            font-weight: 600;
            font-size: 13px;
            color: #5D4037;
        }
        .notification-dropdown .notif-item .notif-content .notif-message {
            font-size: 12px;
            color: #8d7b6b;
            margin: 2px 0 4px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .notification-dropdown .notif-item .notif-content .notif-time {
            font-size: 10px;
            color: #b5a392;
        }
        .notification-dropdown .notif-empty {
            padding: 40px 20px;
            text-align: center;
            color: #b5a392;
        }
        .notification-dropdown .notif-empty i {
            font-size: 40px;
            color: #e0d5c8;
            display: block;
            margin-bottom: 12px;
        }

        .stat-card {
            background: #fff;
            border-radius: 14px;
            padding: 20px;
            border: 1px solid var(--cream-mid);
            height: 100%;
        }
        .stat-card .stat-icon {
            width: 44px; height: 44px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            color: #fff;
            margin-bottom: 12px;
        }
        .stat-card .stat-value { font-size: 1.5rem; font-weight: 700; color: var(--text-dark); }
        .stat-card .stat-label { font-size: 13px; color: #8a7a6d; }

        .card-panel {
            background: #fff;
            border-radius: 14px;
            border: 1px solid var(--cream-mid);
        }
        .card-panel .card-panel-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--cream-mid);
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .table-admin thead th {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #8a7a6d;
            border-bottom: 2px solid var(--cream-mid);
            white-space: nowrap;
        }
        .table-admin td { vertical-align: middle; font-size: 14px; }

        .badge-status { font-size: 11.5px; padding: 5px 10px; border-radius: 20px; font-weight: 600; }
        .badge-pending { background: #FFF3CD; color: #8a6d1c; }
        .badge-diproses { background: #D6E4FF; color: #1c4b8a; }
        .badge-dikirim { background: #E0D6FF; color: #5b2c8a; }
        .badge-selesai { background: #D4EDDA; color: #1e7e34; }
        .badge-dibatalkan { background: #F8D7DA; color: #a12833; }
        .badge-menunggu { background: #FFF3CD; color: #8a6d1c; }
        .badge-lunas { background: #D4EDDA; color: #1e7e34; }
        .badge-gagal { background: #F8D7DA; color: #a12833; }

        .btn-gold { background: var(--gold); border-color: var(--gold); color: #fff; }
        .btn-gold:hover { background: var(--brown-warm); border-color: var(--brown-warm); color: #fff; }
        .prod-thumb { width: 48px; height: 48px; border-radius: 8px; object-fit: cover; }

        @media (max-width: 991px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.open { transform: translateX(0); }
            .admin-main { margin-left: 0; }
            .sidebar-toggle { display: block; }
            .notification-dropdown {
                width: 320px;
                right: -60px;
            }
        }
        @media (max-width: 576px) {
            .notification-dropdown {
                width: 290px;
                right: -80px;
            }
            .admin-topbar {
                padding: 12px 16px;
            }
            .admin-content {
                padding: 16px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
<div class="admin-wrapper">

    {{-- SIDEBAR --}}
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="brand">
            <img src="{{ asset('images/logo-macah.jpg') }}"
                 alt="Macah Bakery"
                 class="brand-logo"
                 onerror="this.style.display='none'; document.getElementById('brand-icon-fallback').style.display='flex';">
            <div class="brand-icon-fallback" id="brand-icon-fallback" style="display:none;">
                <i class="fas fa-bread-slice"></i>
            </div>
            Macah Bakery
        </div>
        <ul class="admin-nav">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-gauge-high"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.customers.index') }}" class="{{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Pelanggan
                </a>
            </li>
            <li>
                <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="fas fa-receipt"></i> Pesanan
                </a>
            </li>
            <li>
                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fas fa-box-open"></i> Produk
                </a>
            </li>
            <li>
                <a href="{{ url('/') }}" target="_blank">
                    <i class="fas fa-arrow-up-right-from-square"></i> Lihat Website
                </a>
            </li>
        </ul>
        <div class="admin-user">
            <div class="name">{{ auth('admin')->user()->nama_admin ?? 'Admin' }}</div>
            <div class="role">{{ '@' . (auth('admin')->user()->username ?? '') }}</div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="admin-main">
        <div class="admin-topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="sidebar-toggle" onclick="document.getElementById('adminSidebar').classList.toggle('open')">
                    <i class="fas fa-bars"></i>
                </button>
                <h1>@yield('page-title', 'Dashboard')</h1>
            </div>

            {{-- TOPBAR KANAN: NOTIFIKASI + NAMA ADMIN --}}
            <div class="topbar-right">
                <!-- Notification Bell -->
                <div class="position-relative" style="display:inline-block;">
                    <button class="notification-bell" id="notifBell" onclick="toggleNotif()" title="Notifikasi">
                        <i class="fas fa-bell"></i>
                        <span class="badge-notif" id="notifCount">0</span>
                    </button>

                    <!-- Dropdown Notifikasi -->
                    <div class="notification-dropdown" id="notifDropdown">
                        <div class="notif-header">
                            <h6><i class="fas fa-bell me-2" style="color:#C9943A;"></i>Notifikasi</h6>
                            <button class="mark-all" onclick="markAllRead()">Tandai semua dibaca</button>
                        </div>
                        <div class="notif-list" id="notifList">
                            <div class="notif-empty">
                                <i class="fas fa-bell-slash"></i>
                                <p class="mb-0">Belum ada notifikasi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-muted small d-none d-md-block">
                    <i class="fas fa-user-shield me-1"></i> {{ auth('admin')->user()->nama_admin ?? 'Admin' }}
                </div>
            </div>
        </div>

        <div class="admin-content">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{-- SCRIPT NOTIFIKASI --}}
<script>
    // TOGGLE NOTIFIKASI 
    function toggleNotif() {
        const dropdown = document.getElementById('notifDropdown');
        dropdown.classList.toggle('show');
        if (dropdown.classList.contains('show')) {
            loadNotifications();
        }
    }

    // LOAD NOTIFIKASI 
    function loadNotifications() {
        fetch('/admin/notifications')
            .then(response => response.json())
            .then(data => {
                const list = document.getElementById('notifList');
                const count = document.getElementById('notifCount');

                // Update count
                if (data.count > 0) {
                    count.textContent = data.count;
                    count.classList.add('show');
                } else {
                    count.classList.remove('show');
                }

                // Render notifikasi
                if (data.notifications && data.notifications.length > 0) {
                    let html = '';
                    data.notifications.forEach(notif => {
                        const iconMap = {
                            'pesanan': 'fa-shopping-bag',
                            'info': 'fa-info-circle',
                            'warning': 'fa-exclamation-triangle'
                        };
                        const icon = iconMap[notif.type] || 'fa-bell';
                        const typeClass = notif.type || 'pesanan';
                        html += `
                            <a href="${notif.link || '#'}" class="notif-item ${notif.is_read ? '' : 'unread'}" onclick="markRead(${notif.id})">
                                <div class="notif-icon ${typeClass}">
                                    <i class="fas ${icon}"></i>
                                </div>
                                <div class="notif-content">
                                    <div class="notif-title">${notif.title}</div>
                                    <div class="notif-message">${notif.message}</div>
                                    <div class="notif-time">${new Date(notif.created_at).toLocaleString('id-ID')}</div>
                                </div>
                            </a>
                        `;
                    });
                    list.innerHTML = html;
                } else {
                    list.innerHTML = `
                        <div class="notif-empty">
                            <i class="fas fa-bell-slash"></i>
                            <p class="mb-0">Semua notifikasi sudah dibaca</p>
                        </div>
                    `;
                }
            })
            .catch(error => console.error('Error loading notifications:', error));
    }

    // MARK AS READ 
    function markRead(id) {
        fetch(`/admin/notifications/${id}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadNotifications();
                updateCount();
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // MARK ALL AS READ 
    function markAllRead() {
        fetch('/admin/notifications/read-all', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
            }
        })
        .then(() => {
            loadNotifications();
            updateCount();
            // Tutup dropdown
            document.getElementById('notifDropdown').classList.remove('show');
        })
        .catch(error => console.error('Error:', error));
    }

    // UPDATE COUNT 
    function updateCount() {
        fetch('/admin/notifications')
            .then(response => response.json())
            .then(data => {
                const count = document.getElementById('notifCount');
                if (data.count > 0) {
                    count.textContent = data.count;
                    count.classList.add('show');
                } else {
                    count.classList.remove('show');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // CEK NOTIFIKASI BARU (POLLING) 
    function checkNewNotifications() {
        fetch('/admin/notifications')
            .then(response => response.json())
            .then(data => {
                const count = document.getElementById('notifCount');
                if (data.count > 0) {
                    count.textContent = data.count;
                    count.classList.add('show');
                } else {
                    count.classList.remove('show');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // CLOSE DROPDOWN KLIK DI LUAR 
    document.addEventListener('click', function(event) {
        const bell = document.getElementById('notifBell');
        const dropdown = document.getElementById('notifDropdown');

        if (bell && dropdown) {
            if (!bell.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        }
    });

    // INISIALISASI 
    document.addEventListener('DOMContentLoaded', function() {
        loadNotifications();
        updateCount();
        // Cek notifikasi setiap 15 detik
        setInterval(checkNewNotifications, 15000);
    });
</script>

@stack('scripts')
</body>
</html>