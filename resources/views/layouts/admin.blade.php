<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Honda Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        /* ── TOP NAVBAR ──────────────────────────────── */
        .admin-topbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 64px;
            background: #fff;
            border-bottom: 1px solid #e8eaed;
            display: flex;
            align-items: center;
            padding: 0 24px;
            z-index: 1000;
            gap: 16px;
        }

        .topbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .topbar-logo {
            background: #cc0000;
            color: #fff;
            font-weight: 800;
            font-size: 1rem;
            padding: 6px 14px;
            border-radius: 8px;
            letter-spacing: 1px;
        }

        .topbar-nav {
            display: flex;
            align-items: center;
            gap: 4px;
            flex: 1;
            justify-content: center;
        }

        .topbar-nav a {
            color: #555;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            padding: 6px 14px;
            border-radius: 6px;
            transition: color 0.2s, background 0.2s;
        }

        .topbar-nav a:hover { color: #cc0000; background: #fef2f2; }
        .topbar-nav a.active { color: #cc0000; font-weight: 700; border-bottom: 2px solid #cc0000; border-radius: 0; background: transparent; }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .topbar-icon-btn {
            position: relative;
            color: #555;
            font-size: 1.1rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .topbar-icon-btn:hover { color: #cc0000; }

        .topbar-user-dropdown .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #222;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .topbar-user-dropdown .dropdown-toggle::after { display: none; }

        /* ── WRAPPER ─────────────────────────────────── */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
            padding-top: 64px;
        }

        /* ── SIDEBAR ─────────────────────────────────── */
        .admin-sidebar {
            width: 220px;
            min-height: calc(100vh - 64px);
            background: #111827;
            position: fixed;
            top: 64px; left: 0; bottom: 0;
            display: flex;
            flex-direction: column;
            padding: 20px 0;
            z-index: 900;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            margin-bottom: 8px;
        }

        .sidebar-brand-title {
            color: #fff;
            font-weight: 800;
            font-size: 1.15rem;
            letter-spacing: 1px;
        }

        .sidebar-brand-sub {
            color: #9ca3af;
            font-size: 0.72rem;
            margin-top: 2px;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
            flex: 1;
        }

        .sidebar-nav li a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #9ca3af;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            padding: 11px 20px;
            border-radius: 0;
            transition: color 0.2s, background 0.2s;
            margin: 2px 0;
        }

        .sidebar-nav li a i {
            font-size: 1rem;
            width: 20px;
            text-align: center;
        }

        .sidebar-nav li a:hover {
            color: #fff;
            background: rgba(255,255,255,0.07);
        }

        .sidebar-nav li a.active {
            color: #fff;
            background: #cc0000;
            border-radius: 8px;
            margin: 2px 12px;
            padding: 11px 14px;
            font-weight: 600;
        }

        /* ── MAIN CONTENT ────────────────────────────── */
        .admin-main {
            margin-left: 220px;
            flex: 1;
            padding: 32px;
            min-width: 0;
        }

        /* ── STAT CARDS ─────────────────────────────── */
        .admin-stat-card {
            border-radius: 16px;
            padding: 24px;
            color: #fff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .admin-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 28px rgba(0,0,0,0.18);
        }

        .stat-label {
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            opacity: 0.85;
        }

        .stat-number {
            font-size: 2.4rem;
            font-weight: 800;
            line-height: 1.1;
            margin: 4px 0 2px;
        }

        .stat-link {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 14px;
            transition: color 0.2s;
        }

        .stat-link:hover { color: #fff; }

        /* ── SECTION HEADER ─────────────────────────── */
        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .section-header-bar {
            width: 4px;
            height: 22px;
            background: #cc0000;
            border-radius: 2px;
        }

        .section-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #111827;
            margin: 0;
        }

        /* ── TABLE ──────────────────────────────────── */
        .admin-table {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }

        .admin-table table thead th {
            background: #f8f9fa;
            color: #6b7280;
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e9ecef;
            padding: 12px 16px;
        }

        .admin-table table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 0.88rem;
            vertical-align: middle;
        }

        .admin-table table tbody tr:last-child td { border-bottom: none; }
        .admin-table table tbody tr:hover { background: #fafafa; }

        /* ── MEMBERSHIP BADGES ──────────────────────── */
        .membership-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .badge-none    { background: #f3f4f6; color: #6b7280; }
        .badge-silver  { background: #e2e8f0; color: #475569; }
        .badge-gold    { background: #fef3c7; color: #92400e; }
        .badge-diamond { background: #ede9fe; color: #5b21b6; }

        /* ── CHAT BUTTON ────────────────────────────── */
        .chat-float-btn {
            position: fixed;
            bottom: 28px;
            right: 28px;
            width: 52px;
            height: 52px;
            background: #cc0000;
            color: #fff;
            border: none;
            border-radius: 50%;
            box-shadow: 0 4px 16px rgba(204,0,0,0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            cursor: pointer;
            z-index: 2000;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .chat-float-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 24px rgba(204,0,0,0.45);
        }

        /* ── COLLAPSE FIX ───────────────────────────── */
        .collapse { visibility: visible !important; }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-sidebar { display: none; }
            .admin-main { margin-left: 0; padding: 16px; }
        }
    </style>
</head>

<body>

    {{-- ─── TOP NAVBAR ─────────────────────────────────── --}}
    <nav class="admin-topbar">
        <a class="topbar-brand" href="{{ route('home') }}">
            <span class="topbar-logo">HONDA</span>
        </a>

        <div class="topbar-nav">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Trang chủ</a>
            <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products*') ? 'active' : '' }}">Sản phẩm</a>
            <a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact*') ? 'active' : '' }}">Liên hệ</a>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') || request()->routeIs('admin*') ? 'active' : '' }}">Quản trị</a>
        </div>

        <div class="topbar-right">
            <a href="{{ route('cart.index') }}" class="topbar-icon-btn position-relative">
                <i class="fa-solid fa-cart-shopping"></i>
                @if(session('cart') && count(session('cart')) > 0)
                    <span class="position-absolute badge rounded-pill bg-danger"
                          style="font-size:0.55rem; top:-6px; right:-8px; min-width:16px; padding:2px 4px;">
                        {{ count(session('cart')) }}
                    </span>
                @endif
            </a>

            @auth
            <div class="dropdown topbar-user-dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                             class="rounded-circle" width="32" height="32" style="object-fit:cover;">
                    @else
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                             style="width:32px;height:32px;background:linear-gradient(135deg,#cc0000,#8b0000);color:#fff;font-weight:700;font-size:0.85rem;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2" style="min-width:200px;">
                    <li class="px-3 py-2 border-bottom">
                        <div class="fw-bold small">{{ Auth::user()->name }}</div>
                        <div class="text-muted" style="font-size:0.72rem;">{{ Auth::user()->email }}</div>
                    </li>
                    <li><a class="dropdown-item py-2" href="{{ route('dashboard') }}">
                        <i class="fa-solid fa-gauge me-2 text-danger"></i>Quản trị
                    </a></li>
                    <li><hr class="dropdown-divider my-1"></li>
                    <li>
                        <a class="dropdown-item text-danger py-2" href="{{ route('logout') }}">
                            <i class="fa-solid fa-right-from-bracket me-2"></i>Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
            @endauth
        </div>
    </nav>

    {{-- ─── WRAPPER ─────────────────────────────────────── --}}
    <div class="admin-wrapper">

        {{-- ─── SIDEBAR ─────────────────────────────────── --}}
        <aside class="admin-sidebar">
            <div class="sidebar-brand">
                <div class="sidebar-brand-title">HONDA</div>
                <div class="sidebar-brand-sub">Admin Panel</div>
            </div>

            <ul class="sidebar-nav">
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-gauge-high"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}"
                       class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                        <i class="fa-solid fa-motorcycle"></i>
                        Sản phẩm
                    </a>
                </li>
                <li>
                    <a href="{{ route('orders.index') }}"
                       class="{{ request()->routeIs('orders*') ? 'active' : '' }}">
                        <i class="fa-solid fa-clipboard-list"></i>
                        Đơn hàng
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}"
                       class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                        <i class="fa-solid fa-users"></i>
                        Thành viên
                    </a>
                </li>
            </ul>
        </aside>

        {{-- ─── MAIN CONTENT ────────────────────────────── --}}
        <main class="admin-main">
            @yield('content')
        </main>
    </div>

    {{-- ─── CHAT BUTTON ─────────────────────────────────── --}}
    <button id="chat-toggle-btn" class="chat-float-btn">
        <i class="fa-solid fa-message"></i>
    </button>

    <div id="chat-window" class="card shadow-lg border-0 d-none"
         style="width:350px;position:fixed;bottom:90px;right:28px;z-index:2001;border-radius:16px;overflow:hidden;">
        <div class="text-white p-3 d-flex align-items-center" style="background:#cc0000;">
            <div class="bg-white text-danger rounded-circle d-flex align-items-center justify-content-center me-2"
                 style="width:38px;height:38px;">
                <i class="fa-solid fa-robot"></i>
            </div>
            <div>
                <h6 class="mb-0 fw-bold" style="font-size:0.9rem;">Honda AI Assistant</h6>
                <small class="text-white-50" style="font-size:0.72rem;">Online now</small>
            </div>
            <button id="chat-close-btn" class="btn text-white ms-auto p-0">
                <i class="fa-solid fa-xmark fs-5"></i>
            </button>
        </div>
        <div id="chat-body" class="p-3" style="height:280px;overflow-y:auto;background:#f8f9fa;">
            <div class="d-flex mb-3">
                <div class="bg-white p-2 rounded-3 shadow-sm text-dark" style="max-width:80%;font-size:0.85rem;">
                    Xin chào! Tôi là Trợ lý ảo Honda. Tôi có thể giúp gì cho bạn?
                </div>
            </div>
        </div>
        <div class="p-2 bg-white border-top">
            <small class="text-muted d-block mb-2" style="font-size:0.75rem;">Câu hỏi thường gặp:</small>
            <div class="d-flex flex-wrap gap-1" id="quick-replies"></div>
        </div>
        <div class="p-2 bg-white border-top d-flex align-items-center">
            <input type="text" id="chat-input" class="form-control border-0 bg-light rounded-pill px-3"
                   style="font-size:0.85rem;" placeholder="Nhập tin nhắn...">
            <button id="chat-send-btn" class="btn text-white rounded-circle ms-2"
                    style="background:#cc0000;width:38px;height:38px;min-width:38px;">
                <i class="fa-solid fa-paper-plane" style="font-size:0.85rem;"></i>
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const chatToggleBtn = document.getElementById('chat-toggle-btn');
            const chatWindow    = document.getElementById('chat-window');
            const chatCloseBtn  = document.getElementById('chat-close-btn');
            const chatBody      = document.getElementById('chat-body');
            const quickRepliesContainer = document.getElementById('quick-replies');

            chatToggleBtn.addEventListener('click', () => chatWindow.classList.toggle('d-none'));
            chatCloseBtn.addEventListener('click', () => chatWindow.classList.add('d-none'));

            const botData = {
                "Giá xe Vision?": "Hiện tại Honda Vision 2024 có giá khởi điểm từ 29.900.000 VNĐ (tùy phiên bản).",
                "Thủ tục trả góp?": "Trả góp chỉ cần CCCD gắn chip. Trả trước từ 20-30% giá trị xe, lãi suất 0% cho thẻ tín dụng.",
                "Đăng ký lái thử?": "Mang theo Bằng lái xe (A1/A2) đến Showroom tại 123 Honda Street, Quận 1."
            };

            Object.keys(botData).forEach(question => {
                let btn = document.createElement('button');
                btn.className = "btn btn-sm btn-outline-secondary rounded-pill bg-light text-dark border-0";
                btn.style.fontSize = "0.72rem";
                btn.innerText = question;
                btn.onclick = function () {
                    appendMessage(question, 'user');
                    setTimeout(() => appendMessage(botData[question], 'bot'), 600);
                };
                quickRepliesContainer.appendChild(btn);
            });

            function appendMessage(text, sender) {
                let msgDiv = document.createElement('div');
                msgDiv.className = `d-flex mb-3 ${sender === 'user' ? 'justify-content-end' : ''}`;
                let bubble = document.createElement('div');
                bubble.className = `p-2 rounded-3 shadow-sm ${sender === 'user' ? 'text-white' : 'bg-white text-dark'}`;
                bubble.style.maxWidth = '80%';
                bubble.style.fontSize = '0.83rem';
                if (sender === 'user') bubble.style.backgroundColor = '#cc0000';
                bubble.innerText = text;
                msgDiv.appendChild(bubble);
                chatBody.appendChild(msgDiv);
                chatBody.scrollTop = chatBody.scrollHeight;
            }

            const chatInput   = document.getElementById('chat-input');
            const chatSendBtn = document.getElementById('chat-send-btn');

            async function handleUserSendMessage() {
                const text = chatInput.value.trim();
                if (!text) return;
                appendMessage(text, 'user');
                chatInput.value = '';
                try {
                    const response = await fetch('/chat/send', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ message: text })
                    });
                    const result = await response.json();
                    if (result.reply) setTimeout(() => appendMessage(result.reply, 'bot'), 500);
                } catch (e) { console.error(e); }
            }

            chatSendBtn.addEventListener('click', handleUserSendMessage);
            chatInput.addEventListener('keypress', e => { if (e.key === 'Enter') handleUserSendMessage(); });
        });
    </script>
</body>
</html>
