@extends('layouts.app')

@section('content')
<div class="py-5 bg-dark text-white mb-5">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Honda Blog</h1>
        <p class="lead">Khám phá những câu chuyện về sự sáng tạo và đam mê</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row g-4">
        @foreach($posts as $post)
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <img src="{{ $post->image }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                <div class="card-body p-4">
                    <small class="text-muted">{{ $post->created_at->format('d/m/Y') }}</small>
                    <h4 class="fw-bold my-2">{{ $post->title }}</h4>
                    <p class="text-secondary">{{ Str::limit($post->summary, 100) }}</p>
                    <a href="{{ route('blog.show', $post->id) }}" class="btn btn-outline-danger rounded-pill">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection