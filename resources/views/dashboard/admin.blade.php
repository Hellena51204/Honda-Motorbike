@extends('layouts.admin')

@section('content')
<style>
.stat-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    border: 1px solid #f8fafc;
    position: relative;
    overflow: hidden;
    height: 100%;
}
.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}
.stat-value {
    font-size: 1.75rem;
    font-weight: 800;
    color: #0f172a;
    margin-top: 1rem;
    margin-bottom: 0.25rem;
}
.stat-label {
    color: #64748b;
    font-size: 0.85rem;
    font-weight: 500;
}
.stat-percent {
    font-size: 0.8rem;
    font-weight: 700;
}
.stat-percent.positive { color: #16a34a; }
.stat-percent.negative { color: #dc2626; }
.sparkline {
    width: 100%;
    height: 30px;
    margin-top: 1.5rem;
}
</style>

<div class="mb-4">
    <h2 class="fw-bold mb-1" style="font-size: 1.8rem; color: #0f172a;">Tổng quan Hệ thống</h2>
    <p class="text-secondary mb-0" style="font-size: 0.95rem;">Theo dõi hiệu suất kinh doanh trực tuyến của Honda</p>
</div>

{{-- Stat Cards --}}
<div class="row g-4 mb-5">
    {{-- Total Revenue --}}
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div class="stat-icon" style="background: #dcfce7; color: #166534;">
                    <i class="fa-solid fa-dollar-sign"></i>
                </div>
                <div class="stat-percent positive">
                    <i class="fa-solid fa-arrow-trend-up me-1"></i>+12.5%
                </div>
            </div>
            @php
                $revMillions = $totalRevenue > 0 ? number_format($totalRevenue / 1000000, 1) . 'M' : '0';
            @endphp
            <div class="stat-value">{{ $revMillions }} VND</div>
            <div class="stat-label">Tổng doanh thu</div>
            <div class="sparkline">
                <svg viewBox="0 0 100 30" preserveAspectRatio="none">
                    <path d="M0,25 C20,20 40,30 60,15 C80,0 100,10 100,10" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Units Sold --}}
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div class="stat-icon" style="background: #e0e7ff; color: #4338ca;">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <div class="stat-percent positive">
                    <i class="fa-solid fa-arrow-trend-up me-1"></i>+8.2%
                </div>
            </div>
            <div class="stat-value">{{ $totalOrders }}</div>
            <div class="stat-label">Số xe đã bán</div>
            <div class="sparkline">
                <svg viewBox="0 0 100 30" preserveAspectRatio="none">
                    <path d="M0,20 C30,25 50,5 70,15 C90,25 100,10 100,10" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- New Customers --}}
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div class="stat-icon" style="background: #f3e8ff; color: #7e22ce;">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="stat-percent positive">
                    <i class="fa-solid fa-arrow-trend-up me-1"></i>+15.3%
                </div>
            </div>
            <div class="stat-value">{{ $totalUsers }}</div>
            <div class="stat-label">Khách hàng mới</div>
            <div class="sparkline">
                <svg viewBox="0 0 100 30" preserveAspectRatio="none">
                    <path d="M0,30 C20,20 40,25 60,10 C80,15 100,5 100,5" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Pending Orders --}}
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div class="stat-icon" style="background: #ffedd5; color: #c2410c;">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <div class="stat-percent negative">
                    <i class="fa-solid fa-arrow-trend-down me-1"></i>-5.1%
                </div>
            </div>
            <div class="stat-value">{{ $pendingOrders }}</div>
            <div class="stat-label">Đơn chờ xử lý</div>
            <div class="sparkline">
                <svg viewBox="0 0 100 30" preserveAspectRatio="none">
                    <path d="M0,5 C30,10 50,25 70,15 C90,20 100,25 100,25" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
    </div>
</div>

{{-- Recent Orders Table --}}
<div class="admin-table bg-white p-4" style="border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
    <div class="mb-4">
        <h4 class="fw-bold mb-1" style="color: #0f172a;">Đơn hàng gần đây</h4>
    </div>

    <table class="table table-hover align-middle mb-0" style="border-top: 1px solid #e2e8f0;">
        <thead>
            <tr>
                <th style="padding-left:1.5rem; font-size: 0.85rem; font-weight: 600; color: #475569;">Mã ĐH</th>
                <th style="font-size: 0.85rem; font-weight: 600; color: #475569;">Khách hàng</th>
                <th style="font-size: 0.85rem; font-weight: 600; color: #475569;">Sản phẩm</th>
                <th style="font-size: 0.85rem; font-weight: 600; color: #475569;">Ngày đặt</th>
                <th style="font-size: 0.85rem; font-weight: 600; color: #475569;">Trạng thái</th>
                <th class="text-end" style="padding-right:1.5rem; font-size: 0.85rem; font-weight: 600; color: #475569;">Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentOrders as $order)
            <tr>
                <td class="fw-bold" style="padding-left:1.5rem; font-size: 0.9rem; color: #1e293b;">
                    ORD-{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}
                </td>
                <td>
                    <div class="text-dark" style="font-size: 0.9rem;">{{ $order->user ? $order->user->name : 'Khách vãng lai' }}</div>
                </td>
                <td>
                    <div class="text-secondary" style="font-size: 0.9rem;">
                        @if($order->items->count() > 0)
                            {{ $order->items->first()->product_name }}
                        @else
                            <span class="text-muted fst-italic">Không có SP</span>
                        @endif
                    </div>
                </td>
                <td>
                    <div class="text-secondary" style="font-size: 0.9rem;">{{ $order->created_at->format('Y-m-d') }}</div>
                </td>
                <td>
                    @if($order->payment_status == 'completed')
                        <span style="background-color: #dcfce7; color: #166534; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                            <i class="fa-regular fa-circle-check"></i> Thành công
                        </span>
                    @elseif($order->payment_status == 'failed')
                        <span style="background-color: #fee2e2; color: #991b1b; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                            <i class="fa-regular fa-circle-xmark"></i> Thất bại
                        </span>
                    @else
                        <span style="background-color: #fef9c3; color: #854d0e; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                            <i class="fa-regular fa-clock"></i> Đang chờ
                        </span>
                    @endif
                </td>
                <td class="text-end" style="padding-right:1.5rem;">
                    @php
                        $ordMillions = $order->total_amount > 1000000 ? number_format($order->total_amount / 1000000, 1) . 'M' : number_format($order->total_amount);
                    @endphp
                    <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $ordMillions }} VND</div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-5 text-secondary">
                    <i class="fa-solid fa-clipboard-list fa-3x mb-3 d-block text-muted"></i>
                    Chưa có đơn hàng nào.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
