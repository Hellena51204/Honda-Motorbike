<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Honda Motorbike E-commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        /* --- CSS DÙNG CHUNG --- */
        .honda-red { background-color: #cc0000; }
        .text-honda-red { color: #cc0000; }
        .nav-link.active {
            border-bottom: 2px solid #cc0000;
            color: #cc0000 !important;
            font-weight: bold;
        }

        /* --- CSS CHO TRANG SẢN PHẨM --- */
        .products-page { padding: 40px 0; }
        .page-header h1 { font-size: 36px; margin-bottom: 10px; font-weight: bold; }
        .page-header p { color: #666; margin-bottom: 30px; }

        /* Bộ lọc */
        .filter-container { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 40px; }
        .filter-header { font-weight: bold; margin-bottom: 15px; }
        .filter-buttons { display: flex; gap: 10px; flex-wrap: wrap; }
        .filter-btn { padding: 8px 20px; border: 1px solid #ddd; border-radius: 30px; background: white; cursor: pointer; font-weight: 600; transition: 0.3s; }
        .filter-btn:hover { background: #f5f5f5; }
        .filter-btn.active { background: #cc0000; color: white; border-color: #cc0000; }

        /* Lưới Sản phẩm */
        .product-grid-v2 { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px; }
        .product-item-card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border: 1px solid #eee; transition: 0.3s; }
        .product-item-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.12); }
        
        .card-img-wrapper { position: relative; height: 220px; background: #f8f9fa; }
        .card-img-wrapper img { width: 100%; height: 100%; object-fit: cover; }
        .badge { position: absolute; top: 10px; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; color: white; }
        .badge-left { left: 10px; background: rgba(0,0,0,0.7); }
        .badge-right { right: 10px; background: #cc0000; }

        .card-info { padding: 20px; }
        .card-info h3 { font-size: 20px; margin-bottom: 10px; font-weight: bold; }
        .card-info .desc { font-size: 14px; color: #777; margin-bottom: 15px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

        .colors { display: flex; gap: 8px; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 15px; }
        .color-circle { width: 18px; height: 18px; border-radius: 50%; }

        .price-action { display: flex; justify-content: space-between; align-items: flex-end; }
        .price-label { font-size: 12px; color: #888; display: block; margin-bottom: 2px;}
        .price-value { font-size: 20px; font-weight: bold; color: #cc0000; }
        .btn-arrow-red { background: #cc0000; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; justify-content: center; align-items: center; text-decoration: none; transition: 0.3s; }
        .btn-arrow-red:hover { background: #a30000; color: white; }
    </style>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand honda-red text-white fw-bold px-3 py-1 rounded" href="/">HONDA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav gap-4">
                    <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="/products">Sản phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Liên hệ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Quản trị</a></li>
                </ul>
            </div>
            <div class="d-flex gap-3">
                <a href="#" class="text-dark fs-5"><i class="fa-solid fa-cart-shopping"></i></a>
                <a href="#" class="text-dark fs-5"><i class="fa-regular fa-user"></i></a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <span class="honda-red text-white fw-bold px-3 py-1 rounded fs-5">HONDA</span>
                    <p class="mt-3 text-secondary">Nhà sản xuất xe máy hàng đầu mang đến chất lượng, sự đổi mới và hiệu suất từ năm 1948.</p>
                </div>
                <div class="col-md-3">
                    <h5>Liên kết nhanh</h5>
                    <ul class="list-unstyled text-secondary line-height-lg">
                        <li>Tất cả sản phẩm</li>
                        <li>Liên hệ chúng tôi</li>
                        <li>Về Honda</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Chăm sóc khách hàng</h5>
                    <ul class="list-unstyled text-secondary">
                        <li>Câu hỏi thường gặp</li>
                        <li>Tùy chọn trả góp</li>
                        <li>Đăng ký lái thử</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5>Thông tin liên hệ</h5>
                    <ul class="list-unstyled text-secondary">
                        <li><i class="fa-solid fa-location-dot me-2"></i> 123 Honda St, HCM</li>
                        <li><i class="fa-solid fa-phone me-2"></i> 1800-123-456</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>