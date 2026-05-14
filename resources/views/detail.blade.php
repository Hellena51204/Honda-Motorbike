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
            @php
                $all_images = [$product->image];
                if (!empty($product->images)) {
                    $all_images = array_merge($all_images, $product->images);
                }
            @endphp

            <div id="productCarousel" class="carousel slide card border-0 shadow-sm rounded-4 overflow-hidden" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($all_images as $index => $img)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ $img }}" class="d-block w-100 object-fit-cover" style="height: 450px; background-color: #f8f9fa;" alt="{{ $product->name }}">
                    </div>
                    @endforeach
                </div>
                @if(count($all_images) > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon rounded-circle bg-dark p-2" aria-hidden="true" style="width: 2rem; height: 2rem; background-size: 50%;"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon rounded-circle bg-dark p-2" aria-hidden="true" style="width: 2rem; height: 2rem; background-size: 50%;"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                @endif
            </div>
            
            <!-- Thumbnails -->
            <div class="d-flex gap-2 mt-3 overflow-auto" style="white-space: nowrap; padding-bottom: 5px;">
                @foreach($all_images as $index => $img)
                    <img src="{{ $img }}" 
                         data-bs-target="#productCarousel" 
                         data-bs-slide-to="{{ $index }}" 
                         class="img-thumbnail rounded-3 {{ $index == 0 ? 'border-danger border-2' : '' }} thumbnail-nav" 
                         style="width: 80px; height: 60px; object-fit: cover; cursor: pointer;">
                @endforeach
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
                <a href="{{ route('contact.index') }}" class="btn btn-dark btn-lg px-5 py-3 rounded-pill fw-bold shadow-sm">
                    <i class="fa-solid fa-calendar-check me-2"></i> ĐĂNG KÝ LÁI THỬ
                </a>
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-lg px-4 py-3 rounded-pill fw-bold border-2 w-100">
                        <i class="fa-solid fa-cart-plus me-2"></i> MUA HÀNG
                    </button>
                </form>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const carouselEl = document.getElementById('productCarousel');
    if(carouselEl) {
        carouselEl.addEventListener('slid.bs.carousel', function (event) {
            const thumbs = document.querySelectorAll('.thumbnail-nav');
            thumbs.forEach(t => t.classList.remove('border-danger', 'border-2'));
            if(thumbs[event.to]) {
                thumbs[event.to].classList.add('border-danger', 'border-2');
            }
        });
    }
});
</script>
@endsection