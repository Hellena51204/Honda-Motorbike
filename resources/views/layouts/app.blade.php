<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Honda Motorbike - The Power of Dreams</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <style>
        .honda-red {
            background-color: #cc0000 !important;
        }

        /* Khắc phục xung đột Tailwind và Bootstrap */
        .collapse {
            visibility: visible !important;
        }

        .text-honda-red {
            color: #cc0000 !important;
        }

        .nav-link {
            color: #6c757d !important;
            position: relative;
            padding-bottom: 8px !important;
        }

        .nav-link:hover {
            color: #cc0000 !important;
        }

        .nav-link.active {
            color: #cc0000 !important;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 2rem);
            /* trừ đi px-3 padding */
            height: 2px;
            background-color: #cc0000;
        }

        footer a {
            text-decoration: none;
            color: #6c757d;
        }

        footer a:hover {
            color: white;
        }

        /* Ẩn mũi tên dropdown cho nút avatar user */
        .dropdown-toggle-no-caret::after {
            display: none !important;
        }
    </style>
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center mb-0" href="{{ route('home') }}">
                <div class="honda-red text-white px-3 py-1 fw-bold rounded">HONDA</div>
            </a>

            <!-- Vạch phân cách xám theo thiết kế -->
            <div class="vr mx-2 d-none d-lg-block text-secondary" style="width: 2px; opacity: 0.3;"></div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto fw-bold gap-3">
                    <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">Sản phẩm</a></li>
                    <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('contact*') ? 'active' : '' }}" href="{{ route('contact.index') }}">Liên hệ</a></li>
                    <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('blog*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a></li>
                    @auth
                    @if(Auth::user()->role === 'admin')
                    {{-- Admin chỉ thấy "Quản trị" --}}
                    <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('dashboard') || request()->routeIs('admin*') ? 'active' : '' }}" href="{{ route('dashboard') }}">Quản trị</a></li>
                    @else
                    {{-- User thường chỉ thấy "Bảng điều khiển" --}}
                    <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
                    @endif
                    @else
                    {{-- Khách chưa đăng nhập không thấy dashboard/quản trị --}}
                    @endauth
                </ul>
                <div class="d-flex align-items-center gap-4">
                    <a href="{{ route('cart.index') }}" class="text-secondary position-relative">
                        <i class="fa-solid fa-cart-shopping fs-5"></i>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>

                    @guest
                    <a href="{{ route('login') }}" class="text-secondary"><i class="fa-solid fa-user fs-5"></i></a>
                    @else
                    @if(Auth::user()->role === 'admin')
                    {{-- Admin: hiển thị tên --}}
                    <div class="dropdown">
                        <a class="text-dark dropdown-toggle fw-bold text-decoration-none" href="#" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="min-width: 200px;">
                            <li class="px-3 py-2 border-bottom">
                                <div class="fw-bold small">{{ Auth::user()->name }}</div>
                                <div class="text-muted" style="font-size: 0.75rem;">{{ Auth::user()->email }}</div>
                            </li>
                            <li><a class="dropdown-item py-2" href="{{ route('dashboard') }}"><i class="fa-solid fa-gauge me-2 text-danger"></i>Quản trị</a></li>
                            <li><a class="dropdown-item py-2" href="{{ route('orders.index') }}"><i class="fa-solid fa-clock-rotate-left me-2 text-danger"></i>Lịch sử mua hàng</a></li>
                            <li>
                                <hr class="dropdown-divider my-1">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger py-2" type="submit"><i class="fa-solid fa-right-from-bracket me-2"></i>Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @else
                    {{-- User thường: hiển thị avatar/icon --}}
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle dropdown-toggle-no-caret" data-bs-toggle="dropdown" title="{{ Auth::user()->name }}" style="gap: 0;">
                            @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                alt="{{ Auth::user()->name }}"
                                class="rounded-circle"
                                width="36" height="36"
                                style="object-fit: cover; border: 2px solid #e5e7eb; transition: border-color 0.2s;"
                                onmouseover="this.style.borderColor='#cc0000'"
                                onmouseout="this.style.borderColor='#e5e7eb'">
                            @else
                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width:36px; height:36px; background: linear-gradient(135deg, #cc0000, #8b0000); color: white; font-weight: 700; font-size: 0.9rem; cursor: pointer; border: 2px solid transparent; transition: border-color 0.2s;"
                                onmouseover="this.style.borderColor='#cc0000'"
                                onmouseout="this.style.borderColor='transparent'">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3" style="min-width: 220px;">
                            <li class="px-3 py-2 border-bottom">
                                <div class="d-flex align-items-center gap-2">
                                    @if(Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="rounded-circle" width="32" height="32" style="object-fit:cover;">
                                    @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                        style="width:32px; height:32px; background: linear-gradient(135deg, #cc0000, #8b0000); color: white; font-weight: 700; font-size: 0.8rem; flex-shrink:0;">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    @endif
                                    <div>
                                        <div class="fw-bold small">{{ Auth::user()->name }}</div>
                                        <div class="text-muted" style="font-size: 0.72rem;">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>
                            </li>
                            <li><a class="dropdown-item py-2" href="{{ route('dashboard') }}"><i class="fa-regular fa-user me-2 text-danger"></i>Bảng điều khiển</a></li>
                            <li><a class="dropdown-item py-2" href="{{ route('orders.index') }}"><i class="fa-solid fa-clock-rotate-left me-2 text-danger"></i>Lịch sử mua hàng</a></li>
                            <li>
                                <hr class="dropdown-divider my-1">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger py-2" type="submit"><i class="fa-solid fa-right-from-bracket me-2"></i>Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endif
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
        @if(isset($slot)) {{ $slot }} @endif
    </main>

    <footer class="bg-black text-white pt-5 pb-4 mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="honda-red text-white px-3 py-1 fw-bold rounded d-inline-block mb-3">HONDA</div>
                    <p class="small text-secondary">Leading motorcycle manufacturer delivering quality, innovation, and performance since 1948.</p>
                    <div class="d-flex gap-3 fs-5">
                        <i class="fa-brands fa-facebook"></i> <i class="fa-brands fa-instagram"></i> <i class="fa-brands fa-twitter"></i>
                    </div>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold mb-4 text-uppercase">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('products.index') }}">All Products</a></li>
                        <li class="mb-2"><a href="{{ route('contact.index') }}">Contact Us</a></li>
                        <li class="mb-2"><a href="{{ route('blog.index') }}">Blog</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold mb-4 text-uppercase">Customer Service</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('contact.index') }}">FAQ</a></li>
                        <li class="mb-2"><a href="{{ route('contact.index') }}">Test Ride</a></li>
                        <li class="mb-2"><a href="{{ route('contact.index') }}">Owner's Manual</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold mb-4 text-uppercase">Contact Info</h6>
                    <p class="small text-secondary mb-2"><i class="fa-solid fa-location-dot me-2"></i> 123 Honda Street, District 1, HCM</p>
                    <p class="small text-secondary mb-2"><i class="fa-solid fa-phone me-2"></i> 1800-123-456</p>
                    <p class="small text-secondary"><i class="fa-solid fa-envelope me-2"></i> support@honda.com.vn</p>
                </div>
            </div>
            <hr class="mt-5 border-secondary">
            <p class="text-center small text-secondary mb-0">© 2024 Honda Motor Co., Ltd. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <button id="chat-toggle-btn" class="btn rounded-circle shadow-lg d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; position: fixed; bottom: 30px; right: 30px; background-color: #cc0000; color: white; z-index: 1000;">
        <i class="fa-solid fa-message fs-3"></i>
    </button>

    <div id="chat-window" class="card shadow-lg border-0 d-none" style="width: 350px; position: fixed; bottom: 100px; right: 30px; z-index: 1000; border-radius: 15px; overflow: hidden;">
        <div class="text-white p-3 d-flex align-items-center" style="background-color: #cc0000;">
            <div class="bg-white text-danger rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                <i class="fa-solid fa-robot fs-5"></i>
            </div>
            <div>
                <h6 class="mb-0 fw-bold">Honda AI Assistant</h6>
                <small class="text-white-50">Online now</small>
            </div>
            <button id="chat-close-btn" class="btn text-white ms-auto p-0"><i class="fa-solid fa-xmark fs-5"></i></button>
        </div>

        <div id="chat-body" class="p-3" style="height: 300px; overflow-y: auto; background-color: #f8f9fa;">
            <div class="d-flex mb-3">
                <div class="bg-white p-2 rounded-3 shadow-sm text-dark" style="max-width: 80%;">
                    Xin chào! Tôi là Trợ lý ảo Honda. Tôi có thể giúp gì cho bạn hôm nay?
                </div>
            </div>
        </div>

        <div class="p-2 bg-white border-top">
            <small class="text-muted d-block mb-2">Câu hỏi thường gặp:</small>
            <div class="d-flex flex-wrap gap-2" id="quick-replies">
            </div>
        </div>

        <div class="p-2 bg-white border-top d-flex align-items-center">
            <input type="text" id="chat-input" class="form-control border-0 bg-light rounded-pill px-3" placeholder="Nhập tin nhắn...">
            <button id="chat-send-btn" class="btn text-white rounded-circle ms-2" style="background-color: #cc0000; width: 40px; height: 40px;">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const chatToggleBtn = document.getElementById('chat-toggle-btn');
            const chatWindow = document.getElementById('chat-window');
            const chatCloseBtn = document.getElementById('chat-close-btn');
            const chatBody = document.getElementById('chat-body');
            const quickRepliesContainer = document.getElementById('quick-replies');

            // Mở/Đóng Chatbox
            chatToggleBtn.addEventListener('click', () => chatWindow.classList.toggle('d-none'));
            chatCloseBtn.addEventListener('click', () => chatWindow.classList.add('d-none'));

            // BỘ DỮ LIỆU CÂU HỎI - TRẢ LỜI TỰ ĐỘNG
            const botData = {
                "Giá xe Vision?": "Hiện tại Honda Vision 2024 có giá khởi điểm từ 29.900.000 VNĐ (tùy phiên bản). Bạn muốn xem chi tiết ở mục Sản phẩm không?",
                "Thủ tục trả góp?": "Trả góp chỉ cần CCCD gắn chip. Trả trước từ 20-30% giá trị xe, lãi suất 0% cho thẻ tín dụng. Vui lòng để lại số điện thoại để nhân viên gọi tư vấn nhé!",
                "Đăng ký lái thử?": "Tuyệt vời! Bạn có thể mang theo Bằng lái xe (A1/A2) đến Showroom tại 123 Honda Street, Quận 1 để trải nghiệm thực tế mọi dòng xe."
            };

            // Hiển thị các nút câu hỏi gợi ý
            Object.keys(botData).forEach(question => {
                let btn = document.createElement('button');
                btn.className = "btn btn-sm btn-outline-secondary rounded-pill bg-light text-dark border-0";
                btn.innerText = question;
                btn.onclick = function() {
                    appendMessage(question, 'user');
                    setTimeout(() => appendMessage(botData[question], 'bot'), 600); // Giả vờ bot đang gõ chữ 0.6 giây
                };
                quickRepliesContainer.appendChild(btn);
            });

            // Hàm in tin nhắn ra màn hình
            function appendMessage(text, sender) {
                let msgDiv = document.createElement('div');
                msgDiv.className = `d-flex mb-3 ${sender === 'user' ? 'justify-content-end' : ''}`;

                let bubble = document.createElement('div');
                bubble.className = `p-2 rounded-3 shadow-sm ${sender === 'user' ? 'text-white' : 'bg-white text-dark'}`;
                bubble.style.maxWidth = '80%';
                if (sender === 'user') bubble.style.backgroundColor = '#cc0000';

                bubble.innerText = text;
                msgDiv.appendChild(bubble);
                chatBody.appendChild(msgDiv);
                chatBody.scrollTop = chatBody.scrollHeight; // Tự động cuộn xuống tin nhắn mới nhất
            }
            const chatInput = document.getElementById('chat-input');
            const chatSendBtn = document.getElementById('chat-send-btn');

            // Hàm xử lý khi người dùng tự nhập tin nhắn
            async function handleUserSendMessage() {
                const text = chatInput.value.trim();
                if (!text) return; // Không làm gì nếu ô chat trống

                // 1. Hiển thị tin nhắn lên màn hình của khách ngay lập tức
                appendMessage(text, 'user');
                chatInput.value = ''; // Xóa trắng ô nhập

                // 2. Gửi tin nhắn ngầm (AJAX) lên Server để lưu vào Database
                try {
                    const response = await fetch('/chat/send', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            message: text
                        })
                    });
                    const result = await response.json();

                    // Nếu có câu trả lời tự động từ Server thì hiện ra
                    if (result.reply) {
                        setTimeout(() => appendMessage(result.reply, 'bot'), 500);
                    }
                } catch (error) {
                    console.error("Lỗi khi gửi tin nhắn", error);
                }
            }

            // Lắng nghe sự kiện click nút Gửi
            chatSendBtn.addEventListener('click', handleUserSendMessage);

            // Lắng nghe sự kiện bấm phím Enter
            chatInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    handleUserSendMessage();
                }
            });
        });
    </script>
</body>

</html>