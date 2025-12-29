<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container-fluid">
        @php
            $siteName = $siteSettings['site_name'] ?? 'VgenTech';
            $hasLogo = !empty($siteSettings['site_logo_url']);
        @endphp
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}" aria-label="{{ $siteName }}">
            @if ($hasLogo)
                <img src="{{ $siteSettings['site_logo_url'] }}" alt="{{ $siteName }}" height="60px" width="220px">
            @else
                <i class="fas fa-bolt me-2"></i>
                <span class="fw-bold">{{ $siteName }}</span>
            @endif
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fas fa-home"></i> {{ __('common.home') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        <i class="fas fa-info-circle"></i> {{ __('common.about') }}
                    </a>
                </li>

                <li class="nav-item dropdown mega-menu-dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('products.*') ? 'active' : '' }}"
                        href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-box"></i> {{ __('common.products') }}
                    </a>
                    <div class="dropdown-menu mega-menu p-4">
                        <div class="row g-0">
                            <div class="col-12 mb-3 pb-3 border-bottom">
                                <h6 class="mega-menu-title text-primary mb-0"><i class="fas fa-th-large"></i> {{ __('common.all_products') }}</h6>
                                <a class="text-warning small d-inline-block mt-2" href="{{ route('products.index') }}">
                                    <i class="fas fa-arrow-right"></i> {{ __('common.view_all') }}
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
                                        <i class="fas fa-headset"></i> {{ __('common.need_support') }}
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-warning w-100">
                                        <i class="fas fa-list"></i> {{ __('common.browse_catalog') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}"
                        href="{{ route('projects.index') }}">
                        <i class="fas fa-project-diagram"></i> {{ __('common.projects') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}"
                        href="{{ route('blog.index') }}">
                        <i class="fas fa-newspaper"></i> {{ __('common.blog') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('recruitment.*') ? 'active' : '' }}"
                        href="{{ route('recruitment.index') }}">
                        <i class="fas fa-users"></i> {{ __('common.recruitment') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                        href="{{ route('contact') }}">
                        <i class="fas fa-envelope"></i> {{ __('common.contact') }}
                    </a>
                </li>
            </ul>

            <!-- Right Side: Language, Search, Login -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-globe"></i>
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> {{ __('Log in') }}
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            @if (auth()->user()->isAdmin())
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt"></i> Dashboard
                                    </a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                                        <i class="fas fa-user-circle"></i> {{ __('Profile') }}
                                    </a></li>
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('Log Out') }}
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
