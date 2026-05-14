@extends('layouts.admin')

@section('content')
<div>
    {{-- Header --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1" style="font-size: 1.8rem; color: #0f172a;">Quản lý Đơn hàng</h2>
        <p class="text-secondary mb-0" style="font-size: 0.95rem;">Theo dõi và quản lý đơn đặt hàng của khách</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Main Card --}}
    <div class="admin-table bg-white p-4" style="border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
        <div class="mb-4">
            <h4 class="fw-bold mb-1" style="color: #0f172a;">Tất cả Đơn hàng</h4>
            <p class="text-secondary mb-0" style="font-size: 0.85rem;">Tổng cộng {{ $orders->count() }} đơn hàng</p>
        </div>

        <table class="table table-hover align-middle mb-0" style="border-top: 1px solid #e2e8f0;">
            <thead>
                <tr>
                    <th style="padding-left:1.5rem; font-size: 0.85rem; font-weight: 600; color: #475569;">Mã ĐH</th>
                    <th style="font-size: 0.85rem; font-weight: 600; color: #475569;">Khách hàng</th>
                    <th style="font-size: 0.85rem; font-weight: 600; color: #475569;">Sản phẩm</th>
                    <th style="font-size: 0.85rem; font-weight: 600; color: #475569;">Ngày đặt</th>
                    <th style="font-size: 0.85rem; font-weight: 600; color: #475569;">Trạng thái</th>
                    <th style="font-size: 0.85rem; font-weight: 600; color: #475569;">Tổng tiền</th>
                    <th class="text-end" style="padding-right:1.5rem; font-size: 0.85rem; font-weight: 600; color: #475569;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
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
                                @if($order->items->count() > 1)
                                    <small class="text-muted">(+{{ $order->items->count() - 1 }})</small>
                                @endif
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
                            {{-- Pending or Processing --}}
                            <span style="background-color: #fef9c3; color: #854d0e; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                <i class="fa-regular fa-clock"></i> Đang chờ
                            </span>
                        @endif
                    </td>
                    <td>
                        <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ number_format($order->total_amount, 0, ',', '.') }} đ</div>
                    </td>
                    <td class="text-end" style="padding-right:1.5rem;">
                        <a href="{{ route('orders.show', $order->id) }}" class="text-decoration-none fw-bold" style="color: #cc0000; font-size: 0.85rem;">
                            Xem chi tiết
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-secondary">
                        <i class="fa-solid fa-clipboard-list fa-3x mb-3 d-block text-muted"></i>
                        Chưa có đơn hàng nào.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
