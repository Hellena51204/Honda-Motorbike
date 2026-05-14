@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-primary fw-bold"><i class="fas fa-history me-2"></i>Lịch sử mua hàng</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-info shadow-sm">
            Bạn chưa có đơn hàng nào. <a href="{{ route('home') }}" class="alert-link text-primary">Mua sắm ngay!</a>
        </div>
    @else
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3 border-0">Mã đơn hàng</th>
                                <th class="px-4 py-3 border-0">Ngày đặt</th>
                                <th class="px-4 py-3 border-0">Tổng tiền</th>
                                <th class="px-4 py-3 border-0">Thanh toán</th>
                                <th class="px-4 py-3 border-0">Trạng thái</th>
                                <th class="px-4 py-3 border-0 text-end">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td class="px-4 py-3"><strong>#{{ $order->momo_order_id ?? $order->id }}</strong></td>
                                <td class="px-4 py-3">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3 fw-bold text-danger">{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-secondary rounded-pill text-uppercase">{{ $order->payment_method }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    @if($order->payment_status == 'completed')
                                        <span class="badge bg-success rounded-pill px-3 py-2"><i class="fas fa-check-circle me-1"></i>Thành công</span>
                                    @elseif($order->payment_status == 'failed')
                                        <span class="badge bg-danger rounded-pill px-3 py-2"><i class="fas fa-times-circle me-1"></i>Thất bại</span>
                                    @else
                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2"><i class="fas fa-clock me-1"></i>Đang chờ</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-end">
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        <i class="fas fa-eye me-1"></i>Chi tiết
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: #f8f9fc;
    }
</style>
@endsection
