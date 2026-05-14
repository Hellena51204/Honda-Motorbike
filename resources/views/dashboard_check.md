{{-- ╔══════════════════════════════════════════════════════╗
     ║           DASHBOARD DISPATCHER (Phân vai)           ║
     ╠══════════════════════════════════════════════════════╣
     ║  Admin  → layouts/admin.blade.php + dashboard/admin ║
     ║  User   → layouts/app.blade.php   + dashboard/user  ║
     ╚══════════════════════════════════════════════════════╝ --}}

@if($user->role === 'admin')
    {{-- Admin: dùng layout admin có sidebar --}}
    @extends('layouts.admin')

    @section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @include('dashboard.admin_content')
    @endsection

@else
    {{-- User: dùng layout app thông thường --}}
    @extends('layouts.app')

    @section('content')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <div class="dashboard-page">
        @if(session('success'))
            <div class="container">
                <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
        @include('dashboard.user')
    </div>
    @endsection

@endif
