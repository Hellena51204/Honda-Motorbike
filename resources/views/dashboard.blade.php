@extends('layouts.app')

{{-- Push link CSS đặc thù của Dashboard lên thẻ <head> nếu Layout có hỗ trợ @stack('styles'), 
     nhưng do file app.blade.php hiện chỉ load bình thường nên ta có thể để trực tiếp tại đây 
     hoặc thêm thẳng vào file app.blade.php nếu muốn. Ở đây ta nhúng trực tiếp để gọn view. --}}
@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div class="dashboard-page">

    {{-- Thông báo chung --}}
    @if(session('success'))
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    {{-- Phân nhánh logic hiển thị dựa theo vai trò (Role) --}}
    @if($user->role === 'admin')
        @include('dashboard.admin')
    @else
        @include('dashboard.user')
    @endif

</div>
@endsection