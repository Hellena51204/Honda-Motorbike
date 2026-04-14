@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5 mt-4">
        <h1 class="fw-bold display-4" style="color: #0B1629;">Liên Hệ Với Chúng Tôi</h1>
        <p class="text-secondary fs-5 mt-3">Kết nối với Honda Showroom Hà Nội. Chúng tôi luôn sẵn sàng hỗ trợ bạn!</p>
    </div>

    <div class="row g-5">
        <div class="col-lg-4">
            <a href="tel:1800123456" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm p-4 rounded-4 mb-4 hover-shadow transition">
                    <div class="d-flex align-items-center">
                        <div class="honda-red text-white rounded-3 p-3 me-3 fs-4"><i class="fa-solid fa-phone"></i></div>
                        <div>
                            <h5 class="fw-bold mb-1">Điện thoại</h5>
                            <p class="text-secondary small mb-1">Gọi cho chúng tôi 24/7</p>
                            <h6 class="text-honda-red fw-bold mb-0">1800-123-456</h6>
                        </div>
                    </div>
                </div>
            </a>

            <a href="mailto:support.hanoi@honda.com.vn" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm p-4 rounded-4 mb-4 hover-shadow transition">
                    <div class="d-flex align-items-center">
                        <div class="honda-red text-white rounded-3 p-3 me-3 fs-4"><i class="fa-solid fa-envelope"></i></div>
                        <div>
                            <h5 class="fw-bold mb-1">Email</h5>
                            <p class="text-secondary small mb-1">Gửi phản hồi bất cứ lúc nào</p>
                            <h6 class="text-honda-red fw-bold mb-0">support.hanoi@honda.com.vn</h6>
                        </div>
                    </div>
                </div>
            </a>

            <a href="https://maps.google.com/?q=198+Tran+Quang+Khai+Ha+Noi" target="_blank" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm p-4 rounded-4 mb-4 hover-shadow transition">
                    <div class="d-flex align-items-center">
                        <div class="honda-red text-white rounded-3 p-3 me-3 fs-4"><i class="fa-solid fa-location-dot"></i></div>
                        <div>
                            <h5 class="fw-bold mb-1">Địa chỉ</h5>
                            <p class="text-secondary small mb-1">Ghé thăm Showroom của chúng tôi</p>
                            <h6 class="text-honda-red fw-bold mb-0" style="font-size: 14px;">198 Trần Quang Khải, Hoàn Kiếm, HN</h6>
                        </div>
                    </div>
                </div>
            </a>

            <div class="card border-0 shadow-sm p-4 rounded-4">
                <div class="d-flex align-items-center">
                    <div class="honda-red text-white rounded-3 p-3 me-3 fs-4"><i class="fa-regular fa-clock"></i></div>
                    <div>
                        <h5 class="fw-bold mb-1">Giờ làm việc</h5>
                        <p class="text-secondary small mb-1">Thứ Hai - Thứ Sáu: 8:00 - 18:00<br>Thứ Bảy: 8:00 - 17:00</p>
                        <h6 class="text-honda-red fw-bold mb-0" style="font-size: 14px;">Chủ Nhật: 9:00 - 16:00</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-5 rounded-4 h-100">
                <h3 class="fw-bold mb-4">Gửi Lời Nhắn Cho Chúng Tôi</h3>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Họ và tên *</label>
                            <input type="text" name="name" class="form-control form-control-lg rounded-3 bg-light border-0" placeholder="Nhập tên của bạn" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Địa chỉ Email *</label>
                            <input type="email" name="email" class="form-control form-control-lg rounded-3 bg-light border-0" placeholder="email_cua_ban@example.com" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control form-control-lg rounded-3 bg-light border-0" placeholder="Ví dụ: +84 912 345 678">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Chủ đề cần tư vấn *</label>
                            <select name="subject" class="form-select form-control-lg rounded-3 bg-light border-0" required>
                                <option value="" disabled selected>Chọn chủ đề</option>
                                <option value="Chính sách bảo hành">Chính sách bảo hành</option>
                                <option value="Tư vấn mua trả góp">Tư vấn mua trả góp</option>
                                <option value="Đặt lịch lái thử">Đặt lịch lái thử</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Nội dung tin nhắn *</label>
                            <textarea name="message" class="form-control rounded-3 bg-light border-0" rows="5" placeholder="Cho chúng tôi biết chúng tôi có thể giúp gì bạn..." required></textarea>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn honda-red text-white w-100 py-3 rounded-pill fw-bold fs-5 shadow-sm hover-red">
                                Gửi liên hệ
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row mt-5 pt-5 justify-content-center">
        <div class="col-lg-8 text-center mb-4">
            <h2 class="fw-bold" style="color: #0B1629;">Câu Hỏi Thường Gặp (FAQ)</h2>
            <p class="text-secondary">Giải đáp nhanh các thắc mắc phổ biến của khách hàng.</p>
        </div>
        <div class="col-lg-10">
            <div class="accordion shadow-sm rounded-4 overflow-hidden" id="faqAccordion">
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold py-4" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Chính sách bảo hành xe mới như thế nào?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-secondary pb-4">
                            Tất cả xe máy Honda mới đều được bảo hành chính hãng 3 năm hoặc 30.000km tùy điều kiện nào đến trước. Khách hàng có thể bảo hành tại mọi HEAD trên toàn quốc.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold py-4" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Showroom có hỗ trợ mua xe trả góp không?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-secondary pb-4">
                            Chúng tôi hỗ trợ trả góp qua thẻ tín dụng và các công ty tài chính với lãi suất cực kỳ hấp dẫn chỉ từ 0%. Thủ tục đơn giản, duyệt hồ sơ trong 15 phút.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold py-4" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Tôi có thể đặt lịch lái thử xe ở đâu?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-secondary pb-4">
                            Bạn có thể gọi trực tiếp vào Hotline hoặc điền form liên hệ bên trên, chọn chủ đề 'Đặt lịch lái thử'. Nhân viên CSKH sẽ gọi lại để xác nhận lịch cho bạn.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 pt-5 mb-5">
        <div class="col-12 text-center mb-4">
            <h2 class="fw-bold" style="color: #0B1629;">Bản Đồ Showroom Hà Nội</h2>
            <p class="text-secondary mb-1">198 Trần Quang Khải, Lý Thái Tổ, Hoàn Kiếm, Hà Nội</p>
        </div>
        <div class="col-12">
            <div class="rounded-4 overflow-hidden shadow-sm border" style="height: 450px;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.0865882322363!2d105.85293427503144!3d21.029221980619896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abeb0415aef3%3A0x7d6a5e1823eb21c3!2zMTk4IFRyw6LgbiBRdWFuZyBLaOG6o2ksIEzDvSBUaMOhaSBU4buVLCBIb8OgbiBLaeG6v20sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1700000000000!5m2!1svi!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <p class="text-center text-muted small mt-2 fst-italic">Nhấn vào bản đồ để nhận chỉ đường chi tiết trên Google Maps</p>
        </div>
    </div>
