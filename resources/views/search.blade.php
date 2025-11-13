@extends('layouts.main')

@section('title', __('common.search') . ': ' . $query . ' - VgenTech')

@section('content')
<!-- Page Header -->
<div class="page-header-bg text-white py-5">
    <div class="container">
        <h1 class="animate-fadeInUp">
            <i class="fas fa-search"></i> {{ __('common.search') }}: "{{ $query }}"
        </h1>
        <p class="lead animate-fadeIn">{{ __('common.search_results_found', ['count' => $totalResults]) }}</p>
    </div>
</div>

<!-- Search Results -->
<section class="py-5">
    <div class="container">
        @if($totalResults > 0)
            <!-- Products Results -->
            @if($results['products']->isNotEmpty())
                <div class="mb-5">
                    <h3 class="mb-4">
                        <i class="fas fa-box text-primary"></i> {{ __('common.products') }} 
                        <span class="badge bg-primary">{{ $results['products']->count() }}</span>
                    </h3>
                    <div class="row">
                        @foreach($results['products'] as $product)
                            <div class="col-md-4 col-lg-3 mb-4">
                                <div class="card product-card h-100">
                                    @if($product->featured_image_url)
                                        <img src="{{ $product->featured_image_url }}" class="card-img-top" alt="{{ $product->name }}">
                                    @else
                                        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="{{ $product->name }}">
                                    @endif
                                    
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $product->name }}</h6>
                                        @if($product->category)
                                            <p class="text-muted small mb-2">
                                                <i class="fas fa-folder"></i> {{ $product->category->name }}
                                            </p>
                                        @endif
                                        @if($product->price)
                                            <p class="text-danger fw-bold">{{ number_format($product->price) }} VNĐ</p>
                                        @endif
                                        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary btn-sm w-100">
                                            <i class="fas fa-eye"></i> {{ __('common.view_details') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Projects Results -->
            @if($results['projects']->isNotEmpty())
                <div class="mb-5">
                    <h3 class="mb-4">
                        <i class="fas fa-project-diagram text-success"></i> {{ __('common.projects') }} 
                        <span class="badge bg-success">{{ $results['projects']->count() }}</span>
                    </h3>
                    <div class="row">
                        @foreach($results['projects'] as $project)
                            <div class="col-md-4 mb-4">
                                <div class="card project-card h-100">
                                    @if($project->featured_image_url)
                                        <img src="{{ $project->featured_image_url }}" class="card-img-top" alt="{{ $project->title }}">
                                    @else
                                        <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="{{ $project->title }}">
                                    @endif
                                    
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $project->title }}</h5>
                                        @if($project->location)
                                            <p class="text-muted mb-2">
                                                <i class="fas fa-map-marker-alt"></i> {{ $project->location }}
                                            </p>
                                        @endif
                                        @if($project->client_name)
                                            <p class="text-muted mb-2">
                                                <i class="fas fa-building"></i> {{ $project->client_name }}
                                            </p>
                                        @endif
                                        <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-success btn-sm w-100">
                                            <i class="fas fa-eye"></i> {{ __('common.view_project') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Blog Posts Results -->
            @if($results['posts']->isNotEmpty())
                <div class="mb-5">
                    <h3 class="mb-4">
                        <i class="fas fa-newspaper text-info"></i> {{ __('common.blog') }} 
                        <span class="badge bg-info">{{ $results['posts']->count() }}</span>
                    </h3>
                    <div class="row">
                        @foreach($results['posts'] as $post)
                            <div class="col-md-6 mb-4">
                                <div class="card post-card h-100">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            @if($post->featured_image_url)
                                                <img src="{{ $post->featured_image_url }}" class="img-fluid rounded-start h-100 object-fit-cover" alt="{{ $post->title }}">
                                            @else
                                                <img src="https://via.placeholder.com/200x200" class="img-fluid rounded-start h-100 object-fit-cover" alt="{{ $post->title }}">
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $post->title }}</h6>
                                                <p class="text-muted small mb-2">
                                                    <i class="fas fa-calendar"></i> {{ $post->published_at->format('d/m/Y') }}
                                                </p>
                                                @if($post->excerpt)
                                                    <p class="card-text small">{{ Str::limit($post->excerpt, 100) }}</p>
                                                @endif
                                                <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> {{ __('common.read_more') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @else
            <div class="text-center py-5">
                <i class="fas fa-search fa-5x text-muted mb-4"></i>
                <h3>{{ __('common.no_results_found') }}</h3>
                <p class="text-muted">{{ __('common.try_different_keywords') }}</p>
                <a href="{{ route('home') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-home"></i> {{ __('common.back_to_home') }}
                </a>
            </div>
        @endif
    </div>
</section>
@endsection
