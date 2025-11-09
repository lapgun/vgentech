@extends('layouts.main')

@section('title', __('common.recruitment') . ' - VgenTech')

@section('content')
<!-- Page Header -->
<div class="page-header-bg text-white py-5">
    <div class="container">
        <h1 class="animate-fadeInUp"><i class="fas fa-users"></i> {{ __('common.recruitment') }}</h1>
        <nav aria-label="breadcrumb" class="animate-fadeIn">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">{{ __('common.home') }}</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ __('common.recruitment') }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Recruitment Section -->
<section class="py-5">
    <div class="container">
        <!-- Search Bar -->
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto">
                <form method="GET" action="{{ route('recruitment.index') }}">
                    <div class="input-group input-group-lg">
                        <input type="text" name="search" class="form-control" 
                               placeholder="{{ __('common.search_jobs') }}" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> {{ __('common.search') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Job Count -->
        <div class="mb-4">
            <p class="text-muted">{{ __('common.found') }} <strong>{{ $jobs->total() }}</strong> {{ __('common.current_openings') }}</p>
        </div>

        <!-- Jobs List -->
        @if($jobs->count() > 0)
            <div class="row g-4">
                @foreach($jobs as $job)
                    <div class="col-lg-6">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title mb-0">{{ $job->title }}</h5>
                                    @if($job->is_urgent)
                                        <span class="badge bg-danger">Gấp</span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <p class="text-muted mb-2">
                                        <i class="fas fa-map-marker-alt text-primary"></i> {{ $job->location }}
                                    </p>
                                    @if($job->salary_range)
                                        <p class="text-danger fw-bold mb-2">
                                            <i class="fas fa-dollar-sign"></i> {{ $job->salary_range }}
                                        </p>
                                    @else
                                        <p class="text-muted mb-2">
                                            <i class="fas fa-dollar-sign"></i> {{ __('common.negotiate') }}
                                        </p>
                                    @endif
                                    <p class="text-muted mb-2">
                                        <i class="fas fa-briefcase text-primary"></i> {{ $job->job_type ?? __('common.full_time') }}
                                    </p>
                                    <p class="text-muted mb-2">
                                        <i class="fas fa-users text-primary"></i> {{ __('common.positions_available') }}: {{ $job->quantity }} {{ __('common.people') }}
                                    </p>
                                </div>

                                <p class="card-text">
                                    {!! Str::limit(strip_tags($job->description), 150) !!}
                                </p>

                                @if($job->deadline)
                                    <p class="text-muted small">
                                        <i class="fas fa-calendar-times"></i> 
                                        {{ __('common.submit_deadline') }}: <strong>{{ \Carbon\Carbon::parse($job->deadline)->format('d/m/Y') }}</strong>
                                        @if(\Carbon\Carbon::parse($job->deadline)->isPast())
                                            <span class="badge bg-secondary">{{ __('common.expired') }}</span>
                                        @elseif(\Carbon\Carbon::parse($job->deadline)->diffInDays() <= 7)
                                            <span class="badge bg-warning text-dark">{{ __('common.expiring_soon') }}</span>
                                        @endif
                                    </p>
                                @endif

                                <p class="text-muted small">
                                    <i class="fas fa-eye"></i> {{ $job->view_count }} {{ __('common.view_count') }}
                                </p>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="{{ route('recruitment.show', $job->slug) }}" 
                                   class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i> {{ __('common.view_details') }}
                                </a>
                                <a href="{{ route('recruitment.show', $job->slug) }}#apply" 
                                   class="btn btn-success btn-sm">
                                    <i class="fas fa-paper-plane"></i> {{ __('common.apply_now') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-5">
                {{ $jobs->links() }}
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> {{ __('common.no_positions_available') }}
            </div>
        @endif

        <!-- Why Join Us Section -->
        <div class="mt-5">
            <div class="card">
                <div class="card-header card-header-gradient text-white">
                    <h3 class="mb-0"><i class="fas fa-handshake"></i> Tại sao nên gia nhập VgenTech?</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="text-center">
                                <i class="fas fa-chart-line fa-3x text-primary mb-3"></i>
                                <h5>Phát triển sự nghiệp</h5>
                                <p class="text-muted">Cơ hội thăng tiến rõ ràng và đào tạo chuyên nghiệp</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="text-center">
                                <i class="fas fa-coins fa-3x text-primary mb-3"></i>
                                <h5>Thu nhập hấp dẫn</h5>
                                <p class="text-muted">Lương thưởng cạnh tranh, đánh giá định kỳ</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="text-center">
                                <i class="fas fa-heart fa-3x text-primary mb-3"></i>
                                <h5>Môi trường thân thiện</h5>
                                <p class="text-muted">Văn hóa doanh nghiệp năng động, sáng tạo</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