</div>

<button class="btn honda-red text-white position-fixed bottom-0 end-0 m-4 rounded-pill shadow-lg px-4 py-3 fw-bold z-3" data-bs-toggle="modal" data-bs-target="#chatModal">
    <i class="fa-solid fa-headset me-2"></i> Chat với CSKH
</button>

<div class="modal fade" id="chatModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 400px;">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header honda-red text-white border-0 py-3">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-headset me-2"></i> CSKH Trực tuyến</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light" style="min-height: 300px;">
                <div class="d-flex mb-3">
                    <div class="bg-white p-3 rounded-3 shadow-sm" style="border-bottom-left-radius: 0 !important; max-width: 85%;">
                        Chào bạn! Honda Showroom có thể giúp gì cho bạn hôm nay?
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white border-0 py-3">
                <div class="input-group">
                    <input type="text" class="form-control rounded-pill bg-light border-0 ps-3" placeholder="Nhập tin nhắn...">
                    <button class="btn honda-red text-white rounded-circle ms-2" type="button" style="width: 45px; height: 45px;" onclick="alert('Tin nhắn đã được gửi tới tư vấn viên! Chúng tôi sẽ phản hồi trong chốc lát.')">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .transition {
        transition: all 0.3s ease;
    }

    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
    }

    .hover-red:hover {
        background-color: #a00000 !important;
    }

    .accordion-button:not(.collapsed) {
        background-color: #fff5f5;
        color: #cc0000;
    }
</style>
@endsection