@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Giỏ hàng của bạn</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('cart') && count(session('cart')) > 0)
        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $id => $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $item['image'] }}" width="60" class="rounded me-3 object-fit-cover">
                                                <strong>{{ $item['name'] }}</strong>
                                            </div>
                                        </td>
                                        <td>{{ number_format($item['price'], 0, ',', '.') }} đ</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td class="fw-bold text-honda-red">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} đ</td>
                                        <td>
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mt-4 mt-md-0">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Tổng cộng</h5>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Tạm tính</span>
                            <strong>{{ number_format($total, 0, ',', '.') }} đ</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5">Thành tiền</span>
                            <strong class="text-honda-red fs-5">{{ number_format($total, 0, ',', '.') }} đ</strong>
                        </div>
                        
                        <form action="{{ route('checkout.momo') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn text-white w-100 py-3 rounded-pill fw-bold" style="background-color: #A50064;">
                                <img src="https://upload.wikimedia.org/wikipedia/vi/f/fe/MoMo_Logo.png" width="25" class="me-2 rounded-circle bg-white p-1">
                                Thanh toán qua Momo
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="fa-solid fa-cart-shopping text-muted mb-3" style="font-size: 5rem;"></i>
            <h4>Giỏ hàng trống</h4>
            <p class="text-secondary">Bạn chưa có sản phẩm nào trong giỏ hàng.</p>
            <a href="{{ route('products.index') }}" class="btn btn-danger rounded-pill px-4 mt-3">Tiếp tục mua sắm</a>
        </div>
    @endif
</div>
@endsection
