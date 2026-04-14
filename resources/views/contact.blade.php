@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold display-4">Contact Us</h1>
        <p class="text-muted">Get in touch with Honda. We're here to help!</p>
    </div>

    <div class="row g-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 rounded-4 mb-4">
                <div class="d-flex align-items-center">
                    <div class="honda-red text-white rounded-3 p-3 me-3"><i class="fa-solid fa-phone"></i></div>
                    <div>
                        <h5 class="fw-bold mb-0">Phone</h5>
                        <p class="text-honda-red mb-0">1800-123-456</p>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm p-4 rounded-4 mb-4">
                <div class="d-flex align-items-center">
                    <div class="honda-red text-white rounded-3 p-3 me-3"><i class="fa-solid fa-envelope"></i></div>
                    <div>
                        <h5 class="fw-bold mb-0">Email</h5>
                        <p class="text-honda-red mb-0">support@honda.com.vn</p>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm p-4 rounded-4">
                <div class="d-flex align-items-center">
                    <div class="honda-red text-white rounded-3 p-3 me-3"><i class="fa-solid fa-location-dot"></i></div>
                    <div>
                        <h5 class="fw-bold mb-0">Location</h5>
                        <p class="small text-muted mb-0">123 Honda St, District 1, HCM</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4 rounded-4">
                <h4 class="fw-bold mb-4">Send Us a Message</h4>

                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="name" class="form-control rounded-3" placeholder="Enter your name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address *</label>
                            <input type="email" name="email" class="form-control rounded-3" placeholder="your.email@example.com" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Subject *</label>
                            <select name="subject" class="form-select rounded-3">
                                <option value="Product Inquiry">Product Inquiry</option>
                                <option value="Test Ride Booking">Test Ride Booking</option>
                                <option value="Maintenance Support">Maintenance Support</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Message *</label>
                            <textarea name="message" class="form-control rounded-3" rows="4" placeholder="Tell us how we can help you..." required></textarea>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn honda-red text-white w-100 py-3 rounded-pill fw-bold">
                                <i class="fa-solid fa-paper-plane me-2"></i> Send Message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection