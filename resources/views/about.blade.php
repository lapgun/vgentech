@extends('layouts.main')

@section('title', __('common.about') . ' - VgenTech')

@section('content')
<!-- Page Header -->
<div class="page-header-bg text-white py-5">
    <div class="container">
        <h1 class="animate-fadeInUp"><i class="fas fa-info-circle"></i> {{ __('common.about_vgentech') }}</h1>
        <nav aria-label="breadcrumb" class="animate-fadeIn">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">{{ __('common.home') }}</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ __('common.about') }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- About Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="section-title">{{ $aboutPage->title }}</h2>
                        <div class="content">
                            {!! $aboutPage->content !!}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <!-- Quick Contact -->
                <div class="card mb-4">
                    <div class="card-header card-header-gradient text-white">
                        <h5 class="mb-0"><i class="fas fa-phone"></i> {{ __('common.quick_contact') }}</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $phone = \App\Models\Setting::get('contact_phone');
                            $email = \App\Models\Setting::get('contact_email');
                            $address = \App\Models\Setting::get('contact_address');
                        @endphp
                        
                        @if($phone)
                            <p><i class="fas fa-phone text-primary"></i> <a href="tel:{{ $phone }}">{{ $phone }}</a></p>
                        @endif
                        @if($email)
                            <p><i class="fas fa-envelope text-primary"></i> <a href="mailto:{{ $email }}">{{ $email }}</a></p>
                        @endif
                        @if($address)
                            <p><i class="fas fa-map-marker-alt text-primary"></i> {{ $address }}</p>
                        @endif
                        
                        <a href="{{ route('contact') }}" class="btn btn-primary w-100 mt-3">
                            <i class="fas fa-paper-plane"></i> {{ __('common.send_message') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
@endsection
