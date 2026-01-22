<header class="site-header sticky-top">
    <div class="header-top">
        <div class="container d-flex align-items-center justify-content-between gap-3 flex-wrap">
            @php
                $siteName = $siteSettings['site_name'] ?? 'VgenTech';
                $hasLogo = !empty($siteSettings['site_logo_url']);
                $tagline = $siteSettings['site_tagline'] ?? __('common.power_solution_partner');
                $hotline = $siteSettings['contact_phone'] ?? config('app.phone', '0123 456 789');
                $qrUrl = $siteSettings['contact_qr_image_url'] ?? null;
            @endphp

            <div class="d-flex align-items-center gap-3 header-brand">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}" aria-label="{{ $siteName }}">
                    @if ($hasLogo)
                        <img src="{{ $siteSettings['site_logo_url'] }}" alt="{{ $siteName }}" height="70" width="200">
                    @else
                        <span class="fw-bold">{{ $siteName }}</span>
                    @endif
                </a>
                <div class="header-brand-text">
                    <div class="fw-bold text-uppercase brand-title mb-1">{{ __('common.company_name_full') }}</div>
                    <div class="text-muted text-uppercase brand-tagline">{{ __('common.company_name_english') }}</div>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3 header-contact">
                <div class="header-hotline d-flex align-items-center gap-2">
                    <span class="hotline-icon d-inline-flex align-items-center justify-content-center">
                        <i class="fas fa-phone-alt"></i>
                    </span>
                    <div class="hotline-text lh-sm">
                        <div class="text-muted small mb-0">{{ __('common.hotline_support') ?? 'Hotline' }}</div>
                        <div class="fw-bold text-primary hotline-number">{{ $hotline }}</div>
                    </div>
                </div>
                @if ($qrUrl)
                    <div class="header-qr text-center">
                        <img src="{{ $qrUrl }}" alt="{{ $siteName }} QR" class="rounded shadow-sm">
                    </div>
                @endif
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg header-nav">
        <div class="container">
            <a class="d-lg-none text-white" href="{{ route('home') }}" aria-label="{{ $siteName }}">
                {{-- @if ($hasLogo)
                    <img src="{{ $siteSettings['site_logo_url'] }}" alt="{{ $siteName }}" height="40" width="40">
                @else --}}
                    <span class="fw-bold">{{ $siteName }}</span>
                {{-- @endif --}}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        {{ __('common.home') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        {{ __('common.about') }}
                    </a>
                </li>

                <li class="nav-item dropdown mega-menu-dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('products.*') ? 'active' : '' }}"
                        href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown">
                        {{ __('common.products') }}
                    </a>
                    <div class="dropdown-menu mega-menu p-4">
                        <div class="row g-0">
                            <div class="col-12 mb-3 pb-3 border-bottom">
                                <h6 class="mega-menu-title text-primary mb-0">{{ __('common.all_products') }}</h6>
                                <a class="text-warning small d-inline-block mt-2" href="{{ route('products.index') }}">
                                    {{ __('common.view_all') }}
                                </a>
                            </div>
                            @php
                                $categories = \App\Models\Category::root()->active()->orderBy('sort_order')->get();
                                $categoryLogos = [
                                    'may-phat-dien-cummins' => 'logo-1.jpg',
                                    'may-phat-dien-doosan' => 'logo-2.jpg',
                                    'may-phat-dien-vman' => 'logo-3.jpg',
                                    'default' => 'logo-4.jpg'
                                ];
                            @endphp
                            @foreach ($categories as $category)
                                <div class="col-lg-6 col-md-12 mb-3">
                                    <a class="mega-menu-item-link" 
                                       href="{{ route('products.index', ['category' => $category->slug]) }}">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="flex-shrink-0" style="width: 40px; height: 40px; background: white; border-radius: 6px; padding: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                                                @php
                                                    $logoFile = $categoryLogos[$category->slug] ?? $categoryLogos['default'];
                                                    $logoPath = asset('images/partners/' . $logoFile);
                                                @endphp
                                                <img src="{{ $logoPath }}" alt="{{ $category->name }}" style="width: 100%; height: 100%; object-fit: contain;">
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <div class="fw-semibold text-dark text-truncate" style="font-size: 0.9rem;">{{ $category->name }}</div>
                                                @if($category->description)
                                                    <small class="text-muted d-block text-truncate" style="font-size: 0.75rem;">{{ Str::limit($category->description, 50) }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="mega-menu-footer mt-3 pt-3 border-top">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <a href="{{ route('contact') }}" class="btn btn-sm btn-outline-primary w-100">
                                        {{ __('common.need_support') }}
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-warning w-100">
                                        {{ __('common.browse_catalog') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}"
                        href="{{ route('projects.index') }}">
                        {{ __('common.projects') }} 
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}"
                        href="{{ route('blog.index') }}">
                        {{ __('common.blog') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('recruitment.*') ? 'active' : '' }}"
                        href="{{ route('recruitment.index') }}">
                        {{ __('common.recruitment') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                        href="{{ route('contact') }}">
                        {{ __('common.contact') }}
                    </a>
                </li>
                </ul>

                <!-- Right Side: Language, Search, Login -->
                <ul class="navbar-nav ms-auto header-right-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @if (app()->getLocale() == 'vi')
                                🇻🇳
                            @elseif(app()->getLocale() == 'zh')
                                🇨🇳
                            @else
                                🇬🇧
                            @endif
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                        <li><a class="dropdown-item" href="{{ url('vi') }}">🇻🇳 Tiếng Việt</a></li>
                        <li><a class="dropdown-item" href="{{ url('en') }}">🇬🇧 English</a></li>
                        <li><a class="dropdown-item" href="{{ url('zh') }}">🇨🇳 中文</a></li>
                        </ul>
                    </li>

                    <!-- Search Button -->
                    <li class="nav-item">
                        <a class="nav-link search-toggle" href="#" data-bs-toggle="modal"
                            data-bs-target="#searchModal">
                            <i class="fas fa-search"></i>
                        </a>
                    </li>

                    @guest
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                {{ __('Log in') }}
                            </a>
                        </li> --}}
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                @if (auth()->user()->isAdmin())
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            Dashboard
                                        </a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                                            {{ __('Profile') }}
                                        </a></li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
