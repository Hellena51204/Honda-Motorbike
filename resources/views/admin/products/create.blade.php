@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>Thêm Sản Phẩm Mới</h2>
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
            <form action="{{ route('admin.products.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Danh mục</label>
                        <select name="category" class="form-select" required>
                            <option value="">Chọn danh mục...</option>
                            <option value="Xe Tay Ga" {{ old('category') == 'Xe Tay Ga' ? 'selected' : '' }}>Xe Tay Ga</option>
                            <option value="Tay Ga Cao Cấp" {{ old('category') == 'Tay Ga Cao Cấp' ? 'selected' : '' }}>Tay Ga Cao Cấp</option>
                            <option value="Xe Thể Thao" {{ old('category') == 'Xe Thể Thao' ? 'selected' : '' }}>Xe Thể Thao</option>
                            <option value="Xe Số" {{ old('category') == 'Xe Số' ? 'selected' : '' }}>Xe Số</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Link Ảnh URL (Ảnh đại diện chính)</label>
                        <input type="url" name="image" class="form-control" value="{{ old('image') }}" placeholder="https://..." required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-bold">Các ảnh phụ (Tùy chọn - nhấn thêm để mở ô điền)</label>
                        <div id="additional-images-container">
                            <div class="input-group mb-2 image-input-group">
                                <input type="url" name="images[]" class="form-control" placeholder="https://...">
                                <button type="button" class="btn btn-outline-danger remove-image-btn"><i class="fa-solid fa-xmark"></i></button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary mt-1" id="add-image-btn">
                            <i class="fa-solid fa-plus"></i> Thêm đường dẫn ảnh nữa
                        </button>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Giá bán (VNĐ)</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Tồn kho</label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock') ?? 0 }}" required min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Năm ra mắt</label>
                        <input type="text" name="year" class="form-control" value="{{ old('year') ?? '2024' }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Bảng màu (Mã Hex cách nhau dấu phẩy)</label>
                        <input type="text" name="colors" class="form-control" placeholder="#cc0000, #000000, #ffffff" value="{{ old('colors') }}">
                        <div class="form-text">Ví dụ: #cc0000, #ffffff</div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Mô tả sản phẩm</label>
                        <textarea name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-danger px-4">Lưu Sản Phẩm</button>
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
                <div class="input-group mb-2 image-input-group">
                    <input type="url" name="images[]" class="form-control" placeholder="https://...">
                    <button type="button" class="btn btn-outline-danger remove-image-btn"><i class="fa-solid fa-xmark"></i></button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        });

        container.addEventListener('click', function(e) {
            if (e.target.closest('.remove-image-btn')) {
                const groups = container.querySelectorAll('.image-input-group');
                if (groups.length > 1) {
                    e.target.closest('.image-input-group').remove();
                } else {
                    groups[0].querySelector('input').value = '';
                }
            }
        });
    });
</script>
@endsection
