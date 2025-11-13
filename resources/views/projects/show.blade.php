@extends('layouts.main')

@section('title', $project->name . ' - VgenTech')

@section('content')
<!-- Page Header -->
<div class="page-header-bg text-white py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">{{ __('common.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('projects.index') }}" class="text-white">{{ __('common.projects') }}</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ $project->name }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Project Detail Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Project Header -->
                <div class="mb-4">
                    <h1 class="mb-3">{{ $project->name }}</h1>
                    
                    <div class="d-flex flex-wrap gap-3 mb-3">
                        @if($project->client)
                            <div>
                                <i class="fas fa-building text-primary"></i>
                                <strong>{{ __('common.client') }}:</strong> {{ $project->client }}
                            </div>
                        @endif
                        @if($project->location)
                            <div>
                                <i class="fas fa-map-marker-alt text-primary"></i>
                                <strong>{{ __('common.location') }}:</strong> {{ $project->location }}
                            </div>
                        @endif
                        @if($project->completion_date)
                            <div>
                                <i class="fas fa-calendar text-primary"></i>
                                <strong>{{ __('common.completed') }}:</strong> {{ \Carbon\Carbon::parse($project->completion_date)->format('m/Y') }}
                            </div>
                        @endif
                        @if($project->status)
                            <div>
                                <span class="badge bg-success">{{ $project->status }}</span>
                            </div>
                        @endif
                    </div>

                    @if($project->technologies && is_array($project->technologies))
                        <div class="mb-3">
                            <strong>{{ __('common.technologies') }}:</strong>
                            @foreach($project->technologies as $tech)
                                <span class="badge bg-primary me-1">{{ $tech }}</span>
                            @endforeach
                        </div>
                    @endif

                    <p class="text-muted">
                        <i class="fas fa-eye"></i> {{ $project->view_count }} {{ __('common.view_count') }}
                    </p>
                </div>

                <!-- Project Images -->
                <div class="card mb-4">
                    <div class="card-body">
                    <img src="{{ $project->featured_image_url ?? 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=1000&q=80' }}" 
                             class="img-fluid rounded mb-3" alt="{{ $project->title }}">
                        
                        @if($project->gallery && is_array($project->gallery))
                            <div class="row g-2">
                                @foreach($project->gallery as $image)
                                    <div class="col-md-4 col-6">
                                        <img src="{{ $image }}" class="img-fluid rounded" alt="{{ $project->name }}">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Project Description -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h3><i class="fas fa-file-alt"></i> {{ __('common.project_description_text') }}</h3>
                        <hr>
                        <div class="project-description">
                            {!! $project->description !!}
                        </div>
                    </div>
                </div>

                <!-- Project Details -->
                @if($project->details)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3><i class="fas fa-info-circle"></i> {{ __('common.project_details_text') }}</h3>
                            <hr>
                            <div class="project-details">
                                {!! $project->details !!}
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Related Projects -->
                @if($relatedProjects->count() > 0)
                    <div class="card">
                        <div class="card-header card-header-gradient text-white">
                            <h4 class="mb-0"><i class="fas fa-project-diagram"></i> {{ __('common.related_projects_text') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                @foreach($relatedProjects as $related)
                                    <div class="col-md-4">
                                        <div class="card h-100">
                              <img src="{{ $related->featured_image_url ?? 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=500&q=80' }}" 
                                                 class="card-img-top" alt="{{ $related->title }}"
                                                 style="height: 150px; object-fit: cover;">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $related->name }}</h6>
                                                <p class="card-text text-muted small">
                                                    {{ Str::limit($related->description, 80) }}
                                                </p>
                                                <a href="{{ route('projects.show', $related->slug) }}" 
                                                   class="btn btn-primary btn-sm w-100">
                                                    {{ __('common.view_details') }}
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

            <div class="col-lg-4">
                <!-- Contact Card -->
                <div class="card mb-4 sticky-top" style="top: 20px;">
                    <div class="card-header card-header-gradient text-white">
                        <h5 class="mb-0"><i class="fas fa-envelope"></i> {{ __('common.contact_consultation') }}</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ __('common.consultation_project_text') }}</p>
                        
                        <div class="d-grid gap-2">
                            <a href="{{ route('contact') }}" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> {{ __('common.send_message') }}
                            </a>
                            <a href="tel:0123456789" class="btn btn-outline-primary">
                                <i class="fas fa-phone"></i> 0123 456 789
                            </a>
                            <a href="mailto:info@vgentech.vn" class="btn btn-outline-primary">
                                <i class="fas fa-envelope"></i> info@vgentech.vn
                            </a>
                        </div>

                        <hr>

                        <h6><i class="fas fa-share-alt"></i> {{ __('common.share_project') }}</h6>
                        <div class="d-flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('projects.show', $project->slug)) }}" 
                               target="_blank" class="btn btn-sm btn-primary" title="{{ __('common.share_project') }}">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('projects.show', $project->slug)) }}&text={{ urlencode($project->name) }}" 
                               target="_blank" class="btn btn-sm btn-info" title="{{ __('common.share_project') }}">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('projects.show', $project->slug)) }}" 
                               target="_blank" class="btn btn-sm btn-primary" title="{{ __('common.share_project') }}">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Other Projects -->
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="fas fa-list"></i> {{ __('common.other_projects') }}</h6>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('projects.index') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-arrow-right"></i> {{ __('common.view_all_projects') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
