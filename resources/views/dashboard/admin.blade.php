{{-- ╔══════════════════════════════════════════════════════╗
     ║                  ADMIN DASHBOARD                    ║
     ╚══════════════════════════════════════════════════════╝ --}}

<div class="container">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold mb-1">Quản trị hệ thống</h2>
            <p class="text-secondary mb-0 small">Chào mừng trở lại, {{ $user->name }}!</p>
        </div>
        <span class="badge bg-danger px-3 py-2 rounded-pill">
            <i class="fa-solid fa-shield-halved me-1"></i> Admin
        </span>
    </div>

    {{-- Stat Cards --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="admin-stat-card" style="background: linear-gradient(135deg, #cc0000, #8b0000);">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="stat-icon">
                        <div class="stat-label mb-2">Tổng sản phẩm</div>
                        <div class="stat-number">{{ $totalProducts }}</div>
                    </div>
                    <i class="fa-solid fa-motorcycle fa-3x opacity-25"></i>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.products.index') }}" class="text-white text-decoration-none fw-bold small">
                        Quản lý sản phẩm <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="admin-stat-card" style="background: linear-gradient(135deg, #1f2937, #374151);">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="stat-icon">
                        <div class="stat-label mb-2">Thư phản hồi</div>
                        <div class="stat-number">{{ $totalContacts }}</div>
                    </div>
                    <i class="fa-solid fa-envelope fa-3x opacity-25"></i>
                </div>
                <div class="mt-3">
                    <a href="#messages-sec" class="text-white text-decoration-none fw-bold small">
                        Xem hộp thư <i class="fa-solid fa-arrow-down ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="admin-stat-card" style="background: linear-gradient(135deg, #7c3aed, #4f46e5);">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="stat-icon">
                        <div class="stat-label mb-2">Thành viên</div>
                        <div class="stat-number">{{ $totalUsers }}</div>
                    </div>
                    <i class="fa-solid fa-users fa-3x opacity-25"></i>
                </div>
                <div class="mt-3">
                    <a href="#members-sec" class="text-white text-decoration-none fw-bold small">
                        Phân hạng thành viên <i class="fa-solid fa-arrow-down ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Quản lý thành viên --}}
    <div class="mb-5" id="members-sec">
        <div class="section-header">
            <h5 class="section-title">Quản lý thành viên &amp; Membership</h5>
        </div>
        <div class="admin-table">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="padding-left:1.25rem;">Thành viên</th>
                        <th>Liên hệ</th>
                        <th>Điểm tích lũy</th>
                        <th>Hạng hiện tại</th>
                        <th class="text-end" style="padding-right:1.25rem;">Cập nhật hạng</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $member)
                    <tr>
                        <td style="padding-left:1.25rem;">
                            <div class="d-flex align-items-center gap-3">
                                @if($member->avatar)
                                    <img src="{{ asset('storage/' . $member->avatar) }}" class="rounded-circle" width="40" height="40" style="object-fit:cover; border: 2px solid #eee;">
                                @else
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:40px;height:40px;font-size:18px;color:#aaa;">
                                        <i class="fa-regular fa-circle-user"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold">{{ $member->name }}</div>
                                    <div class="text-secondary small">Đăng ký: {{ $member->created_at->format('d/m/Y') }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="small">{{ $member->email }}</div>
                            @if($member->phone)
                                <div class="small text-secondary">{{ $member->phone }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="fw-bold text-dark">{{ number_format($member->membership_points) }}</span>
                            <span class="text-secondary small"> điểm</span>
                        </td>
                        <td>
                            @php
                                $badgeMap = [
                                    'none'    => ['label' => 'Chưa xếp hạng', 'icon' => '🔘', 'class' => 'badge-none'],
                                    'silver'  => ['label' => 'Bạc',           'icon' => '🥈', 'class' => 'badge-silver'],
                                    'gold'    => ['label' => 'Vàng',          'icon' => '🥇', 'class' => 'badge-gold'],
                                    'diamond' => ['label' => 'Kim Cương',     'icon' => '💎', 'class' => 'badge-diamond'],
                                ];
                                $b = $badgeMap[$member->membership] ?? $badgeMap['none'];
                            @endphp
                            <span class="membership-badge {{ $b['class'] }}">
                                {{ $b['icon'] }} {{ $b['label'] }}
                            </span>
                        </td>
                        <td class="text-end" style="padding-right:1.25rem;">
                            <button class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                    data-bs-toggle="modal"
                                    data-bs-target="#membershipModal{{ $member->id }}">
                                <i class="fa-solid fa-pen-to-square me-1"></i> Chỉnh hạng
                            </button>

                            {{-- Modal --}}
                            <div class="modal fade" id="membershipModal{{ $member->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg rounded-4">
                                        <div class="modal-header border-0 pb-0 px-4 pt-4">
                                            <h5 class="modal-title fw-bold">Phân hạng: {{ $member->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('admin.users.membership', $member->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <div class="modal-body px-4 py-3 text-start">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold small text-uppercase text-secondary">Hạng thành viên</label>
                                                    <select class="form-select rounded-3" name="membership">
                                                        <option value="none"    {{ $member->membership === 'none'    ? 'selected' : '' }}>🔘 Chưa xếp hạng</option>
                                                        <option value="silver"  {{ $member->membership === 'silver'  ? 'selected' : '' }}>🥈 Bạc</option>
                                                        <option value="gold"    {{ $member->membership === 'gold'    ? 'selected' : '' }}>🥇 Vàng</option>
                                                        <option value="diamond" {{ $member->membership === 'diamond' ? 'selected' : '' }}>💎 Kim Cương</option>
                                                    </select>
                                                </div>
                                                <div class="mb-1">
                                                    <label class="form-label fw-semibold small text-uppercase text-secondary">Điểm tích lũy</label>
                                                    <input type="number" class="form-control rounded-3" name="membership_points"
                                                           value="{{ $member->membership_points }}" min="0">
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0 px-4 pb-4">
                                                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Hủy</button>
                                                <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold">
                                                    <i class="fa-solid fa-check me-1"></i> Lưu
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-secondary">
                            <i class="fa-regular fa-users fa-3x mb-3 d-block text-muted"></i>
                            Chưa có thành viên nào.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Hộp thư phản hồi --}}
    <div id="messages-sec">
        <div class="section-header">
            <h5 class="section-title">Hộp thư phản hồi từ khách hàng</h5>
        </div>
        <div class="admin-table">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="padding-left:1.25rem;">Ngày gửi</th>
                        <th>Thông tin khách</th>
                        <th>Tiêu đề - Nội dung</th>
                        <th class="text-end" style="padding-right:1.25rem;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                    <tr>
                        <td class="text-nowrap text-secondary small" style="padding-left:1.25rem;">
                            {{ $contact->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td>
                            <div class="fw-bold">{{ $contact->name }}</div>
                            <div class="text-secondary small">{{ $contact->email }}</div>
                        </td>
                        <td style="max-width: 300px;">
                            <div class="fw-bold text-truncate">{{ $contact->subject }}</div>
                            <p class="mb-0 text-secondary small text-truncate" title="{{ $contact->message }}">{{ $contact->message }}</p>
                        </td>
                        <td class="text-end text-nowrap" style="padding-right:1.25rem;">
                            <button class="btn btn-sm btn-outline-secondary me-1 rounded-pill" data-bs-toggle="modal" data-bs-target="#contactModal{{ $contact->id }}">
                                <i class="fa-regular fa-eye"></i> Xem
                            </button>
                            <a href="mailto:{{ $contact->email }}?subject=RE: {{ $contact->subject }}" class="btn btn-sm btn-outline-primary me-1 rounded-pill">
                                <i class="fa-solid fa-reply"></i>
                            </a>
                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa thư này?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                            {{-- Modal Chi tiết --}}
                            <div class="modal fade text-start" id="contactModal{{ $contact->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content border-0 shadow-lg rounded-4">
                                        <div class="modal-header border-0 px-4 pt-4 pb-2">
                                            <h5 class="modal-title fw-bold">Chi tiết liên hệ</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body px-4">
                                            <h6 class="fw-bold mb-3">Thông tin người gửi:</h6>
                                            <ul class="list-unstyled mb-4 text-secondary">
                                                <li class="mb-2"><i class="fa-regular fa-user me-2"></i><strong class="text-dark">{{ $contact->name }}</strong></li>
                                                <li class="mb-2"><i class="fa-regular fa-envelope me-2"></i><a href="mailto:{{ $contact->email }}" class="text-decoration-none">{{ $contact->email }}</a></li>
                                                <li><i class="fa-regular fa-clock me-2"></i>{{ $contact->created_at->format('d/m/Y H:i') }}</li>
                                            </ul>
                                            <h6 class="fw-bold mb-2">Chủ đề: <span class="text-danger">{{ $contact->subject }}</span></h6>
                                            <div class="p-3 bg-light rounded-3 mt-3 border" style="white-space: pre-wrap; word-break: break-word; color: #444;">{{ $contact->message }}</div>
                                        </div>
                                        <div class="modal-footer border-0 px-4 pb-4">
                                            <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Đóng</button>
                                            <a href="mailto:{{ $contact->email }}?subject=RE: {{ $contact->subject }}" class="btn btn-primary rounded-pill px-4">
                                                <i class="fa-solid fa-reply"></i> Trả lời ngay
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-secondary">
                            <i class="fa-regular fa-envelope-open fa-3x mb-3 d-block text-muted"></i>
                            Chưa có thư liên hệ nào!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
