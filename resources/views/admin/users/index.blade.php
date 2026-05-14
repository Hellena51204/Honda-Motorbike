@extends('layouts.admin')

@section('content')
<div>
    {{-- Header --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1" style="font-size: 1.8rem; color: #0f172a;">Quản lý Thành viên</h2>
        <p class="text-secondary mb-0" style="font-size: 0.95rem;">Quản lý thông tin và phân hạng khách hàng</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Main Card --}}
    <div class="admin-table bg-white p-4" style="border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1" style="color: #0f172a;">Danh sách Thành viên</h4>
                <p class="text-secondary mb-0" style="font-size: 0.85rem;">Đã có {{ $users->count() }} thành viên đăng ký</p>
            </div>
            <button class="btn btn-danger fw-bold rounded-3 px-4 py-2 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fa-solid fa-user-plus"></i> Thêm Khách hàng
            </button>
        </div>

        <table class="table table-hover align-middle mb-0" style="border-top: 1px solid #e2e8f0;">
            <thead>
                <tr>
                    <th style="padding-left:1.5rem; font-size: 0.85rem; font-weight: 600; color: #475569;">Mã KH</th>
                    <th style="font-size: 0.85rem; font-weight: 600; color: #475569;">Họ tên</th>
                    <th style="font-size: 0.85rem; font-weight: 600; color: #475569;">Email</th>
                    <th style="font-size: 0.85rem; font-weight: 600; color: #475569;">Hạng</th>
                    <th style="font-size: 0.85rem; font-weight: 600; color: #475569;">Đơn hàng</th>
                    <th style="font-size: 0.85rem; font-weight: 600; color: #475569;">Ngày tham gia</th>
                    <th class="text-center" style="padding-right:1.5rem; font-size: 0.85rem; font-weight: 600; color: #475569;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $member)
                <tr>
                    <td class="fw-semibold text-dark" style="padding-left:1.5rem; font-size: 0.9rem;">
                        U-{{ str_pad($member->id, 3, '0', STR_PAD_LEFT) }}
                    </td>
                    <td>
                        <div class="fw-bold" style="font-size: 0.9rem; color: #1e293b;">{{ $member->name }}</div>
                    </td>
                    <td>
                        <div class="text-secondary" style="font-size: 0.9rem;">{{ $member->email }}</div>
                    </td>
                    <td>
                        @php
                            $badgeMap = [
                                'none'    => ['label' => 'Thường',  'bg' => '#f1f5f9', 'text' => '#64748b'],
                                'silver'  => ['label' => 'Bạc',     'bg' => '#f1f5f9', 'text' => '#475569'],
                                'gold'    => ['label' => 'Vàng',    'bg' => '#fef3c7', 'text' => '#b45309'],
                                'diamond' => ['label' => 'Kim Cương','bg' => '#e0e7ff', 'text' => '#4f46e5'],
                            ];
                            $b = $badgeMap[$member->membership] ?? $badgeMap['none'];
                        @endphp
                        <span style="background-color: {{ $b['bg'] }}; color: {{ $b['text'] }}; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700;">
                            {{ $b['label'] }}
                        </span>
                    </td>
                    <td class="text-secondary" style="font-size: 0.9rem;">
                        {{ $member->orders ? $member->orders->count() : 0 }}
                    </td>
                    <td class="text-secondary" style="font-size: 0.9rem;">
                        {{ $member->created_at->format('Y-m-d') }}
                    </td>
                    <td class="text-center" style="padding-right:1.5rem;">
                        <button class="btn btn-sm btn-link text-primary text-decoration-none p-1 mx-1" data-bs-toggle="modal" data-bs-target="#membershipModal{{ $member->id }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </button>
                        <button class="btn btn-sm btn-link text-danger text-decoration-none p-1 mx-1">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </td>
                </tr>

                {{-- Edit Modal --}}
                <div class="modal fade" id="membershipModal{{ $member->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg rounded-4">
                            <div class="modal-header border-0 pb-0 px-4 pt-4">
                                <h5 class="modal-title fw-bold">Cập nhật: {{ $member->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('admin.users.membership', $member->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <div class="modal-body px-4 py-3">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold small text-uppercase text-secondary">Hạng thành viên</label>
                                        <select class="form-select rounded-3" name="membership">
                                            <option value="none"    {{ $member->membership === 'none'    ? 'selected' : '' }}>Khách Thường</option>
                                            <option value="silver"  {{ $member->membership === 'silver'  ? 'selected' : '' }}>Hạng Bạc</option>
                                            <option value="gold"    {{ $member->membership === 'gold'    ? 'selected' : '' }}>Hạng Vàng</option>
                                            <option value="diamond" {{ $member->membership === 'diamond' ? 'selected' : '' }}>Hạng Kim Cương</option>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label fw-semibold small text-uppercase text-secondary">Điểm tích lũy</label>
                                        <input type="number" class="form-control rounded-3" name="membership_points" value="{{ $member->membership_points }}" min="0">
                                    </div>
                                </div>
                                <div class="modal-footer border-0 px-4 pb-4">
                                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Hủy</button>
                                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Lưu thay đổi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-secondary">
                        <i class="fa-regular fa-folder-open fa-3x mb-3 d-block text-muted"></i>
                        No users found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
