@extends('layouts.main')

@section('title', $post->title . ' - VgenTech')

@section('content')
<!-- Page Header -->
<div class="page-header-bg text-white py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">{{ __('common.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blog.index') }}" class="text-white">{{ __('common.blog') }}</a></li>
                @if($post->category)
                    <li class="breadcrumb-item"><a href="{{ route('blog.index', ['category' => $post->category->slug]) }}" class="text-white">{{ $post->category->name }}</a></li>
                @endif
                <li class="breadcrumb-item active text-white" aria-current="page">{{ Str::limit($post->title, 50) }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Post Detail Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post Header -->
                <article class="card mb-4">
                    <div class="card-body">
                        @if($post->category)
                            <div class="mb-3">
                                <span class="badge bg-primary">{{ $post->category->name }}</span>
                            </div>
                        @endif
                        
                        <h1 class="mb-3">{{ $post->title }}</h1>
                        
                        <div class="d-flex align-items-center text-muted mb-4">
                            <img src="{{ $post->author->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->author->name) }}" 
                                 class="rounded-circle me-2" alt="{{ $post->author->name }}"
                                 style="width: 40px; height: 40px;">
                            <div>
                                <strong>{{ $post->author->name }}</strong><br>
                                <small>
                                    <i class="fas fa-calendar"></i> {{ $post->published_at->format('d/m/Y H:i') }}
                                    <i class="fas fa-eye ms-2"></i> {{ $post->view_count }} {{ __('common.view_count') }}
                                </small>
                            </div>
                        </div>

                        @if($post->featured_image)
                            <img src="{{ $post->featured_image }}" 
                                 class="img-fluid rounded mb-4" alt="{{ $post->title }}">
                        @endif

                        @if($post->excerpt)
                            <div class="lead mb-4">
                                {{ $post->excerpt }}
                            </div>
                        @endif

                        <div class="post-content">
                            {!! $post->content !!}
                        </div>

                        @if($post->tags->count() > 0)
                            <hr class="my-4">
                            <div>
                                <strong><i class="fas fa-tags"></i> {{ __('common.tags_text') }}:</strong>
                                @foreach($post->tags as $tag)
                                    <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" 
                                       class="badge bg-secondary text-decoration-none me-1">
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        <hr class="my-4">

                        <!-- Share Buttons -->
                        <div>
                            <strong><i class="fas fa-share-alt"></i> {{ __('common.share_post') }}:</strong>
                            <div class="d-flex gap-2 mt-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}" 
                                   target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}" 
                                   target="_blank" class="btn btn-info btn-sm">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('blog.show', $post->slug)) }}" 
                                   target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fab fa-linkedin-in"></i> LinkedIn
                                </a>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Author Info -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex">
                            <img src="{{ $post->author->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->author->name) }}" 
                                 class="rounded-circle me-3" alt="{{ $post->author->name }}"
                                 style="width: 80px; height: 80px;">
                            <div>
                                <h5>{{ $post->author->name }}</h5>
                                <p class="text-muted mb-0">{{ $post->author->bio ?? __('common.author_at') . ' VgenTech' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Posts -->
                @if($relatedPosts->count() > 0)
                    <div class="card">
                        <div class="card-header card-header-gradient text-white">
                            <h4 class="mb-0"><i class="fas fa-newspaper"></i> {{ __('common.related_posts_text') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                @foreach($relatedPosts as $related)
                                    <div class="col-md-6">
                                        <div class="card h-100">
                                            <img src="{{ $related->featured_image ?? 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=400&q=80' }}" 
                                                 class="card-img-top" alt="{{ $related->title }}"
                                                 style="height: 150px; object-fit: cover;">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ Str::limit($related->title, 60) }}</h6>
                                                <p class="card-text text-muted small">
                                                    <i class="fas fa-calendar"></i> {{ $related->published_at->format('d/m/Y') }}
                                                </p>
                                                <a href="{{ route('blog.show', $related->slug) }}" 
                                                   class="btn btn-primary btn-sm w-100">
                                                    {{ __('common.read_more') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Categories -->
                <div class="card mb-4">
                    <div class="card-header card-header-gradient text-white">
                        <h5 class="mb-0"><i class="fas fa-folder"></i> {{ __('common.categories_text') }}</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        @foreach(($post->category && $post->category->parent) ? [$post->category->parent] : \App\Models\Category::where('type', 'post')->whereNull('parent_id')->get() as $category)
                            <a href="{{ route('blog.index', ['category' => $category->slug]) }}" 
                               class="list-group-item list-group-item-action">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Latest Posts -->
                <div class="card">
                    <div class="card-header card-header-gradient text-white">
                        <h5 class="mb-0"><i class="fas fa-clock"></i> {{ __('common.latest_posts') }}</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        @foreach(\App\Models\Post::published()->where('id', '!=', $post->id)->latest('published_at')->limit(5)->get() as $latest)
                            <a href="{{ route('blog.show', $latest->slug) }}" 
                               class="list-group-item list-group-item-action">
                                <div class="d-flex">
                                    <img src="{{ $latest->featured_image ?? 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=120&q=80' }}" 
                                         class="me-2 rounded" alt="{{ $latest->title }}"
                                         style="width: 80px; height: 60px; object-fit: cover;">
                                    <div>
                                        <h6 class="mb-1">{{ Str::limit($latest->title, 50) }}</h6>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar"></i> {{ $latest->published_at->format('d/m/Y') }}
                                        </small>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
