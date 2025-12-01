@extends('layouts.main')

@section('title', __('common.projects') . ' - VgenTech')

@section('content')
<!-- Page Header -->
<div class="page-header-bg text-white py-5">
    <div class="container">
        <h1 class="animate-fadeInUp"><i class="fas fa-project-diagram"></i> {{ __('common.projects') }}</h1>
        <nav aria-label="breadcrumb" class="animate-fadeIn">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">{{ __('common.home') }}</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ __('common.projects') }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Projects Section -->
<section class="py-5">
    <div class="container">
        <!-- Search Bar -->
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto">
                <form method="GET" action="{{ route('projects.index') }}">
                    <div class="input-group input-group-lg">
                        <input type="text" name="search" class="form-control" 
                               placeholder="{{ __('common.search_projects') }}" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> {{ __('common.search') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Projects Count -->
        <div class="mb-4">
            <p class="text-muted">{{ __('common.found') }} <strong>{{ $projects->total() }}</strong> {{ __('common.projects') }}</p>
        </div>

        <!-- Projects Grid -->
        @if($projects->count() > 0)
            <div class="row g-4">
                @foreach($projects as $project)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm">
                            <div class="position-relative">
                          <img src="{{ $project->featured_image_url ?? 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=500&q=80' }}" 
                                     class="card-img-top" alt="{{ $project->title }}"
                                     style="height: 250px; object-fit: cover;">
                                @if($project->status)
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-success">
                                        {{ $project->status }}
                                    </span>
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $project->title }}</h5>
                                <p class="card-text text-muted">
                                    {{ Str::limit($project->description, 100) }}
                                </p>
                                
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    @if($project->client_name)
                                        <small class="text-muted">
                                            <i class="fas fa-building"></i> {{ $project->client_name }}
                                        </small>
                                    @endif
                                    @if($project->completion_date)
                                        <small class="text-muted">
                                            <i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($project->completion_date)->format('m/Y') }}
                                        </small>
                                    @endif
                                </div>

                                @if($project->technologies && is_array($project->technologies))
                                    <div class="mb-2">
                                        @foreach($project->technologies as $tech)
                                            <span class="badge bg-secondary me-1">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                @endif

                                <p class="text-muted small mb-0">
                                    <i class="fas fa-eye"></i> {{ $project->view_count }} {{ __('common.view_count') }}
                                </p>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="{{ route('projects.show', $project->slug) }}" 
                                   class="btn btn-primary btn-sm w-100">
                                    <i class="fas fa-eye"></i> {{ __('common.view_details') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-5">
                {{ $projects->links() }}
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> {{ __('common.no_projects_found') }}.
            </div>
        @endif
    </div>
</section>
@endsection
