{{-- ╔══════════════════════════════════════════════════════╗
     ║                  USER DASHBOARD                     ║
     ╚══════════════════════════════════════════════════════╝ --}}

{{-- Hero Header --}}
<div class="user-hero">
    <div class="container user-hero-content">
        <div class="d-flex align-items-center gap-4 flex-wrap">
            {{-- Avatar --}}
            <form action="{{ route('dashboard.avatar.update') }}" method="POST" enctype="multipart/form-data" id="avatarForm">
                @csrf
                <div class="avatar-wrapper">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" class="avatar-img" alt="Avatar">
                    @else
                        <div class="avatar-img bg-white d-flex align-items-center justify-content-center" style="background: rgba(255,255,255,0.15) !important;">
                            <i class="fa-regular fa-circle-user" style="font-size: 3.5rem; color: rgba(255,255,255,0.5);"></i>
                        </div>
                    @endif
                    <label for="avatarInput" class="avatar-edit-btn" title="Đổi ảnh đại diện">
                        <i class="fa-solid fa-camera"></i>
                    </label>
                    <input type="file" id="avatarInput" name="avatar" class="d-none" accept="image/*" onchange="document.getElementById('avatarForm').submit()">
                </div>
            </form>

            {{-- Info --}}
            <div class="text-white">
                <div class="d-flex align-items-center gap-3 mb-1 flex-wrap">
                    <h2 class="fw-bold mb-0">{{ $user->name }}</h2>
                    @php
                        $memberBadgeMap = [
                            'none'    => ['label' => 'Chưa xếp hạng', 'icon' => '🔘'],
                            'silver'  => ['label' => 'Hạng Bạc',      'icon' => '🥈'],
                            'gold'    => ['label' => 'Hạng Vàng',     'icon' => '🥇'],
                            'diamond' => ['label' => 'Hạng Kim Cương','icon' => '💎'],
                        ];
                        $mb = $memberBadgeMap[$user->membership] ?? $memberBadgeMap['none'];
                    @endphp
                    <span class="membership-badge badge-{{ $user->membership }}">
                        {{ $mb['icon'] }} {{ $mb['label'] }}
                    </span>
                </div>
                <p class="mb-0 opacity-75 small">{{ $user->email }}</p>
                <p class="mb-0 opacity-60 small mt-1">Thành viên từ {{ $user->created_at->format('m/Y') }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Content --}}
