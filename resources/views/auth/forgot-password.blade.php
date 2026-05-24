@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg border-0" style="width: 100%; max-width: 450px; border-radius: 24px; overflow: hidden; background-color: #fcfcfc;">

        <div class="text-white text-center py-4" style="background-color: #cc0000;">
            <h2 class="fw-bold mb-0">HONDA</h2>
            <p class="small mb-0" style="opacity: 0.9;">Forgot Password</p>
        </div>

        <div class="card-body p-4 p-md-5 bg-white">
            <div class="mb-4 text-secondary small text-center" style="line-height: 1.6;">
                Quên mật khẩu? Không sao cả. Chỉ cần cho chúng tôi biết địa chỉ email của bạn và chúng tôi sẽ gửi cho bạn một liên kết đặt lại mật khẩu.
            </div>

            <!-- Session Status -->
            @if(session('status'))
            <div class="alert alert-success rounded-3 py-2 small">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4">
                    <label class="form-label fw-bold text-dark small">Địa chỉ Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="fa-regular fa-envelope text-muted"></i></span>
                        <input type="email" name="email" class="form-control bg-light border-start-0 rounded-end-3 py-2" placeholder="Nhập email tài khoản của bạn" required autofocus>
                    </div>
                    @if($errors->has('email'))
                        <div class="text-danger small mt-1">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-dark small">Mật khẩu mới</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="fa-solid fa-lock text-muted"></i></span>
                        <input type="password" name="password" class="form-control bg-light border-start-0 rounded-end-3 py-2" placeholder="Nhập mật khẩu mới" required>
                    </div>
                    @if($errors->has('password'))
                        <div class="text-danger small mt-1">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <button type="submit" class="btn text-white w-100 py-3 rounded-pill fw-bold shadow mb-3" style="background-color: #cc0000;">
                    Đổi mật khẩu ngay
                </button>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-secondary text-decoration-none small fw-bold"><i class="fa-solid fa-arrow-left me-1"></i> Quay lại Đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection