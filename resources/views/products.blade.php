@extends('layouts.app')

@section('content')

<style>
/* Custom CSS for Products Page */
.page-header h1 {
    font-weight: 700;
    margin-bottom: 0.5rem;
}
.page-header p {
    color: #6c757d;
}
.filter-container {
    margin: 2rem 0;
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    align-items: center;
}
.filter-header {
    font-weight: bold;
    margin-right: 1rem;
}
.filter-buttons {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}
.filter-btn {
    border: 1px solid #ddd;
    background: transparent;
    padding: 0.5rem 1.5rem;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}
.filter-btn.active, .filter-btn:hover {
    background: #cc0000;
    color: white;
    border-color: #cc0000;
}
.product-grid-v2 {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}
.product-item-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    transition: transform 0.3s ease;
}
.product-item-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}
.card-img-wrapper {
    position: relative;
    height: 220px;
    overflow: hidden;
    background: #f8f9fa;
}
.card-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.card-img-wrapper .badge {
    position: absolute;
    top: 10px;
    padding: 6px 12px;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: bold;
}
.badge-left {
    left: 10px;
    background: #cc0000;
    color: white;
}
.badge-right {
    right: 10px;
    background: white;
    color: #333;
    border: 1px solid #ddd;
}
.card-info {
    padding: 1.5rem;
}
.card-info h3 {
    font-size: 1.25rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}
.card-info .desc {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 1rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.colors {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
}
.color-circle {
    width: 20px;
    height: 20px;
    border-radius: 50%;
}
.price-action {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #eee;
    padding-top: 1rem;
}
.price-label {
    display: block;
    font-size: 0.8rem;
    color: #6c757d;
}
.price-value {
    font-weight: bold;
    color: #cc0000;
    font-size: 1.1rem;
}
.btn-arrow-red {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: #fff;
    color: #cc0000;
    border: 2px solid #cc0000;
    border-radius: 50%;
    transition: all 0.3s;
}
.btn-arrow-red:hover {
    background: #cc0000;
    color: white;
}
</style>

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
                    <div class="color-circle" @style(['background-color: ' . $color, 'border: 1px solid #ddd' => $color == '#ffffff'])></div>
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