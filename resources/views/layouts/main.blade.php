<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'VgenTech - Máy phát điện chính hãng')</title>
    <meta name="description" content="@yield('description', 'Cung cấp máy phát điện Cummins, Doosan, VMAN chính hãng, giá tốt')">
    <meta name="keywords" content="@yield('keywords', 'máy phát điện, cummins, doosan, vman')">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/style.css'])
    
    @stack('styles')
</head>
<body>
    <!-- Header -->
    @include('partials.header')
    
    <!-- Main Content -->
    <main>
        @if(session('success'))
            <div class="container mt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
        
        @if(session('error'))
            <div class="container mt-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
        
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('partials.footer')
    
    <!-- Floating Contact Buttons -->
    @include('partials.floating-contact')
    
    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content search-modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="searchModalLabel">
                        <i class="fas fa-search"></i> {{ __('common.search') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('search') }}" method="GET" id="searchForm">
                        <div class="search-input-wrapper">
                            <input 
                                type="text" 
                                name="q" 
                                class="form-control form-control-lg search-input" 
                                placeholder="{{ __('common.search_placeholder') }}" 
                                autofocus
                                value="{{ request('q') }}"
                            >
                            <button type="submit" class="btn btn-primary search-btn">
                                <i class="fas fa-search"></i> {{ __('common.search') }}
                            </button>
                        </div>
                        
                        <div class="search-filters mt-3">
                            <div class="btn-group" role="group" aria-label="Search filters">
                                <input type="radio" class="btn-check" name="type" id="all" value="" checked>
                                <label class="btn btn-outline-primary" for="all">
                                    <i class="fas fa-globe"></i> {{ __('common.all') }}
                                </label>
                                
                                <input type="radio" class="btn-check" name="type" id="products" value="products">
                                <label class="btn btn-outline-primary" for="products">
                                    <i class="fas fa-box"></i> {{ __('common.products') }}
                                </label>
                                
                                <input type="radio" class="btn-check" name="type" id="projects" value="projects">
                                <label class="btn btn-outline-primary" for="projects">
                                    <i class="fas fa-project-diagram"></i> {{ __('common.projects') }}
                                </label>
                                
                                <input type="radio" class="btn-check" name="type" id="blog" value="blog">
                                <label class="btn btn-outline-primary" for="blog">
                                    <i class="fas fa-newspaper"></i> {{ __('common.blog') }}
                                </label>
                            </div>
                        </div>
                        
                        <div class="popular-searches mt-4">
                            <h6 class="text-muted mb-3">{{ __('common.popular_searches') }}:</h6>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('search', ['q' => 'Cummins']) }}" class="badge bg-light text-dark">Cummins</a>
                                <a href="{{ route('search', ['q' => 'Doosan']) }}" class="badge bg-light text-dark">Doosan</a>
                                <a href="{{ route('search', ['q' => 'VMAN']) }}" class="badge bg-light text-dark">VMAN</a>
                                <a href="{{ route('search', ['q' => '100kVA']) }}" class="badge bg-light text-dark">100kVA</a>
                                <a href="{{ route('search', ['q' => '200kVA']) }}" class="badge bg-light text-dark">200kVA</a>
                                <a href="{{ route('search', ['q' => 'silent']) }}" class="badge bg-light text-dark">{{ __('common.silent_generator') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Vite Assets -->
    @vite(['resources/js/animations.js'])
    
    @stack('scripts')
</body>
</html>
