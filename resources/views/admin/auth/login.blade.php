<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Macah Bakery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(160deg, #2C1810 0%, #5C2E0A 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .login-card {
            background: #fff;
            border-radius: 18px;
            padding: 40px 36px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.35);
        }
        .login-icon {
            width: 60px; height: 60px;
            background: #2C1810;
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            color: #C9943A;
            font-size: 24px;
            margin: 0 auto 18px;
        }
        .login-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            text-align: center;
            color: #2C1810;
            margin-bottom: 4px;
        }
        .login-sub { text-align: center; color: #8a7a6d; font-size: 14px; margin-bottom: 26px; }
        .form-label { font-size: 13.5px; font-weight: 500; color: #5D4037; }
        .form-control { border-radius: 10px; padding: 10px 14px; }
        .btn-admin-login {
            background: #C9943A;
            border: none;
            color: #fff;
            border-radius: 30px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
        }
        .btn-admin-login:hover { background: #8B4513; color: #fff; }
        .back-link { text-align: center; margin-top: 20px; font-size: 13.5px; }
        .back-link a { color: #8a7a6d; text-decoration: none; }
        .back-link a:hover { color: #C9943A; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-icon"><i class="fas fa-user-shield"></i></div>
        <h4 class="login-title">Admin Login</h4>
        <p class="login-sub">Masuk untuk mengelola Macah Bakery</p>

        @if ($errors->any())
            <div class="alert alert-danger py-2 small">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="{{ old('username') }}" required autofocus>
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn-admin-login">Masuk</button>
        </form>

        <div class="back-link">
            <a href="{{ url('/') }}"><i class="fas fa-arrow-left me-1"></i> Kembali ke halaman utama</a>
        </div>
    </div>
</body>
</html>