<div class="container" style="margin-top: -2.5rem;">
    @if($errors->any())
        <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="row g-4">
        {{-- Cột trái: Thông tin cá nhân --}}
        <div class="col-lg-7">
            <div class="dash-card">
                <div class="dash-card-header">
                    <div class="icon"><i class="fa-regular fa-user"></i></div>
                    Thông tin cá nhân
                    <button class="btn-edit-profile ms-auto" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="fa-solid fa-pen-to-square"></i> Chỉnh sửa
                    </button>
                </div>
                <div class="dash-card-body">
                    <div class="profile-row">
                        <span class="label"><i class="fa-regular fa-user me-1"></i> Họ tên</span>
                        <span class="value">{{ $user->name }}</span>
                    </div>
                    <div class="profile-row">
                        <span class="label"><i class="fa-regular fa-envelope me-1"></i> Email</span>
                        <span class="value">{{ $user->email }}</span>
                    </div>
                    <div class="profile-row">
                        <span class="label"><i class="fa-solid fa-phone me-1"></i> Điện thoại</span>
                        <span class="value {{ $user->phone ? '' : 'text-secondary fst-italic' }}">{{ $user->phone ?: 'Chưa cập nhật' }}</span>
                    </div>
                    <div class="profile-row">
                        <span class="label"><i class="fa-solid fa-location-dot me-1"></i> Địa chỉ</span>
                        <span class="value {{ $user->address ? '' : 'text-secondary fst-italic' }}">{{ $user->address ?: 'Chưa cập nhật' }}</span>
                    </div>
                </div>
            </div>

            {{-- Quick links --}}
            <div class="dash-card mt-4">
                <div class="dash-card-header">
                    <div class="icon"><i class="fa-solid fa-bolt"></i></div>
                    Truy cập nhanh
                </div>
                <div class="dash-card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="{{ route('products.index') }}" class="d-flex align-items-center gap-3 p-3 rounded-3 text-decoration-none" style="background:#fff5f5; color:#cc0000; border: 1px solid #ffe4e4; transition: all 0.2s;" onmouseover="this.style.background='#ffe4e4'" onmouseout="this.style.background='#fff5f5'">
                                <i class="fa-solid fa-motorcycle fa-lg"></i>
                                <span class="fw-semibold small">Xem sản phẩm</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('contact.index') }}" class="d-flex align-items-center gap-3 p-3 rounded-3 text-decoration-none" style="background:#f0f9ff; color:#0284c7; border: 1px solid #e0f2fe; transition: all 0.2s;" onmouseover="this.style.background='#e0f2fe'" onmouseout="this.style.background='#f0f9ff'">
                                <i class="fa-solid fa-headset fa-lg"></i>
                                <span class="fw-semibold small">Liên hệ hỗ trợ</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cột phải: Membership --}}
        <div class="col-lg-5">
            @php
                $tierMap = [
                    'none'    => [
                        'label' => 'Chưa xếp hạng',
                        'icon'  => '🔘',
                        'class' => 'membership-none',
                        'next'  => 'Hạng Bạc',
                        'next_pts' => 500,
                        'perks' => ['Truy cập website', 'Xem sản phẩm'],
                    ],
                    'silver'  => [
                        'label' => 'Hạng Bạc',
                        'icon'  => '🥈',
                        'class' => 'membership-silver',
                        'next'  => 'Hạng Vàng',
                        'next_pts' => 2000,
                        'perks' => ['Ưu đãi 5% khi mua xe', 'Hỗ trợ ưu tiên', 'Quà sinh nhật đặc biệt'],
                    ],
                    'gold'    => [
                        'label' => 'Hạng Vàng',
                        'icon'  => '🥇',
                        'class' => 'membership-gold',
                        'next'  => 'Hạng Kim Cương',
                        'next_pts' => 5000,
                        'perks' => ['Ưu đãi 10% khi mua xe', 'Bảo dưỡng miễn phí 1 lần/năm', 'Hỗ trợ 24/7', 'Quà sinh nhật VIP'],
                    ],
                    'diamond' => [
                        'label' => 'Hạng Kim Cương',
                        'icon'  => '💎',
                        'class' => 'membership-diamond',
                        'next'  => null,
                        'next_pts' => null,
                        'perks' => ['Ưu đãi 15% khi mua xe', 'Bảo dưỡng miễn phí không giới hạn', 'Tư vấn riêng 24/7', 'Quà tặng cao cấp hàng quý', 'Ưu tiên đặt hàng mẫu mới'],
                    ],
                ];
                $tier = $tierMap[$user->membership] ?? $tierMap['none'];
                $pts  = $user->membership_points;
                $nextPts = $tier['next_pts'];
                $progress = $nextPts ? min(100, round(($pts / $nextPts) * 100)) : 100;
            @endphp

            <div class="membership-card {{ $tier['class'] }}">
                <div class="card-content">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <div style="font-size:0.7rem; text-transform:uppercase; letter-spacing:1px; opacity:0.75;">Membership</div>
                            <div style="font-size:1.6rem; font-weight:800; line-height:1.2;">{{ $tier['icon'] }} {{ $tier['label'] }}</div>
                        </div>
                        <div class="text-end">
                            <div style="font-size:0.7rem; opacity:0.75;">Điểm tích lũy</div>
                            <div style="font-size:2rem; font-weight:800; line-height:1;">{{ number_format($pts) }}</div>
                        </div>
                    </div>

                    @if($tier['next'])
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1" style="font-size:0.78rem; opacity:0.85;">
                            <span>{{ $pts }} điểm</span>
                            <span>{{ number_format($nextPts) }} để lên {{ $tier['next'] }}</span>
                        </div>
                        <div class="points-bar-container">
                            <div class="points-bar" style="width: {{ $progress }}%"></div>
                        </div>
                    </div>
                    @else
                    <div class="mb-4 p-2 rounded-3 text-center" style="background: rgba(255,255,255,0.15); font-size:0.82rem;">
                        🎊 Bạn đang ở hạng cao nhất!
                    </div>
                    @endif

                    <div>
                        <div style="font-size:0.72rem; text-transform:uppercase; letter-spacing:1px; opacity:0.7; margin-bottom:8px;">Quyền lợi của bạn</div>
                        @foreach($tier['perks'] as $perk)
                        <div class="perk-item">
                            <i class="fa-solid fa-check-circle"></i> {{ $perk }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Hướng dẫn nâng hạng --}}
            @if($user->membership !== 'diamond' && $user->membership !== 'none')
            <div class="dash-card mt-4">
                <div class="dash-card-header">
                    <div class="icon"><i class="fa-solid fa-chart-line"></i></div>
                    Cách tích điểm
                </div>
                <div class="dash-card-body">
                    <div class="d-flex align-items-center gap-3 mb-3 p-3 rounded-3 bg-light">
                        <i class="fa-solid fa-motorcycle text-danger fs-5"></i>
                        <div>
                            <div class="fw-semibold small">Mua xe Honda</div>
                            <div class="text-secondary" style="font-size:0.78rem;">+100 điểm / lần mua</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 p-3 rounded-3 bg-light">
                        <i class="fa-solid fa-wrench text-primary fs-5"></i>
                        <div>
                            <div class="fw-semibold small">Bảo dưỡng định kỳ</div>
                            <div class="text-secondary" style="font-size:0.78rem;">+20 điểm / lần bảo dưỡng</div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Modal: Sửa thông tin cá nhân --}}
<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 px-4 pt-4 pb-0">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-pen-to-square me-2 text-danger"></i>Chỉnh sửa thông tin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('dashboard.profile.update') }}" method="POST">
                @csrf @method('PATCH')
                <div class="modal-body px-4 py-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-uppercase text-secondary">Họ và tên <span class="text-danger">*</span></label>
                        <input type="text" class="form-control rounded-3 @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-uppercase text-secondary">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control rounded-3 @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-uppercase text-secondary">Số điện thoại</label>
                        <input type="text" class="form-control rounded-3 @error('phone') is-invalid @enderror"
                               name="phone" value="{{ old('phone', $user->phone) }}" placeholder="VD: 0901234567">
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-1">
                        <label class="form-label fw-semibold small text-uppercase text-secondary">Địa chỉ</label>
                        <textarea class="form-control rounded-3 @error('address') is-invalid @enderror"
                                  name="address" rows="2" placeholder="Số nhà, đường, phường, tỉnh/thành">{{ old('address', $user->address) }}</textarea>
                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold">
                        <i class="fa-solid fa-check me-1"></i> Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Tự động mở modal nếu có lỗi validation --}}
@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = new bootstrap.Modal(document.getElementById('editProfileModal'));
        modal.show();
    });
</script>
@endif
