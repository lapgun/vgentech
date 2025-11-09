@extends('layouts.main')

@section('title', $job->title . ' - ' . __('common.recruitment') . ' - VgenTech')

@section('content')
<!-- Page Header -->
<div class="page-header-bg text-white py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">{{ __('common.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('recruitment.index') }}" class="text-white">{{ __('common.recruitment') }}</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ $job->title }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Job Detail Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Job Header -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h1 class="mb-2">{{ $job->title }}</h1>
                                @if($job->is_urgent)
                                    <span class="badge bg-danger">{{ __('common.urgent_hiring') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                    <strong>{{ __('common.location') }}:</strong> {{ $job->location }}
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <i class="fas fa-briefcase text-primary"></i>
                                    <strong>{{ __('common.job_type') }}:</strong> {{ $job->job_type ?? __('common.full_time') }}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-users text-primary"></i>
                                    <strong>{{ __('common.positions_available') }}:</strong> {{ $job->quantity }} {{ __('common.people') }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                @if($job->salary_range)
                                    <p class="mb-2">
                                        <i class="fas fa-dollar-sign text-primary"></i>
                                        <strong>{{ __('common.salary_range') }}:</strong> <span class="text-danger fw-bold">{{ $job->salary_range }}</span>
                                    </p>
                                @else
                                    <p class="mb-2">
                                        <i class="fas fa-dollar-sign text-primary"></i>
                                        <strong>{{ __('common.salary_range') }}:</strong> {{ __('common.negotiate') }}
                                    </p>
                                @endif
                                @if($job->deadline)
                                    <p class="mb-2">
                                        <i class="fas fa-calendar-times text-primary"></i>
                                        <strong>{{ __('common.submit_deadline') }}:</strong> {{ \Carbon\Carbon::parse($job->deadline)->format('d/m/Y') }}
                                        @if(\Carbon\Carbon::parse($job->deadline)->isPast())
                                            <span class="badge bg-secondary ms-2">{{ __('common.expired') }}</span>
                                        @elseif(\Carbon\Carbon::parse($job->deadline)->diffInDays() <= 7)
                                            <span class="badge bg-warning text-dark ms-2">{{ __('common.expiring_soon') }}</span>
                                        @endif
                                    </p>
                                @endif
                                <p class="mb-2">
                                    <i class="fas fa-eye text-primary"></i>
                                    {{ $job->view_count }} {{ __('common.view_count') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Description -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h4 class="mb-0"><i class="fas fa-file-alt"></i> {{ __('common.job_description') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="job-description">
                            {!! $job->description !!}
                        </div>
                    </div>
                </div>

                <!-- Requirements -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h4 class="mb-0"><i class="fas fa-list-check"></i> {{ __('common.job_requirements') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="requirements">
                            {!! $job->requirements !!}
                        </div>
                    </div>
                </div>

                <!-- Benefits -->
                @if($job->benefits)
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h4 class="mb-0"><i class="fas fa-gift"></i> {{ __('common.job_benefits') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="benefits">
                                {!! $job->benefits !!}
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Application Form -->
                <div class="card" id="apply">
                    <div class="card-header card-header-gradient text-white">
                        <h4 class="mb-0"><i class="fas fa-paper-plane"></i> {{ __('common.apply_for_position') }}</h4>
                    </div>
                    <div class="card-body">
                        @if(\Carbon\Carbon::parse($job->deadline)->isPast())
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i> {{ __('common.position_expired') }}.
                            </div>
                        @else
                            <p class="mb-3">{{ __('common.fill_application') }}:</p>
                            
                            <form method="POST" action="{{ route('recruitment.apply', $job->slug) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">{{ __('common.full_name') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">{{ __('common.your_phone') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                               id="phone" name="phone" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="cv" class="form-label">{{ __('common.attach_cv') }} <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control @error('cv') is-invalid @enderror" 
                                               id="cv" name="cv" accept=".pdf,.doc,.docx" required>
                                        @error('cv')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="cover_letter" class="form-label">{{ __('common.cover_letter') }}</label>
                                        <textarea class="form-control @error('cover_letter') is-invalid @enderror" 
                                                  id="cover_letter" name="cover_letter" rows="5">{{ old('cover_letter') }}</textarea>
                                        @error('cover_letter')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane"></i> {{ __('common.submit_application') }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Contact Card -->
                <div class="card mb-4 sticky-top" style="top: 20px;">
                    <div class="card-header card-header-gradient text-white">
                        <h5 class="mb-0"><i class="fas fa-phone"></i> {{ __('common.contact_consultation') }}</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ __('common.consultation_recruitment_text') }}</p>
                        
                        <div class="mb-3">
                            <p class="mb-2">
                                <i class="fas fa-phone text-primary"></i>
                                <strong>{{ __('common.hotline') }}:</strong><br>
                                <a href="tel:0123456789">0123 456 789</a>
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-envelope text-primary"></i>
                                <strong>Email:</strong><br>
                                <a href="mailto:hr@vgentech.vn">hr@vgentech.vn</a>
                            </p>
                            <p class="mb-0">
                                <i class="fas fa-clock text-primary"></i>
                                <strong>{{ __('common.working_time') }}:</strong><br>
                                {{ __('common.monday_friday') }}: 8:00 - 17:30<br>
                                {{ __('common.saturday') }}: 8:00 - 12:00
                            </p>
                        </div>

                        <hr>

                        <a href="{{ route('recruitment.index') }}" class="btn btn-outline-primary w-100">
                            <i class="fas fa-list"></i> {{ __('common.view_all_positions') }}
                        </a>
                    </div>
                </div>

                <!-- Share -->
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="fas fa-share-alt"></i> {{ __('common.share_job') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('recruitment.show', $job->slug)) }}" 
                               target="_blank" class="btn btn-primary btn-sm">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('recruitment.show', $job->slug)) }}&text={{ urlencode($job->title) }}" 
                               target="_blank" class="btn btn-info btn-sm">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('recruitment.show', $job->slug)) }}" 
                               target="_blank" class="btn btn-primary btn-sm">
                                <i class="fab fa-linkedin-in"></i> LinkedIn
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
