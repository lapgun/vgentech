@extends('layouts.main')

@section('title', __('common.contact') . ' - VgenTech')

@section('content')
<!-- Page Header -->
<div class="page-header-bg text-white py-5">
    <div class="container">
        <h1 class="animate-fadeInUp"><i class="fas fa-envelope"></i> {{ __('common.contact_us') }}</h1>
        <nav aria-label="breadcrumb" class="animate-fadeIn">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">{{ __('common.home') }}</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ __('common.contact') }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Contact Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-8 mb-4">
                <div class="card">
                    <div class="card-header card-header-gradient text-white">
                        <h4 class="mb-0"><i class="fas fa-paper-plane"></i> {{ __('common.send_message') }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('contact.store') }}">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('common.full_name') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('common.phone') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                           value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('common.email') }}</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('common.subject') }}</label>
                                    <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" 
                                           value="{{ old('subject') }}">
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">{{ __('common.message') }} <span class="text-danger">*</span></label>
                                <textarea name="message" rows="5" class="form-control @error('message') is-invalid @enderror" 
                                          required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane"></i> {{ __('common.send') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Contact Info -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header card-header-gradient text-white">
                        <h5 class="mb-0"><i class="fas fa-info-circle"></i> {{ __('common.contact_info') }}</h5>
                    </div>
                    <div class="card-body">
                        @if($contactInfo['address'])
                            <div class="mb-3">
                                <h6><i class="fas fa-map-marker-alt text-primary"></i> {{ __('common.address') }}</h6>
                                <p>{{ $contactInfo['address'] }}</p>
                            </div>
                        @endif
                        
                        @if($contactInfo['phone'])
                            <div class="mb-3">
                                <h6><i class="fas fa-phone text-primary"></i> {{ __('common.phone') }}</h6>
                                <p><a href="tel:{{ $contactInfo['phone'] }}">{{ $contactInfo['phone'] }}</a></p>
                            </div>
                        @endif
                        
                        @if($contactInfo['email'])
                            <div class="mb-3">
                                <h6><i class="fas fa-envelope text-primary"></i> {{ __('common.email') }}</h6>
                                <p><a href="mailto:{{ $contactInfo['email'] }}">{{ $contactInfo['email'] }}</a></p>
                            </div>
                        @endif
                        
                        <div class="mb-3">
                            <h6><i class="fas fa-share-alt text-primary"></i> {{ __('common.follow_us') }}</h6>
                            <div class="social-links">
                                @if($contactInfo['facebook'])
                                    <a href="{{ $contactInfo['facebook'] }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        <i class="fab fa-facebook"></i> Facebook
                                    </a>
                                @endif
                                @if($contactInfo['youtube'])
                                    <a href="{{ $contactInfo['youtube'] }}" target="_blank" class="btn btn-outline-danger btn-sm">
                                        <i class="fab fa-youtube"></i> YouTube
                                    </a>
                                @endif
                                @if($contactInfo['linkedin'])
                                    <a href="{{ $contactInfo['linkedin'] }}" target="_blank" class="btn btn-outline-info btn-sm">
                                        <i class="fab fa-linkedin"></i> LinkedIn
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Working Hours -->
                <div class="card">
                    <div class="card-header card-header-gradient text-white">
                        <h5 class="mb-0"><i class="fas fa-clock"></i> {{ __('common.working_hours') }}</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>{{ __('common.monday_friday') }}:</strong> 8:00 - 17:30</p>
                        <p><strong>{{ __('common.saturday') }}:</strong> 8:00 - 12:00</p>
                        <p><strong>{{ __('common.sunday') }}:</strong> {{ __('common.closed') }}</p>
                        <hr>
                        <p class="text-muted mb-0">
                            <i class="fas fa-info-circle"></i> {{ __('common.hotline_support') }}:<br>
                            <strong class="text-primary fs-5">{{ $contactInfo['phone'] ?? '0123 456 789' }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
