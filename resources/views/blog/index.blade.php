@extends('layouts.main')

@section('title', __('common.blog') . ' - VgenTech')

@section('content')
<!-- Page Header -->
<div class="page-header-bg text-white py-5">
    <div class="container">
        <h1 class="animate-fadeInUp"><i class="fas fa-blog"></i> {{ __('common.blog') }}</h1>
        <nav aria-label="breadcrumb" class="animate-fadeIn">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">{{ __('common.home') }}</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ __('common.blog') }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Blog Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Blog Posts -->
            <div class="col-lg-8">
                @if($posts->count() > 0)
                    @foreach($posts as $post)
                        <div class="card mb-4 shadow-sm">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ $post->featured_image ?? 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=400&q=80' }}" 
                                         class="img-fluid rounded-start h-100" alt="{{ $post->title }}"
                                         style="object-fit: cover;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="mb-2">
                                            @if($post->category)
                                                <span class="badge bg-primary">{{ $post->category->name }}</span>
                                            @endif
                                            <small class="text-muted ms-2">
                                                <i class="fas fa-calendar"></i> {{ $post->published_at->format('d/m/Y') }}
                                            </small>
                                            @if($post->author)
                                                <small class="text-muted ms-2">
                                                    <i class="fas fa-user"></i> {{ $post->author->name }}
                                                </small>
                                            @endif
                                        </div>
                                        
                                        <h5 class="card-title">
                                            <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none text-dark">
                                                {{ $post->title }}
                                            </a>
                                        </h5>
                                        
                                        <p class="card-text text-muted">
                                            {{ Str::limit($post->excerpt ?? $post->content, 150) }}
                                        </p>
                                        
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-arrow-right"></i> {{ __('common.read_more') }}
                                            </a>
                                            <small class="text-muted">
                                                <i class="fas fa-eye"></i> {{ $post->view_count }} {{ __('common.view_count') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> {{ __('common.no_posts_found') }}.
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Search Box -->
                <div class="card mb-4">
                    <div class="card-header card-header-gradient text-white">
                        <h5 class="mb-0"><i class="fas fa-search"></i> {{ __('common.search') }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('blog.index') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" 
                                       placeholder="{{ __('common.search_post_placeholder') }}" value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Categories -->
                <div class="card mb-4">
                    <div class="card-header card-header-gradient text-white">
                        <h5 class="mb-0"><i class="fas fa-folder"></i> {{ __('common.categories_text') }}</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('blog.index') }}" 
                           class="list-group-item list-group-item-action {{ !request('category') ? 'active' : '' }}">
                            {{ __('common.all_posts_text') }}
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ route('blog.index', ['category' => $category->slug]) }}" 
                               class="list-group-item list-group-item-action {{ request('category') == $category->slug ? 'active' : '' }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Tags Cloud -->
                @if($tags->count() > 0)
                    <div class="card mb-4">
                        <div class="card-header card-header-gradient text-white">
                            <h5 class="mb-0"><i class="fas fa-tags"></i> {{ __('common.tags_text') }}</h5>
                        </div>
                        <div class="card-body">
                            @foreach($tags as $tag)
                                <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" 
                                   class="badge bg-secondary me-1 mb-1 text-decoration-none">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Featured Posts -->
                @if($featuredPosts->count() > 0)
                    <div class="card">
                        <div class="card-header card-header-gradient text-white">
                            <h5 class="mb-0"><i class="fas fa-star"></i> {{ __('common.featured_posts') }}</h5>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach($featuredPosts as $featured)
                                <a href="{{ route('blog.show', $featured->slug) }}" 
                                   class="list-group-item list-group-item-action">
                                    <div class="d-flex">
                                        <img src="{{ $featured->featured_image ?? 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=120&q=80' }}" 
                                             class="me-2 rounded" alt="{{ $featured->title }}"
                                             style="width: 80px; height: 60px; object-fit: cover;">
                                        <div>
                                            <h6 class="mb-1">{{ Str::limit($featured->title, 50) }}</h6>
                                            <small class="text-muted">
                                                <i class="fas fa-calendar"></i> {{ $featured->published_at->format('d/m/Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
