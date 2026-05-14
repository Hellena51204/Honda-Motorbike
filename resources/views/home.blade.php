@extends('layouts.app')

@section('content')
<div class="position-relative text-white" style="background: url('https://images.unsplash.com/photo-1558981403-c5f9899a28bc?q=80&w=1920&auto=format&fit=crop') center/cover; height: 500px;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.6);"></div>
    <div class="container position-relative h-100 d-flex flex-column justify-content-center">
        <h1 class="display-3 fw-bold">Sức mạnh của <br><span class="text-honda-red">Những Ước Mơ</span></h1>
        <p class="fs-5 w-50 mb-4">Khám phá các dòng xe máy Honda mới nhất. Chất lượng cao cấp, công nghệ tiên tiến và hiệu suất vượt trội.</p>
        <div class="d-flex gap-3">
            <button class="btn honda-red text-white px-4 py-2 rounded-pill fw-bold">Khám phá các mẫu xe <i class="fa-solid fa-arrow-right ms-2"></i></button>
            <button class="btn btn-light px-4 py-2 rounded-pill fw-bold">Đăng ký lái thử</button>
        </div>
    </div>
</div>

<div class="honda-red text-white py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 rounded-4 h-100" style="background-color: rgba(255,255,255,0.1);">
                    <i class="fa-solid fa-tags fs-2 mb-3"></i>
                    <h4 class="fw-bold">Ưu đãi đặc biệt</h4>
                    <p>Giảm ngay lên tới 5 triệu đồng cho một số mẫu xe trong tháng này!</p>
                    <a href="#" class="text-white text-decoration-none fw-bold mt-2 d-inline-block">Xem ưu đãi <i class="fa-solid fa-arrow-right ms-1"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 h-100" style="background-color: rgba(255,255,255,0.1);">
                    <i class="fa-solid fa-award fs-2 mb-3"></i>
                    <h4 class="fw-bold">Trả góp 0%</h4>
                    <p>Trả góp không lãi suất trong 12 tháng áp dụng cho mọi mẫu xe!</p>
                    <a href="#" class="text-white text-decoration-none fw-bold mt-2 d-inline-block">Tìm hiểu thêm <i class="fa-solid fa-arrow-right ms-1"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 h-100" style="background-color: rgba(255,255,255,0.1);">
                    <i class="fa-solid fa-shield-halved fs-2 mb-3"></i>
                    <h4 class="fw-bold">Bảo hành mở rộng</h4>
                    <p>Bảo hành 3 năm cho tất cả xe máy Honda mua mới!</p>
                    <a href="#" class="text-white text-decoration-none fw-bold mt-2 d-inline-block">Xem chi tiết <i class="fa-solid fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-uppercase">Sản phẩm <span class="text-honda-red">Nổi bật</span></h2>
        <div class="honda-red mx-auto" style="width: 60px; height: 3px;"></div>
    </div>

    <div class="row g-4">
        @foreach($featuredProducts as $product)
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden product-card">
                <div class="position-relative bg-white text-center p-3">
                    <span class="badge honda-red position-absolute top-0 end-0 m-3">{{ $product->year }}</span>
                    <img src="{{ $product->image }}" class="img-fluid" alt="{{ $product->name }}" style="height: 180px; object-fit: contain;">
                </div>
                <div class="card-body bg-white">
                    <h5 class="fw-bold mb-1">{{ $product->name }}</h5>
                    <p class="text-muted small">{{ $product->category }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <h5 class="text-honda-red fw-bold mb-0">{{ number_format($product->price, 0, ',', '.') }} VNĐ</h5>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-danger btn-sm rounded-circle">
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="bg-light py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <h2 class="fw-bold text-uppercase">Tin tức <span class="text-honda-red">Honda</span></h2>
                <p class="text-secondary mb-0">Cập nhật những công nghệ và sự kiện mới nhất</p>
            </div>
            <a href="{{ route('blog.index') }}" class="btn btn-link text-honda-red fw-bold text-decoration-none">Xem tất cả <i class="fa-solid fa-chevron-right ms-1"></i></a>
        </div>

        <div class="row g-4">
            @foreach($featuredPosts as $post)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="overflow-hidden" style="height: 220px;">
                        <img src="{{ $post->image }}" class="card-img-top hover-zoom" alt="{{ $post->title }}" style="object-fit: cover; height: 100%;">
                    </div>
                    <div class="card-body p-4">
                        <div class="text-honda-red small fw-bold mb-2 text-uppercase">Tin tức nổi bật</div>
                        <h5 class="fw-bold mb-3 line-clamp-2">{{ $post->title }}</h5>
                        <p class="text-secondary small mb-4 line-clamp-3">{{ $post->summary }}</p>
                        <a href="{{ route('blog.show', $post->id) }}" class="stretched-link text-dark fw-bold text-decoration-none">Đọc thêm</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    .hover-zoom { transition: transform 0.5s ease; }
    .card:hover .hover-zoom { transform: scale(1.1); }
    .product-card { transition: all 0.3s ease; }
    .product-card:hover { transform: translateY(-10px); }
</style>
<div class="container py-5 mb-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Vì sao chọn Honda?</h2>
        <p class="text-secondary">Trải nghiệm sự khác biệt cùng Honda</p>
    </div>

    <div class="row align-items-center g-5">
        <div class="col-md-6">
            <div class="d-flex mb-4">
                <div class="flex-shrink-0">
                    <div class="honda-red text-white rounded-3 d-flex align-items-center justify-content-center shadow" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-medal fs-5"></i>
                    </div>
                </div>
                <div class="ms-4">
                    <h5 class="fw-bold">Chất lượng cao cấp</h5>
                    <p class="text-secondary">Xe máy Honda được chế tạo với kỹ thuật cơ khí chính xác và vật liệu tốt nhất cho độ bền vượt thời gian.</p>
                </div>
            </div>

            <div class="d-flex mb-4">
                <div class="flex-shrink-0">
                    <div class="honda-red text-white rounded-3 d-flex align-items-center justify-content-center shadow" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-shield-halved fs-5"></i>
                    </div>
                </div>
                <div class="ms-4">
                    <h5 class="fw-bold">Độ tin cậy tuyệt đối</h5>
                    <p class="text-secondary">Với hơn 70 năm đổi mới, thương hiệu Honda luôn đồng nghĩa với sự đáng tin cậy và không ngừng nâng cao hiệu suất.</p>
                </div>
            </div>

            <div class="d-flex">
                <div class="flex-shrink-0">
                    <div class="honda-red text-white rounded-3 d-flex align-items-center justify-content-center shadow" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-tag fs-5"></i>
                    </div>
                </div>
                <div class="ms-4">
                    <h5 class="fw-bold">Giá trị tốt nhất</h5>
                    <p class="text-secondary">Tiết kiệm nhiên liệu vượt trội, chi phí bảo dưỡng thấp và giữ giá lâu bền đối với mọi dòng xe Honda.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <img src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?w=800&auto=format&fit=crop" class="img-fluid rounded-4 shadow-lg" alt="Honda Showroom">
        </div>
    </div>
</div>
@endsection