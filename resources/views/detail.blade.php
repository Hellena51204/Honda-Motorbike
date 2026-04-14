@extends('layouts.app')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-dark">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/products" class="text-decoration-none text-dark">Sản phẩm</a></li>
            <li class="breadcrumb-item active text-honda-red fw-bold" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <img src="{{ $product->image }}" class="img-fluid" alt="{{ $product->name }}">
            </div>
            
            <div class="d-flex gap-2 mt-3">
                <img src="{{ $product->image }}" class="img-thumbnail rounded-3" style="width: 80px; cursor: pointer;">
                <div class="bg-secondary-subtle rounded-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 12px; color: #666;">
                    +3 Ảnh
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <span class="badge honda-red text-white px-3 py-2 rounded-pill mb-2">{{ $product->category }}</span>
            <h1 class="display-5 fw-bold mb-3">{{ $product->name }}</h1>
            
            <div class="d-flex align-items-center mb-4">
                <h2 class="text-honda-red fw-bold mb-0">{{ number_format($product->price, 0, ',', '.') }} VNĐ</h2>
                <span class="ms-3 text-secondary text-decoration-line-through">Giá đề xuất</span>
            </div>

            <div class="mb-4">
                <h5 class="fw-bold">Mô tả sản phẩm:</h5>
                <p class="text-secondary leading-relaxed">
                    {{ $product->description }}
                </p>
            </div>

            <div class="mb-4">
                <h5 class="fw-bold">Màu sắc sẵn có:</h5>
                <div class="d-flex gap-2 mt-2">
                    @if($product->colors)
                        @foreach($product->colors as $color)
                            <div class="rounded-circle border" style="width: 30px; height: 30px; background-color: {{ $color }}; cursor: pointer;" title="Màu xe"></div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="d-grid gap-2 d-md-flex mt-5">
                <button class="btn btn-dark btn-lg px-5 py-3 rounded-pill fw-bold shadow-sm">
                    <i class="fa-solid fa-calendar-check me-2"></i> ĐĂNG KÝ LÁI THỬ
                </button>
                <button class="btn btn-outline-danger btn-lg px-4 py-3 rounded-pill fw-bold border-2">
                    <i class="fa-solid fa-phone me-2"></i> TƯ VẤN NGAY
                </button>
            </div>

            <div class="mt-4 p-3 bg-white border rounded-3 d-flex align-items-center">
                <i class="fa-solid fa-shield-halved text-success fs-3 me-3"></i>
                <div>
                    <span class="d-block fw-bold">Bảo hành chính hãng</span>
                    <small class="text-secondary">3 năm hoặc 30.000km tùy điều kiện nào đến trước</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection