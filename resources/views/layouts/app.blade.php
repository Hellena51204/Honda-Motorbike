<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Honda Motorbike E-commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .honda-red {
            background-color: #cc0000;
        }

        .text-honda-red {
            color: #cc0000;
        }

        .nav-link.active {
            border-bottom: 2px solid #cc0000;
            color: #cc0000 !important;
            font-weight: bold;
        }
    </style>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand honda-red text-white fw-bold px-3 py-1 rounded" href="/">HONDA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav gap-4">
                    <li class="nav-item"><a class="nav-link active" href="/">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sản phẩm</a></li>
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