@extends('layouts.guest')

@section('title', 'Login - Macah Bakery')

@section('auth-content')
<h4 class="text-center mb-4" style="color: #5C2E0A;">Login</h4>

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form method="POST" action="/login">
    @csrf
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn w-100" style="background: #C9943A; color: #fff; border-radius: 30px; padding: 12px;">
        Login
    </button>
</form>
<div class="text-center mt-3">
    <small>Belum punya akun? <a href="/register" style="color: #C9943A;">Register</a></small>
</div>
<div class="text-center mt-2">
    <small><a href="{{ route('admin.login') }}" style="color: #8a7a6d;">Login sebagai Admin</a></small>
</div>
@endsection