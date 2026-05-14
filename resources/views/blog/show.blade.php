@extends('layouts.app')

@section('content')
<div class="container py-5 my-3">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <a href="{{ route('blog.index') }}" class="text-decoration-none text-secondary mb-4 d-inline-block hover-red">
                <i class="fa-solid fa-arrow-left me-2"></i> Quay lại danh mục tin tức
            </a>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                @if($post->image)
                    <img src="{{ $post->image }}" class="card-img-top w-100" style="max-height: 450px; object-fit: cover;" alt="{{ $post->title }}">
                @endif
                
                <div class="card-body p-4 p-md-5 bg-white">
                    <div class="d-flex align-items-center mb-4">
                        <span class="badge honda-red px-3 py-2 me-3 rounded-pill uppercase">Tin tức Honda</span>
                        <small class="text-muted fw-medium"><i class="fa-regular fa-calendar me-1"></i> {{ $post->created_at->format('d/m/Y') }}</small>
                        @if($post->author)
                            <small class="text-muted fw-medium ms-3"><i class="fa-regular fa-user me-1"></i> {{ $post->author }}</small>
                        @endif
                    </div>

                    <h1 class="fw-bold mb-4" style="font-size: 2.2rem; line-height: 1.3;">{{ $post->title }}</h1>

                    @if($post->summary)
                        <p class="lead text-secondary mb-5 border-start border-4 ps-3 py-1" style="border-color: #cc0000 !important; font-size: 1.1rem;">
                            <i>{{ $post->summary }}</i>
                        </p>
                    @endif

                    <div class="post-content mt-4 text-dark" style="line-height: 1.9; font-size: 1.05rem;">
                        {!! nl2br(e($post->content)) !!}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-red { transition: color 0.3s ease; }
    .hover-red:hover { color: #cc0000 !important; }
</style>
@endsection