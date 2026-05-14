@extends('layouts.admin')

@section('content')
<div>
    {{-- Header --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1" style="font-size: 1.8rem; color: #0f172a;">Quản lý Sản phẩm</h2>
        <p class="text-secondary mb-0" style="font-size: 0.95rem;">Quản lý kho xe máy Honda của bạn</p>
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
                <h4 class="fw-bold mb-1" style="color: #0f172a;">Quản lý Kho hàng</h4>
                <p class="text-secondary mb-0" style="font-size: 0.85rem;">{{ $products->count() }} sản phẩm trong kho</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-danger fw-bold rounded-3 px-4 py-2 d-flex align-items-center gap-2 text-decoration-none">
                <i class="fa-solid fa-cube"></i> Thêm Sản phẩm
            </a>
        </div>

        <table class="table table-hover align-middle mb-0" style="border-top: 1px solid #e2e8f0;">
            <thead>
                <tr>
                    <th style="padding-left:1.5rem; font-size: 0.85rem; font-weight: 600; color: #475569;">Sản phẩm</th>
                    <th style="font-size: 0.85rem; font-weight: 600; color: #475569;">Đời xe</th>
                    <th style="font-size: 0.85rem; font-weight: 600; color: #475569;">Giá bán</th>
                    <th style="font-size: 0.85rem; font-weight: 600; color: #475569;">Tồn kho</th>
                    <th style="font-size: 0.85rem; font-weight: 600; color: #475569;">Đã bán</th>
                    <th class="text-center" style="padding-right:1.5rem; font-size: 0.85rem; font-weight: 600; color: #475569;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td style="padding-left:1.5rem;">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;">
                            <div>
                                <div class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $product->name }}</div>
                                <div class="text-secondary" style="font-size: 0.8rem;">{{ $product->category }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-secondary" style="font-size: 0.9rem;">{{ $product->year ?? '2024' }}</div>
                    </td>
                    <td>
                        <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ number_format($product->price, 0, ',', '.') }} đ</div>
                    </td>
                    <td>
                        @php
                            $stock = $product->stock; 
                            $sold = $product->sold;
                            
                            $stockBg = '#dcfce7'; $stockText = '#166534';
                            if($stock < 10) { $stockBg = '#fee2e2'; $stockText = '#991b1b'; }
                            elseif($stock < 25) { $stockBg = '#fef9c3'; $stockText = '#854d0e'; }
                        @endphp
                        <span style="background-color: {{ $stockBg }}; color: {{ $stockText }}; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700;">
                            {{ $stock }} chiếc
                        </span>
                    </td>
                    <td>
                        <div class="text-secondary" style="font-size: 0.9rem;">{{ $sold }} chiếc</div>
                    </td>
                    <td class="text-center" style="padding-right:1.5rem;">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-link text-primary text-decoration-none p-1 mx-1">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-link text-danger text-decoration-none p-1 mx-1">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-secondary">
                        <i class="fa-solid fa-motorcycle fa-3x mb-3 d-block text-muted"></i>
                        No products available.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
