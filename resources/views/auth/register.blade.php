@extends('layouts.guest')

@section('title', 'Register - Macah Bakery')

@section('auth-content')
<h4 class="text-center mb-4" style="color: #5C2E0A;">Register</h4>

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form method="POST" action="/register">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>
    <button type="submit" class="btn w-100" style="background: #C9943A; color: #fff; border-radius: 30px; padding: 12px;">
        Register
    </button>
</form>
<div class="text-center mt-3">
    <small>Sudah punya akun? <a href="/login" style="color: #C9943A;">Login</a></small>
</div>
@endsection