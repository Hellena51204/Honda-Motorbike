@extends('layouts.app')

@section('content')
<div class="products-page container my-4">
    <div class="page-header">
        <h1>Danh Mục Xe Máy</h1>
        <p>Tìm kiếm mẫu xe ưng ý nhất từ bộ sưu tập của chúng tôi</p>
    </div>

    <div class="filter-container">
        <div class="filter-header">
            <i class="fa-solid fa-filter"></i> Lọc theo danh mục
        </div>
        <div class="filter-buttons" id="filter-buttons">
            <button class="filter-btn active" data-filter="all">Tất cả</button>
            <button class="filter-btn" data-filter="Xe Tay Ga">Xe Tay Ga</button>
            <button class="filter-btn" data-filter="Tay Ga Cao Cấp">Tay Ga Cao Cấp</button>
            <button class="filter-btn" data-filter="Xe Thể Thao">Xe Thể Thao</button>
        </div>
    </div>

    <div class="product-grid-v2" id="product-list">
        
        @foreach($products as $product)
        <div class="product-item-card product-item" data-category="{{ $product->category }}">
            <div class="card-img-wrapper">
                <span class="badge badge-left">{{ $product->category }}</span>
                <span class="badge badge-right">{{ $product->year }}</span>
                <img src="{{ $product->image }}" alt="{{ $product->name }}">
            </div>
            <div class="card-info">
                <h3>{{ $product->name }}</h3>
                <p class="desc">{{ $product->description }}</p>
                <div class="colors">
                    <span>Màu sắc:</span>
                    @if($product->colors)
                        @foreach($product->colors as $color)
                            <div class="color-circle" style="background-color: {{ $color }}; {{ $color == '#ffffff' ? 'border: 1px solid #ddd;' : '' }}"></div>
                        @endforeach
                    @endif
                </div>
                <div class="price-action">
                    <div class="price-details">
                        <span class="price-label">Giá từ</span>
                        <span class="price-value">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                    </div>
                    <a href="{{ route('products.show', $product->id) }}" class="btn-arrow-red">
    <i class="fa-solid fa-arrow-right"></i>
</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const productItems = document.querySelectorAll('.product-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Xóa class active của tất cả nút và thêm vào nút đang bấm
                document.querySelector('.filter-btn.active').classList.remove('active');
                this.classList.add('active');

                // Lấy giá trị data-filter của nút
                const filterValue = this.getAttribute('data-filter');

                // Lặp qua từng sản phẩm để ẩn/hiện
                productItems.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');
                    
                    if (filterValue === 'all' || filterValue === itemCategory) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endsection