@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary fw-bold mb-0">Chi tiết đơn hàng #{{ $order->momo_order_id ?? $order->id }}</h1>
        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="fas fa-arrow-left me-2"></i>Quay lại
        </a>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h5 class="fw-bold"><i class="fas fa-box-open me-2 text-primary"></i>Sản phẩm đã mua</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0">Tên sản phẩm</th>
                                    <th class="border-0 text-center">Số lượng</th>
                                    <th class="border-0 text-end">Đơn giá</th>
                                    <th class="border-0 text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td><strong>{{ $item->product_name }}</strong></td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                    <td class="text-end fw-bold text-danger">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 bg-light">
                <div class="card-body">
                    <h5 class="fw-bold mb-4"><i class="fas fa-info-circle me-2 text-primary"></i>Thông tin thanh toán</h5>
                    
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex justify-content-between mb-3 border-bottom pb-2">
                            <span class="text-muted">Trạng thái:</span>
                            @if($order->payment_status == 'completed')
                                <span class="badge bg-success rounded-pill px-3"><i class="fas fa-check-circle me-1"></i>Thành công</span>
                            @elseif($order->payment_status == 'failed')
                                <span class="badge bg-danger rounded-pill px-3"><i class="fas fa-times-circle me-1"></i>Thất bại</span>
                            @else
                                <span class="badge bg-warning text-dark rounded-pill px-3"><i class="fas fa-clock me-1"></i>Đang chờ</span>
                            @endif
                        </li>
                        <li class="d-flex justify-content-between mb-3 border-bottom pb-2">
                            <span class="text-muted">Phương thức:</span>
                            <span class="fw-bold text-uppercase">{{ $order->payment_method }}</span>
                        </li>
                        <li class="d-flex justify-content-between mb-3 border-bottom pb-2">
                            <span class="text-muted">Ngày thanh toán:</span>
                            <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
                        </li>
                        @if($order->momo_trans_id)
                        <li class="d-flex justify-content-between mb-3 border-bottom pb-2">
                            <span class="text-muted">Mã giao dịch Momo:</span>
                            <span>{{ $order->momo_trans_id }}</span>
                        </li>
                        @endif
                        <li class="d-flex justify-content-between mt-4">
                            <span class="fw-bold fs-5">Tổng tiền:</span>
                            <span class="fw-bold fs-5 text-danger">{{ number_format($order->total_amount, 0, ',', '.') }}đ</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
