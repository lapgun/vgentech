@extends('layouts.main')

@section('title', __('common.home') . ' - VgenTech')

@section('content')
<!-- Hero Slider -->
@if($banners->count() > 0)
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($banners as $index => $banner)
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" 
                    class="{{ $index === 0 ? 'active' : '' }}"></button>
        @endforeach
    </div>
    
    <div class="carousel-inner">
        @foreach($banners as $index => $banner)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ $banner->image_url ?? 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=1920&q=80' }}" class="d-block w-100" alt="{{ $banner->title }}" style="height: 600px; object-fit: cover; filter: brightness(0.9);">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-start">
                    <div class="hero-badge mb-3">
                        <i class="fas fa-certificate"></i> {{ __('common.trusted_by_500_companies') }}
                    </div>
                    <h1 class="display-4 fw-bold mb-3">{{ $banner->title }}</h1>
                    <p class="lead mb-4" style="max-width: 600px; text-shadow: 2px 2px 8px rgba(0,0,0,0.7);">{{ $banner->subtitle ?? __('common.hero_slogan') }}</p>
                    <div class="d-flex gap-3">
                        @if($banner->link)
                            <a href="{{ $banner->link }}" class="btn btn-warning btn-lg shadow-lg cta-primary">
                                <i class="fas fa-calculator me-2"></i>{{ __('common.get_quote_now') }}
                            </a>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-lg cta-secondary">
                                <i class="fas fa-box me-2"></i>{{ __('common.view_products') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
@endif

<!-- Logo Partners Slider -->
<section class="py-4 bg-light border-top border-bottom">
    <div class="container">
        <div class="partners-slider">
            <div class="partners-track">
                <div class="partner-logo"><img src="{{ asset('images/partners/logo-1.jpg') }}" alt="Partner 1"></div>
                <div class="partner-logo"><img src="{{ asset('images/partners/logo-2.jpg') }}" alt="Partner 2"></div>
                <div class="partner-logo"><img src="{{ asset('images/partners/logo-3.jpg') }}" alt="Partner 3"></div>
                <div class="partner-logo"><img src="{{ asset('images/partners/logo-4.jpg') }}" alt="Partner 4"></div>
                <div class="partner-logo"><img src="{{ asset('images/partners/logo-5.jpg') }}" alt="Partner 5"></div>
                <div class="partner-logo"><img src="{{ asset('images/partners/logo-1.jpg') }}" alt="Partner 1"></div>
                <div class="partner-logo"><img src="{{ asset('images/partners/logo-2.jpg') }}" alt="Partner 2"></div>
                <div class="partner-logo"><img src="{{ asset('images/partners/logo-3.jpg') }}" alt="Partner 3"></div>
            </div>
        </div>
    </div>
</section>

<!-- About Company Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="img-hover-zoom position-relative">
                    <img src="{{ $homeAbout['image_url'] ?? 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&q=80' }}" 
                         alt="VgenTech Generators" 
                         class="img-fluid rounded-4 shadow-lg">
                    <div class="floating-badge">
                        <i class="fas fa-certificate text-warning"></i>
                        <span>ISO 9001:2015</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h2 class="text-gradient mb-3 display-5 fw-bold">{{ $homeAbout['title'] }}</h2>
                <div class="mb-4" style="width: 80px; height: 4px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); border-radius: 2px;"></div>
                
                @if(!empty($homeAbout['lead']))
                    <p class="lead mb-3 text-muted">{!! $homeAbout['lead'] !!}</p>
                @endif
                
                @if(!empty($homeAbout['description']))
                    <p class="mb-4 fs-6 lh-lg">{!! $homeAbout['description'] !!}</p>
                @endif
                
                <div class="row g-4 mb-4">
                    <div class="col-6">
                        <div class="stats-card p-3 bg-light rounded-4">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-gradient-primary text-white d-flex align-items-center justify-content-center me-3 pulse" 
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-award fa-2x"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0"><span class="counter" data-target="{{ $homeAbout['years'] }}">0</span><span class="text-primary">+</span></h3>
                                    <small class="d-block text-muted fw-semibold">{{ __('common.years_experience') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stats-card p-3 bg-light rounded-4">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-gradient-primary text-white d-flex align-items-center justify-content-center me-3 pulse" 
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0"><span class="counter" data-target="{{ $homeAbout['clients'] }}">0</span><span class="text-primary">+</span></h3>
                                    <small class="d-block text-muted fw-semibold">{{ __('common.happy_customers') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('about') }}" class="btn btn-primary btn-lg shadow">
                    <i class="fas fa-info-circle"></i> {{ __('common.learn_more') }}
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-5 bg-white">
    <div class="container">
    <h2 class="section-title">{{ __('common.featured_products') }}</h2>
        
        <div class="row g-4">
            @foreach($featuredProducts as $product)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card product-card h-100 border-0 shadow-sm">
                        <div class="product-image-wrapper position-relative">
                            <img src="{{ $product->featured_image_url ?? 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=400&q=80' }}" 
                                 class="card-img-top" alt="{{ $product->name }}" style="height: 220px; object-fit: cover;">
                            @if($product->is_featured)
                                <span class="product-badge badge-featured"><i class="fas fa-star"></i> {{ __('common.best_seller') }}</span>
                            @endif
                            @if($product->is_new)
                                <span class="product-badge badge-new"><i class="fas fa-sparkles"></i> {{ __('common.new') }}</span>
                            @endif
                            @if($product->brand)
                                <span class="product-badge badge-brand">{{ $product->brand }}</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <span class="badge bg-primary mb-2">{{ $product->category->name }}</span>
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($product->short_description ?? $product->description, 80) }}</p>
                            <div class="product-price mt-3">
                                @if($product->price && $product->price < 50000000)
                                    <p class="text-danger fw-bold fs-5 mb-0">{{ number_format($product->price) }} VNĐ</p>
                                @else
                                    <p class="text-danger fw-bold mb-0"><i class="fas fa-phone-alt text-danger"></i> Giá: Liên hệ</p>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary btn-sm w-100 btn-product-detail">
                                <i class="fas fa-info-circle"></i> {{ __('common.view_details') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-lg">
                {{ __('common.view_all') }} {{ __('common.products') }} <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Featured Projects -->
@if($featuredProjects->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title">{{ __('common.featured_projects') }}</h2>
        
        <div class="row g-4">
            @foreach($featuredProjects as $project)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                    <img src="{{ $project->featured_image_url ?? 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=500&q=80' }}" 
                             class="card-img-top" alt="{{ $project->title }}" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->title }}</h5>
                            <p class="card-text">
                                <small class="text-muted">
                                    <i class="fas fa-building"></i> {{ $project->client_name }}<br>
                                    <i class="fas fa-map-marker-alt"></i> {{ $project->location }}
                                </small>
                            </p>
                            <p class="card-text">{{ Str::limit($project->short_description ?? $project->description, 100) }}</p>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-eye"></i> {{ __('common.view_project') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('projects.index') }}" class="btn btn-outline-primary btn-lg">
                {{ __('common.view_all') }} {{ __('common.projects') }} <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Latest News -->
@if($latestPosts->count() > 0)
<section class="py-5">
    <div class="container">
        <h2 class="section-title">{{ __('common.latest_news') }}</h2>
        
        <div class="row g-4">
            @foreach($latestPosts as $post)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        @if($post->featured_image_url)
                            <img src="{{ $post->featured_image_url }}" class="card-img-top" alt="{{ $post->title }}" 
                                 style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <div class="mb-2">
                                @foreach($post->tags as $tag)
                                    <span class="badge bg-secondary">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->excerpt }}</p>
                            <p class="text-muted small">
                                <i class="fas fa-calendar"></i> {{ $post->published_at->format('d/m/Y') }}
                                <i class="fas fa-eye ms-2"></i> {{ $post->view_count }} {{ __('common.view_count') }}
                            </p>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary btn-sm w-100">
                                {{ __('common.read_more') }} <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('blog.index') }}" class="btn btn-outline-primary btn-lg">
                {{ __('common.view_all_news') }} <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Testimonials -->
@if($testimonials->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title">{{ __('common.our_customers') }}</h2>
        
        <div class="row g-4">
            @foreach($testimonials as $testimonial)
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                @if($testimonial->avatar_url)
                                    <img src="{{ $testimonial->avatar_url }}" class="rounded-circle me-3" 
                                         width="60" height="60" alt="{{ $testimonial->customer_name }}">
                                @else
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" 
                                         style="width: 60px; height: 60px;">
                                        <i class="fas fa-user fa-2x"></i>
                                    </div>
                                @endif
                                <div>
                                    <h6 class="mb-0">{{ $testimonial->customer_name }}</h6>
                                    <small class="text-muted">{{ $testimonial->customer_position }}</small><br>
                                    <small class="text-muted">{{ $testimonial->customer_company }}</small>
                                </div>
                            </div>
                            <div class="mb-2">
                                @for($i = 0; $i < $testimonial->rating; $i++)
                                    <i class="fas fa-star text-warning"></i>
                                @endfor
                            </div>
                            <p class="card-text">"{{ $testimonial->content }}"</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Call to Action -->
<section class="cta-section-bg text-white">
    <div class="container text-center">
        <h2 class="mb-3 animate-fadeInUp">{{ __('common.need_consultation') }}?</h2>
        <p class="lead mb-4 animate-fadeIn">{{ __('common.consultation_text') }}</p>
        <div class="animate-fadeInUp">
            <a href="{{ route('contact') }}" class="btn btn-light btn-lg me-2">
                <i class="fas fa-phone"></i> {{ __('common.get_in_touch') }}
            </a>
            <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-lg">
                <i class="fas fa-box"></i> {{ __('common.view_all') }} {{ __('common.products') }}
            </a>
        </div>
    </div>
</section>
@endsection
