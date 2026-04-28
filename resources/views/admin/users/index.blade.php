@extends('layouts.app')

@section('content')
<style>
.admin-page { padding: 2.5rem 0 4rem; min-height: 80vh; }

.page-header {
    background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
    color: white;
    padding: 2rem 0;
    margin-bottom: 2rem;
}

.admin-table { border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.07); }
.admin-table table { margin: 0; }
.admin-table thead th {
    background: #f9fafb;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6b7280;
    font-weight: 700;
    border: none;
    padding: 0.85rem 1rem;
}
.admin-table tbody tr { border-color: #f3f4f6; }
.admin-table tbody td { padding: 0.9rem 1rem; vertical-align: middle; }
.admin-table tbody tr:hover { background: #fafafa; }

.badge-none    { background: linear-gradient(135deg, #6c757d, #495057); }
.badge-silver  { background: linear-gradient(135deg, #a8a8a8, #c0c0c0, #707070); }
.badge-gold    { background: linear-gradient(135deg, #b8860b, #ffd700, #b8860b); }
.badge-diamond { background: linear-gradient(135deg, #00b4d8, #7b2ff7, #00b4d8); }

.membership-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 14px;
    border-radius: 50px;
    font-size: 0.78rem;
    font-weight: 700;
    color: white;
    text-shadow: 0 1px 2px rgba(0,0,0,0.3);
    letter-spacing: 0.5px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

.stat-card {
    border-radius: 12px;
    padding: 1.2rem 1.5rem;
    border: none;
    box-shadow: 0 4px 16px rgba(0,0,0,0.08);
}
</style>

{{-- Page Header --}}
<div class="page-header">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <a href="{{ route('dashboard') }}" class="text-white-50 text-decoration-none small">
                        <i class="fa-solid fa-chevron-left me-1"></i>Quay lại Dashboard
                    </a>
                </div>
                <h2 class="fw-bold mb-1 d-flex align-items-center gap-2">
                    <i class="fa-solid fa-users text-warning"></i>
                    Quản lý Thành viên
                </h2>
                <p class="mb-0 opacity-75 small">Phân hạng Membership và quản lý điểm tích lũy</p>
            </div>
            <span class="badge bg-danger fs-6 px-3 py-2 rounded-pill">
                <i class="fa-solid fa-shield-halved me-1"></i> Admin
            </span>
        </div>
    </div>
</div>

<div class="admin-page pt-0">
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Stats --}}
        @php
            $counts = [
                'none'    => $users->where('membership', 'none')->count(),
                'silver'  => $users->where('membership', 'silver')->count(),
                'gold'    => $users->where('membership', 'gold')->count(),
                'diamond' => $users->where('membership', 'diamond')->count(),
            ];
        @endphp
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="stat-card" style="background: linear-gradient(135deg, #f3f4f6, #e5e7eb);">
                    <div class="text-secondary small text-uppercase fw-bold mb-1">Chưa xếp hạng</div>
                    <div class="fs-2 fw-bold text-dark">{{ $counts['none'] }}</div>
                    <div class="text-muted" style="font-size:1.3rem;">🔘</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card" style="background: linear-gradient(135deg, #f1f5f9, #e2e8f0);">
                    <div class="text-secondary small text-uppercase fw-bold mb-1">Hạng Bạc</div>
                    <div class="fs-2 fw-bold" style="color:#64748b;">{{ $counts['silver'] }}</div>
                    <div style="font-size:1.3rem;">🥈</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card" style="background: linear-gradient(135deg, #fef3c7, #fde68a);">
                    <div class="text-secondary small text-uppercase fw-bold mb-1">Hạng Vàng</div>
                    <div class="fs-2 fw-bold" style="color:#d97706;">{{ $counts['gold'] }}</div>
                    <div style="font-size:1.3rem;">🥇</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card" style="background: linear-gradient(135deg, #ede9fe, #ddd6fe);">
                    <div class="text-secondary small text-uppercase fw-bold mb-1">Kim Cương</div>
                    <div class="fs-2 fw-bold" style="color:#7c3aed;">{{ $counts['diamond'] }}</div>
                    <div style="font-size:1.3rem;">💎</div>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="admin-table">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="padding-left:1.25rem;">#</th>
                        <th>Thành viên</th>
                        <th>Liên hệ</th>
                        <th>Điểm tích lũy</th>
                        <th>Hạng hiện tại</th>
                        <th class="text-end" style="padding-right:1.25rem;">Cập nhật hạng</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $member)
                    <tr>
                        <td class="text-secondary small" style="padding-left:1.25rem;">{{ $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @if($member->avatar)
                                    <img src="{{ asset('storage/' . $member->avatar) }}" class="rounded-circle" width="42" height="42" style="object-fit:cover; border: 2px solid #eee;">
                                @else
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:42px;height:42px;font-size:18px;color:#aaa;">
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
                                <div class="small text-secondary"><i class="fa-solid fa-phone me-1"></i>{{ $member->phone }}</div>
                            @endif
                            @if($member->address)
                                <div class="small text-secondary text-truncate" style="max-width:160px;" title="{{ $member->address }}">
                                    <i class="fa-solid fa-location-dot me-1"></i>{{ $member->address }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <span class="fw-bold text-dark fs-5">{{ number_format($member->membership_points) }}</span>
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
                            <div class="modal fade" id="membershipModal{{ $member->id }}" tabindex="-1" aria-labelledby="membershipModalLabel{{ $member->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg rounded-4">
                                        <div class="modal-header border-0 pb-0 px-4 pt-4">
                                            <h5 class="modal-title fw-bold" id="membershipModalLabel{{ $member->id }}">
                                                <i class="fa-solid fa-user-tag me-2 text-danger"></i>Phân hạng: {{ $member->name }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('admin.users.membership', $member->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <div class="modal-body px-4 py-3">
                                                {{-- Current info --}}
                                                <div class="p-3 rounded-3 mb-3" style="background:#f9fafb;">
                                                    <div class="d-flex align-items-center gap-3">
                                                        @if($member->avatar)
                                                            <img src="{{ asset('storage/' . $member->avatar) }}" class="rounded-circle" width="48" height="48" style="object-fit:cover;">
                                                        @else
                                                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white" style="width:48px;height:48px;">
                                                                <i class="fa-regular fa-circle-user fa-lg"></i>
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <div class="fw-bold">{{ $member->name }}</div>
                                                            <div class="text-secondary small">{{ $member->email }}</div>
                                                        </div>
                                                    </div>
                                                </div>

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
                                                           value="{{ $member->membership_points }}" min="0"
                                                           placeholder="Nhập số điểm...">
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
                        <td colspan="6" class="text-center py-5 text-secondary">
                            <i class="fa-regular fa-users fa-3x mb-3 d-block text-muted"></i>
                            Chưa có thành viên nào.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="text-secondary small mt-3 text-center">
            Tổng cộng <strong class="text-dark">{{ $users->count() }}</strong> thành viên
        </div>

    </div>
</div>
@endsection
