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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.showcase-nav-btn');
        const scrollByAmount = (track) => {
            const card = track.querySelector('.showcase-card');
            if (!card) return track.clientWidth;
            const style = getComputedStyle(track);
            const gap = parseFloat(style.columnGap || style.gap || 0);
            return card.getBoundingClientRect().width + gap;
        };

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetSelector = btn.getAttribute('data-target');
                const track = document.querySelector(targetSelector);
                if (!track) return;

                const amount = scrollByAmount(track);
                const direction = btn.getAttribute('data-dir') === 'next' ? 1 : -1;
                track.scrollBy({ left: direction * amount, behavior: 'smooth' });
            });
        });
    });
</script>
@endpush

<!-- Logo Partners Slider -->
<section class="py-4 border-top border-bottom bg-white">
    <div class="container">
        <div class="partners-slider">
            <div class="partners-track">
                <div class="partner-logo"><img src="{{ asset('images/partners/logo-1.jpg') }}" alt="Partner 1" loading="lazy"></div>
                <div class="partner-logo"><img src="{{ asset('images/partners/logo-2.jpg') }}" alt="Partner 2" loading="lazy"></div>
                <div class="partner-logo"><img src="{{ asset('images/partners/logo-3.jpg') }}" alt="Partner 3" loading="lazy"></div>
                <div class="partner-logo"><img src="{{ asset('images/partners/logo-4.jpg') }}" alt="Partner 4" loading="lazy"></div>
                <div class="partner-logo"><img src="{{ asset('images/partners/logo-5.jpg') }}" alt="Partner 5" loading="lazy"></div>
                <div class="partner-logo"><img src="{{ asset('images/partners/logo-1.jpg') }}" alt="Partner 1" loading="lazy"></div>
                <div class="partner-logo"><img src="{{ asset('images/partners/logo-2.jpg') }}" alt="Partner 2" loading="lazy"></div>
                <div class="partner-logo"><img src="{{ asset('images/partners/logo-3.jpg') }}" alt="Partner 3" loading="lazy"></div>
            </div>
        </div>
    </div>
</section>

<!-- About Company Section -->
<section class="py-5">
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

<!-- Featured Products (Slider style) -->
<section class="py-5 bg-white showcase-section">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
            <div class="section-heading mb-0 flex-grow-1 text-center">
                <h2 class="section-title mb-2">{{ __('common.featured_products') }}</h2>
                <div class="section-underline"></div>
            </div>
            <div class="showcase-nav" aria-label="Products navigation">
                <button class="showcase-nav-btn" type="button" data-dir="prev" data-target="#featured-products-track">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="showcase-nav-btn" type="button" data-dir="next" data-target="#featured-products-track">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="showcase-track" id="featured-products-track">
            @foreach($featuredProducts as $product)
                <div class="showcase-card">
                    <div class="showcase-image">
                        <img src="{{ $product->featured_image_url ?? 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=600&q=80' }}" alt="{{ $product->name }}" loading="lazy">
                        <div class="showcase-overlay">
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>{{ __('common.view_details') }}
                            </a>
                            <a href="{{ route('products.show', $product->slug) }}#specs" class="btn btn-outline-light btn-sm">
                                <i class="fas fa-info-circle me-1"></i>{{ __('common.specifications') }}
                            </a>
                        </div>
                    </div>
                    <div class="showcase-title text-uppercase">
                        {{ $product->name }}
                    </div>
                    @if($product->category)
                    <div class="showcase-micro-info">
                        {{ $product->category->name }}<span class="separator">|</span>{{ __('common.diesel_fuel') }}<span class="separator">|</span>{{ __('common.three_phase') }}
                    </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Projects (Slider style) -->
@if($featuredProjects->count() > 0)
<section class="py-5 showcase-section projects-section">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
            <div class="section-heading mb-0 flex-grow-1 text-center">
                <h2 class="section-title mb-2">{{ __('common.featured_projects') }}</h2>
                <div class="section-underline"></div>
            </div>
            <div class="showcase-nav" aria-label="Projects navigation">
                <button class="showcase-nav-btn" type="button" data-dir="prev" data-target="#featured-projects-track">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="showcase-nav-btn" type="button" data-dir="next" data-target="#featured-projects-track">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="showcase-track" id="featured-projects-track">
            @foreach($featuredProjects as $project)
                <div class="showcase-card">
                    <div class="showcase-image">
                        @if($project->category)
                        <div class="showcase-badge">{{ $project->category->name }}</div>
                        @endif
                        <img src="{{ $project->featured_image_url ?? 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=800&q=80' }}" alt="{{ $project->title }}" loading="lazy">
                        <div class="showcase-overlay">
                            <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>{{ __('common.view_project') }}
                            </a>
                        </div>
                    </div>
                    <div class="showcase-title text-uppercase">
                        {{ $project->title }}
                    </div>
                    @if($project->description)
                    <div class="showcase-micro-info">
                        {{ Str::limit(strip_tags($project->description), 60) }}
                    </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Latest News -->
@if($latestPosts->count() > 0)
<section class="py-5 bg-white news-section">
    <div class="container">
        <div class="section-heading">
            <h2 class="section-title mb-2">{{ __('common.latest_news') }}</h2>
            <div class="section-underline"></div>
        </div>

        <div class="row g-4 align-items-stretch">
            <div class="col-lg-6">
                <a class="news-featured card h-100">
                    <img src="{{ asset('images/khuen-cao-evn.jpg') }}" class="card-img-top" loading="lazy" style="width: 100%; height: 520px; object-fit: cover;">
                    <div class="card-body align-content-end">
                        <h4 class="card-title">{{ __('common.safe_power_title') }}</h4>
                        <p class="card-text text-muted">{{ __('common.safe_power_body') }}</p>
                        <p class="text-muted small mb-0"><i class="fas fa-calendar"></i> {{ __('common.updated_latest') }}</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-6">
                <div class="news-list">
                    @foreach($latestPosts as $post)
                        <a href="{{ route('blog.show', $post->slug) }}" class="news-list-item d-flex">
                            @if($post->featured_image_url)
                                <div class="news-thumb">
                                    <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" loading="lazy">
                                </div>
                            @endif
                            <div class="news-info flex-grow-1">
                                <h6 class="mb-1">{{ $post->title }}</h6>
                                <p class="text-muted small mb-1">{{ Str::limit($post->excerpt, 80) }}</p>
                                <span class="text-muted tiny"><i class="fas fa-calendar"></i> {{ $post->published_at->format('d/m/Y') }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Testimonials -->
@if($testimonials->count() > 0)
<section class="py-5">
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
            <a href="{{ route('contact') }}" class="btn btn-light btn-lg m-2">
                <i class="fas fa-phone"></i> {{ __('common.get_in_touch') }}
            </a>
            <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-lg">
                <i class="fas fa-box"></i> {{ __('common.view_all') }} {{ __('common.products') }}
            </a>
        </div>
    </div>
</section>
@endsection
