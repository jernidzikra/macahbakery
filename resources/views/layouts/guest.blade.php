@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-5">
                    @yield('auth-content')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection