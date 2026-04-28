@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>Sửa Sản Phẩm: {{ $product->name }}</h2>
    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-secondary mb-4"><i class="fa-solid fa-arrow-left"></i> Quay lại</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Danh mục</label>
                        <select name="category" class="form-select" required>
                            <option value="">Chọn danh mục...</option>
                            <option value="Xe Tay Ga" {{ old('category', $product->category) == 'Xe Tay Ga' ? 'selected' : '' }}>Xe Tay Ga</option>
                            <option value="Tay Ga Cao Cấp" {{ old('category', $product->category) == 'Tay Ga Cao Cấp' ? 'selected' : '' }}>Tay Ga Cao Cấp</option>
                            <option value="Xe Thể Thao" {{ old('category', $product->category) == 'Xe Thể Thao' ? 'selected' : '' }}>Xe Thể Thao</option>
                            <option value="Xe Số" {{ old('category', $product->category) == 'Xe Số' ? 'selected' : '' }}>Xe Số</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Link Ảnh URL (Ảnh đại diện chính)</label>
                        <input type="url" name="image" class="form-control" value="{{ old('image', $product->image) }}" required>
                        <div class="mt-2">
                            <img src="{{ $product->image }}" width="150" class="rounded shadow-sm">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-bold">Các ảnh phụ (Tùy chọn - nhấn thêm để mở ô điền)</label>
                        <div id="additional-images-container">
                            @php
                                $images = old('images', $product->images ?? []);
                                if (empty($images)) $images = [''];
                            @endphp
                            
                            @foreach($images as $img)
                            <div class="image-input-wrapper mb-3 border p-3 rounded position-relative">
                                <div class="input-group mb-2 image-input-group">
                                    <input type="url" name="images[]" class="form-control" placeholder="https://..." value="{{ $img }}">
                                    <button type="button" class="btn btn-outline-danger remove-image-btn"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                                @if($img)
                                    <img src="{{ $img }}" height="100" class="rounded object-fit-cover shadow-sm">
                                @endif
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary mt-1" id="add-image-btn">
                            <i class="fa-solid fa-plus"></i> Thêm đường dẫn ảnh nữa
                        </button>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Giá bán (VNĐ)</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Năm ra mắt</label>
                        <input type="text" name="year" class="form-control" value="{{ old('year', $product->year) }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Bảng màu (Mã Hex cách nhau dấu phẩy)</label>
                        @php
                            $colorStr = $product->colors ? implode(',', $product->colors) : '';
                        @endphp
                        <input type="text" name="colors" class="form-control" value="{{ old('colors', $colorStr) }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Mô tả sản phẩm</label>
                        <textarea name="description" class="form-control" rows="4" required>{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-4">Cập nhật Sản Phẩm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addImageBtn = document.getElementById('add-image-btn');
        const container = document.getElementById('additional-images-container');

        addImageBtn.addEventListener('click', function() {
            const html = `
                <div class="image-input-wrapper mb-3 border p-3 rounded position-relative">
                    <div class="input-group mb-2 image-input-group">
                        <input type="url" name="images[]" class="form-control" placeholder="https://...">
                        <button type="button" class="btn btn-outline-danger remove-image-btn"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        });

        container.addEventListener('click', function(e) {
            if (e.target.closest('.remove-image-btn')) {
                const wrapperOptions = container.querySelectorAll('.image-input-wrapper');
                if (wrapperOptions.length > 1) {
                    e.target.closest('.image-input-wrapper').remove();
                } else {
                    wrapperOptions[0].querySelector('input').value = '';
                    const img = wrapperOptions[0].querySelector('img');
                    if (img) img.remove();
                }
            }
        });
    });
</script>
@endsection
