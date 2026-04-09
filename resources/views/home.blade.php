@extends('layouts.app')

@section('content')
<div class="position-relative text-white" style="background: url('https://images.unsplash.com/photo-1558981403-c5f9899a28bc?q=80&w=1920&auto=format&fit=crop') center/cover; height: 500px;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.6);"></div>
    <div class="container position-relative h-100 d-flex flex-column justify-content-center">
        <h1 class="display-3 fw-bold">The Power of <br><span class="text-honda-red">Dreams</span></h1>
        <p class="fs-5 w-50 mb-4">Discover the latest Honda motorcycles. Premium quality, innovative technology, and exceptional performance.</p>
        <div class="d-flex gap-3">
            <button class="btn honda-red text-white px-4 py-2 rounded-pill fw-bold">Explore Models <i class="fa-solid fa-arrow-right ms-2"></i></button>
            <button class="btn btn-light px-4 py-2 rounded-pill fw-bold">Book Test Ride</button>
        </div>
    </div>
</div>

<div class="honda-red text-white py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 rounded-4 h-100" style="background-color: rgba(255,255,255,0.1);">
                    <i class="fa-solid fa-tags fs-2 mb-3"></i>
                    <h4 class="fw-bold">Special Offers</h4>
                    <p>Get up to 5M VND discount on selected models this month!</p>
                    <a href="#" class="text-white text-decoration-none fw-bold mt-2 d-inline-block">View Offers <i class="fa-solid fa-arrow-right ms-1"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 h-100" style="background-color: rgba(255,255,255,0.1);">
                    <i class="fa-solid fa-award fs-2 mb-3"></i>
                    <h4 class="fw-bold">0% Financing</h4>
                    <p>Interest-free installments for 12 months on all models!</p>
                    <a href="#" class="text-white text-decoration-none fw-bold mt-2 d-inline-block">Learn More <i class="fa-solid fa-arrow-right ms-1"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 h-100" style="background-color: rgba(255,255,255,0.1);">
                    <i class="fa-solid fa-shield-halved fs-2 mb-3"></i>
                    <h4 class="fw-bold">Extended Warranty</h4>
                    <p>3-year warranty on all new Honda motorcycles purchased!</p>
                    <a href="#" class="text-white text-decoration-none fw-bold mt-2 d-inline-block">Read Details <i class="fa-solid fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5 my-4">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Featured Models</h2>
        <p class="text-secondary">Explore our best-selling motorcycles</p>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                <div class="position-relative bg-white text-center p-3">
                    <span class="badge honda-red position-absolute top-0 end-0 m-3">2026</span>
                    <img src="https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?w=500&auto=format&fit=crop" class="img-fluid rounded" alt="Vision" style="height: 180px; object-fit: cover;">
                </div>
                <div class="card-body bg-light">
                    <h5 class="fw-bold mb-1">Honda Vision</h5>
                    <p class="text-muted small mb-3">Scooter</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-honda-red fw-bold mb-0">29.9M VND</h5>
                        <a href="#" class="text-secondary"><i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                <div class="position-relative bg-white text-center p-3">
                    <span class="badge honda-red position-absolute top-0 end-0 m-3">2026</span>
                    <img src="https://images.unsplash.com/photo-1622185135505-2d795003994a?w=500&auto=format&fit=crop" class="img-fluid rounded" alt="SH" style="height: 180px; object-fit: cover;">
                </div>
                <div class="card-body bg-light">
                    <h5 class="fw-bold mb-1">Honda SH</h5>
                    <p class="text-muted small mb-3">Premium Scooter</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-honda-red fw-bold mb-0">95.9M VND</h5>
                        <a href="#" class="text-secondary"><i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5 mb-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Why Choose Honda?</h2>
        <p class="text-secondary">Experience the Honda difference</p>
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
                    <h5 class="fw-bold">Premium Quality</h5>
                    <p class="text-secondary">Honda motorcycles are built with precision engineering and the finest materials for lasting durability.</p>
                </div>
            </div>

            <div class="d-flex mb-4">
                <div class="flex-shrink-0">
                    <div class="honda-red text-white rounded-3 d-flex align-items-center justify-content-center shadow" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-shield-halved fs-5"></i>
                    </div>
                </div>
                <div class="ms-4">
                    <h5 class="fw-bold">Trusted Reliability</h5>
                    <p class="text-secondary">With over 70 years of innovation, Honda is synonymous with dependability and performance.</p>
                </div>
            </div>

            <div class="d-flex">
                <div class="flex-shrink-0">
                    <div class="honda-red text-white rounded-3 d-flex align-items-center justify-content-center shadow" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-tag fs-5"></i>
                    </div>
                </div>
                <div class="ms-4">
                    <h5 class="fw-bold">Best Value</h5>
                    <p class="text-secondary">Get exceptional fuel efficiency, low maintenance costs, and strong resale value with every Honda.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <img src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?w=800&auto=format&fit=crop" class="img-fluid rounded-4 shadow-lg" alt="Honda Showroom">
        </div>
    </div>
</div>
@endsection