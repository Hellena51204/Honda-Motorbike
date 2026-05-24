@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg border-0" style="width: 100%; max-width: 450px; border-radius: 24px; overflow: hidden; background-color: #fcfcfc;">

        <div class="text-white text-center py-4" style="background-color: #cc0000;">
            <h2 class="fw-bold mb-0">HONDA</h2>
            <p class="small mb-0" style="opacity: 0.9;">Motorbike E-commerce</p>
        </div>

        <div class="card-body p-4 p-md-5 bg-white">
            <div class="d-flex justify-content-center mb-4 bg-light rounded-pill p-1 shadow-sm">
                <a href="{{ route('login') }}" class="btn btn-white text-danger fw-bold rounded-pill w-50 shadow-sm" style="background: white;">Login</a>
                <a href="{{ route('register') }}" class="btn btn-transparent text-secondary fw-bold rounded-pill w-50 border-0">Register</a>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger rounded-3 py-2 small">
                Email hoặc mật khẩu không chính xác!
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success rounded-3 py-2 small fw-bold">
                <i class="fa-solid fa-circle-check me-1"></i> {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold text-dark small">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="fa-regular fa-envelope text-muted"></i></span>
                        <input type="email" name="email" class="form-control bg-light border-start-0 rounded-end-3 py-2" placeholder="Enter your email" required autofocus>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label fw-bold text-dark small">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="fa-solid fa-lock text-muted"></i></span>
                        <input type="password" name="password" class="form-control bg-light border-start-0 rounded-end-3 py-2" placeholder="Enter your password" required>
                    </div>
                </div>

                <div class="text-end mb-4">
                    <a href="{{ route('password.request') }}" class="text-danger text-decoration-none small fw-bold">Forgot Password?</a>
                </div>

                <button type="submit" class="btn text-white w-100 py-3 rounded-pill fw-bold fs-5 shadow" style="background-color: #cc0000;">
                    Sign In
                </button>

                <div class="text-center mt-4">
                    <span class="text-muted small">Don't have an account? </span>
                    <a href="{{ route('register') }}" class="text-danger text-decoration-none fw-bold small">Register now</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection