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
                    <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Admin</a></li>
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
                    <p class="mt-3 text-secondary">Leading motorcycle manufacturer delivering quality, innovation, and performance since 1948.</p>
                </div>
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled text-secondary line-height-lg">
                        <li>All Products</li>
                        <li>Contact Us</li>
                        <li>About Honda</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Customer Service</h5>
                    <ul class="list-unstyled text-secondary">
                        <li>FAQ</li>
                        <li>Financing Options</li>
                        <li>Test Ride</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5>Contact Info</h5>
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