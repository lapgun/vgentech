<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        @php
            $siteName = $siteSettings['site_name'] ?? 'VgenTech';
            $hasLogo = !empty($siteSettings['site_logo_url']);
        @endphp
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}" aria-label="{{ $siteName }}">
                @if($hasLogo)
                    <img src="{{ $siteSettings['site_logo_url'] }}" alt="{{ $siteName }}" style="height: 40px; width: auto;">
                @else
                    <i class="fas fa-bolt me-2"></i>
                    <span class="fw-bold">{{ $siteName }}</span>
                @endif
            </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
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
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('products.*') ? 'active' : '' }}" 
                       href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-box"></i> {{ __('common.products') }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('products.index') }}">{{ __('common.all_products') }}</a></li>
                        <li><hr class="dropdown-divider"></li>
                        @php
                            $categories = \App\Models\Category::root()->active()->orderBy('sort_order')->get();
                        @endphp
                        @foreach($categories as $category)
                            <li>
                                <a class="dropdown-item" href="{{ route('products.index', ['category' => $category->slug]) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}" href="{{ route('projects.index') }}">
                        <i class="fas fa-project-diagram"></i> {{ __('common.projects') }}
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">
                        <i class="fas fa-newspaper"></i> {{ __('common.blog') }}
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('recruitment.*') ? 'active' : '' }}" href="{{ route('recruitment.index') }}">
                        <i class="fas fa-users"></i> {{ __('common.recruitment') }}
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                        <i class="fas fa-envelope"></i> {{ __('common.contact') }}
                    </a>
                </li>
                
                                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-globe"></i>
                        @if(app()->getLocale() == 'vi')
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
                    <a class="nav-link search-toggle" href="#" data-bs-toggle="modal" data-bs-target="#searchModal">
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
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            @if(auth()->user()->isAdmin())
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                                    <i class="fas fa-user-circle"></i> {{ __('Profile') }}
                                </a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
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
