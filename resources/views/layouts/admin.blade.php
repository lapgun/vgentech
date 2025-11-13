<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $siteName = $siteSettings['site_name'] ?? 'VgenTech';
        $defaultDescription =
            $siteSettings['site_description'] ?? 'Cung cấp máy phát điện Cummins, Doosan, VMAN chính hãng, giá tốt';
        $defaultKeywords = $siteSettings['site_keywords'] ?? 'máy phát điện, cummins, doosan, vman';
    @endphp
    <title>@yield('title', $siteName)</title>
    <meta name="description" content="@yield('description', $defaultDescription)">
    <meta name="keywords" content="@yield('keywords', $defaultKeywords)">

    @if (!empty($siteSettings['site_favicon_url']))
        <link rel="icon" href="{{ $siteSettings['site_favicon_url'] }}" type="image/x-icon">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Custom Scrollbar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 3px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
    </style>

    @stack('styles')
</head>

<body class="min-h-screen bg-gray-100 overflow-x-hidden">
    <div x-data="{ sidebarOpen: false }" class="flex w-full min-h-screen">
        <!-- Mobile sidebar overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 lg:hidden" style="display: none;" x-cloak>
        </div>

        <!-- Sidebar for Desktop -->
        <aside class="hidden lg:flex lg:flex-shrink-0">
            <div class="w-64 bg-white border-r border-gray-200 flex flex-col min-h-screen">
                <!-- Logo & Brand -->
                <div class="h-16 flex items-center px-6 border-b border-gray-200">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bolt text-white"></i>
                        </div>
                        <span class="text-lg font-bold text-gray-900">VgenTech</span>
                    </a>
                </div>

                <!-- Navigation -->
                @php
                    $sidebarUnreadContacts = \App\Models\Contact::where('is_read', false)->count();
                    $sidebarUnreadInquiries = \App\Models\ProductInquiry::where('is_processed', false)->count();
                    $sidebarTotalUnread = $sidebarUnreadContacts + $sidebarUnreadInquiries;
                @endphp

                <nav class="flex-1 px-4 py-6 overflow-y-auto sidebar-scroll">
                    <ul class="space-y-1">
                        <!-- Dashboard -->
                        <li>
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg transition-all group {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                <div class="flex items-center space-x-3">
                                    <i
                                        class="fas fa-home w-5 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-gray-400' }}"></i>
                                    <span>{{ __('admin.dashboard') }}</span>
                                </div>
                                @if ($sidebarTotalUnread > 0)
                                    <span
                                        class="px-2 py-0.5 text-xs font-semibold bg-red-100 text-red-600 rounded-full">{{ $sidebarTotalUnread }}</span>
                                @endif
                            </a>
                        </li>

                        <!-- Content Management -->
                        <li x-data="{ open: @json(request()->routeIs('admin.categories.*') ||
                                request()->routeIs('admin.products.*') ||
                                request()->routeIs('admin.projects.*') ||
                                request()->routeIs('admin.posts.*') ||
                                request()->routeIs('admin.pages.*') ||
                                request()->routeIs('admin.tags.*')) }">
                            <button @click="open = !open" type="button"
                                class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium rounded-lg transition-all group {{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.products.*') || request()->routeIs('admin.projects.*') || request()->routeIs('admin.posts.*') || request()->routeIs('admin.pages.*') || request()->routeIs('admin.tags.*') ? 'bg-gray-50 text-gray-900' : 'text-gray-700 hover:bg-gray-50' }}">
                                <div class="flex items-center space-x-3">
                                    <i
                                        class="fas fa-file-alt w-5 {{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.products.*') || request()->routeIs('admin.projects.*') || request()->routeIs('admin.posts.*') || request()->routeIs('admin.pages.*') || request()->routeIs('admin.tags.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                                    <span>{{ __('admin.content') }}</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200"
                                    :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            <ul x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="mt-1 ml-8 space-y-1" style="display: none;">
                                <li>
                                    <a href="{{ route('admin.categories.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.categories.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.categories') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.products.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.products.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.products') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.projects.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.projects.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.projects') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.posts.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.posts.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.blog_posts') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.pages.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.pages.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.pages') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.tags.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.tags.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.tags') }}
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Marketing -->
                        <li x-data="{ open: @json(request()->routeIs('admin.banners.*') || request()->routeIs('admin.testimonials.*')) }">
                            <button @click="open = !open" type="button"
                                class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium rounded-lg transition-all group {{ request()->routeIs('admin.banners.*') || request()->routeIs('admin.testimonials.*') ? 'bg-gray-50 text-gray-900' : 'text-gray-700 hover:bg-gray-50' }}">
                                <div class="flex items-center space-x-3">
                                    <i
                                        class="fas fa-bullhorn w-5 {{ request()->routeIs('admin.banners.*') || request()->routeIs('admin.testimonials.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                                    <span>{{ __('admin.marketing') }}</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200"
                                    :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            <ul x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="mt-1 ml-8 space-y-1" style="display: none;">
                                <li>
                                    <a href="{{ route('admin.banners.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.banners.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.banners') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.testimonials.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.testimonials.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.testimonials') }}
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Recruitments -->
                        <li>
                            <a href="{{ route('admin.recruitments.index') }}"
                                class="flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg transition-all group {{ request()->routeIs('admin.recruitments.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                <div class="flex items-center space-x-3">
                                    <i
                                        class="fas fa-users w-5 {{ request()->routeIs('admin.recruitments.*') ? 'text-blue-600' : 'text-gray-400' }}"></i>
                                    <span>{{ __('admin.recruitments') }}</span>
                                </div>
                            </a>
                        </li>

                        <!-- Contacts -->
                        <li>
                            <a href="{{ route('admin.contacts.index') }}"
                                class="flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg transition-all group {{ request()->routeIs('admin.contacts.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                <div class="flex items-center space-x-3">
                                    <i
                                        class="fas fa-envelope w-5 {{ request()->routeIs('admin.contacts.*') ? 'text-blue-600' : 'text-gray-400' }}"></i>
                                    <span>{{ __('admin.contacts') }}</span>
                                </div>
                                @if ($sidebarUnreadContacts > 0)
                                    <span
                                        class="px-2 py-0.5 text-xs font-semibold bg-red-100 text-red-600 rounded-full">{{ $sidebarUnreadContacts }}</span>
                                @endif
                            </a>
                        </li>

                        <!-- Product Inquiries -->
                        <li>
                            <a href="{{ route('admin.product-inquiries.index') }}"
                                class="flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg transition-all group {{ request()->routeIs('admin.product-inquiries.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                <div class="flex items-center space-x-3">
                                    <i
                                        class="fas fa-question-circle w-5 {{ request()->routeIs('admin.product-inquiries.*') ? 'text-blue-600' : 'text-gray-400' }}"></i>
                                    <span>{{ __('admin.inquiries') }}</span>
                                </div>
                                @if ($sidebarUnreadInquiries > 0)
                                    <span
                                        class="px-2 py-0.5 text-xs font-semibold bg-red-100 text-red-600 rounded-full">{{ $sidebarUnreadInquiries }}</span>
                                @endif
                            </a>
                        </li>

                        <!-- Settings & Users Group -->
                        <li x-data="{ open: @json(request()->routeIs('admin.settings.*') || request()->routeIs('admin.users.*')) }"
                            class="pt-2 mt-2 border-t border-gray-200">
                            <button @click="open = !open" type="button"
                                class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium rounded-lg transition-all group {{ request()->routeIs('admin.settings.*') || request()->routeIs('admin.users.*') ? 'bg-gray-50 text-gray-900' : 'text-gray-700 hover:bg-gray-50' }}">
                                <div class="flex items-center space-x-3">
                                    <i
                                        class="fas fa-cog w-5 {{ request()->routeIs('admin.settings.*') || request()->routeIs('admin.users.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                                    <span>{{ __('admin.settings') }}</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200"
                                    :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            <ul x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="mt-1 ml-8 space-y-1" style="display: none;">
                                <li>
                                    <a href="{{ route('admin.settings.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.settings.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.site_settings') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.users.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.users.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.users') }}
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Language Switcher -->
                        @php
                            $currentLocale = app()->getLocale();
                            $availableLocales = ['vi' => 'Tiếng Việt', 'en' => 'English', 'zh' => '中文'];
                        @endphp
                        <li class="relative pt-2 border-t border-gray-200" x-data="{ open: false }">
                            <button type="button" @click="open = !open" @click.away="open = false"
                                class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium rounded-lg transition-all text-gray-700 hover:bg-gray-50">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-globe w-5 text-gray-400"></i>
                                    <span>{{ __('common.language') }}</span>
                                </div>
                                <span class="text-xs text-gray-500">
                                    {{ $availableLocales[$currentLocale] ?? strtoupper($currentLocale) }}
                                </span>
                            </button>
                            <div x-show="open" x-transition:enter="transition ease-out duration-150"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-1"
                                class="absolute left-0 right-0 z-20 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg">
                                @foreach ($availableLocales as $code => $label)
                                    <a href="{{ url($code) }}"
                                        class="flex items-center justify-between px-3 py-2 text-sm rounded-lg transition-all {{ $currentLocale === $code ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                                        <span>{{ $label }}</span>
                                        @if ($currentLocale === $code)
                                            <i class="fas fa-check text-blue-500"></i>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </li>

                        <!-- Quick Actions -->
                        <li class="pt-4">
                            <a href="{{ route('home') }}" target="_blank"
                                class="flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-50 hover:bg-gray-100 rounded-lg transition-all group border border-gray-200">
                                <i class="fas fa-external-link-alt mr-2 text-gray-400"></i>
                                <span>{{ __('admin.view_website') }}</span>
                            </a>
                        </li>

                        <!-- Support & Help -->
                        <li>
                            <div class="px-4 py-3 bg-blue-50 rounded-lg border border-blue-100">
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-question-circle text-blue-500 mt-0.5"></i>
                                    <div>
                                        <p class="text-xs font-semibold text-gray-900 mb-1">{{ __('admin.need_help') }}</p>
                                        <p class="text-xs text-gray-600 leading-relaxed">{{ __('admin.contact_support_team') }}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Mobile Sidebar -->
        <div x-show="sidebarOpen" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-full max-w-sm bg-white border-r border-gray-200 shadow-xl transform transition-transform duration-300 ease-in-out lg:hidden"
            x-cloak>
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bolt text-white"></i>
                        </div>
                        <span class="text-lg font-bold text-gray-900">VgenTech</span>
                    </a>
                    <button @click="sidebarOpen = false" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Navigation (Mobile) -->
                <nav class="flex-1 px-4 py-6 overflow-y-auto sidebar-scroll">
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg transition-all group {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                <div class="flex items-center space-x-3">
                                    <i
                                        class="fas fa-home w-5 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-gray-400' }}"></i>
                                    <span>{{ __('admin.dashboard') }}</span>
                                </div>
                                @if ($sidebarTotalUnread > 0)
                                    <span
                                        class="px-2 py-0.5 text-xs font-semibold bg-red-100 text-red-600 rounded-full">{{ $sidebarTotalUnread }}</span>
                                @endif
                            </a>
                        </li>

                        <li x-data="{ open: @json(request()->routeIs('admin.categories.*') ||
                                request()->routeIs('admin.products.*') ||
                                request()->routeIs('admin.projects.*') ||
                                request()->routeIs('admin.posts.*') ||
                                request()->routeIs('admin.pages.*') ||
                                request()->routeIs('admin.tags.*')) }">
                            <button @click="open = !open" type="button"
                                class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium rounded-lg transition-all group {{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.products.*') || request()->routeIs('admin.projects.*') || request()->routeIs('admin.posts.*') || request()->routeIs('admin.pages.*') || request()->routeIs('admin.tags.*') ? 'bg-gray-50 text-gray-900' : 'text-gray-700 hover:bg-gray-50' }}">
                                <div class="flex items-center space-x-3">
                                    <i
                                        class="fas fa-file-alt w-5 {{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.products.*') || request()->routeIs('admin.projects.*') || request()->routeIs('admin.posts.*') || request()->routeIs('admin.pages.*') || request()->routeIs('admin.tags.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                                    <span>{{ __('admin.content') }}</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200"
                                    :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            <ul x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="mt-1 ml-8 space-y-1" style="display: none;">
                                <li>
                                    <a href="{{ route('admin.categories.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.categories.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.categories') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.products.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.products.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.products') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.projects.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.projects.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.projects') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.posts.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.posts.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.blog_posts') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.pages.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.pages.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.pages') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.tags.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.tags.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.tags') }}
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li x-data="{ open: @json(request()->routeIs('admin.banners.*') || request()->routeIs('admin.testimonials.*')) }">
                            <button @click="open = !open" type="button"
                                class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium rounded-lg transition-all group {{ request()->routeIs('admin.banners.*') || request()->routeIs('admin.testimonials.*') ? 'bg-gray-50 text-gray-900' : 'text-gray-700 hover:bg-gray-50' }}">
                                <div class="flex items-center space-x-3">
                                    <i
                                        class="fas fa-bullhorn w-5 {{ request()->routeIs('admin.banners.*') || request()->routeIs('admin.testimonials.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                                    <span>{{ __('admin.marketing') }}</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200"
                                    :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            <ul x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="mt-1 ml-8 space-y-1" style="display: none;">
                                <li>
                                    <a href="{{ route('admin.banners.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.banners.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.banners') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.testimonials.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.testimonials.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.testimonials') }}
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{ route('admin.recruitments.index') }}"
                                class="flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg transition-all group {{ request()->routeIs('admin.recruitments.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                <div class="flex items-center space-x-3">
                                    <i
                                        class="fas fa-users w-5 {{ request()->routeIs('admin.recruitments.*') ? 'text-blue-600' : 'text-gray-400' }}"></i>
                                    <span>{{ __('admin.recruitments') }}</span>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.contacts.index') }}"
                                class="flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg transition-all group {{ request()->routeIs('admin.contacts.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                <div class="flex items-center space-x-3">
                                    <i
                                        class="fas fa-envelope w-5 {{ request()->routeIs('admin.contacts.*') ? 'text-blue-600' : 'text-gray-400' }}"></i>
                                    <span>{{ __('admin.contacts') }}</span>
                                </div>
                                @if ($sidebarUnreadContacts > 0)
                                    <span
                                        class="px-2 py-0.5 text-xs font-semibold bg-red-100 text-red-600 rounded-full">{{ $sidebarUnreadContacts }}</span>
                                @endif
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.product-inquiries.index') }}"
                                class="flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg transition-all group {{ request()->routeIs('admin.product-inquiries.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                <div class="flex items-center space-x-3">
                                    <i
                                        class="fas fa-question-circle w-5 {{ request()->routeIs('admin.product-inquiries.*') ? 'text-blue-600' : 'text-gray-400' }}"></i>
                                    <span>{{ __('admin.inquiries') }}</span>
                                </div>
                                @if ($sidebarUnreadInquiries > 0)
                                    <span
                                        class="px-2 py-0.5 text-xs font-semibold bg-red-100 text-red-600 rounded-full">{{ $sidebarUnreadInquiries }}</span>
                                @endif
                            </a>
                        </li>

                        <li x-data="{ open: @json(request()->routeIs('admin.settings.*') || request()->routeIs('admin.users.*')) }"
                            class="pt-2 mt-2 border-t border-gray-200">
                            <button @click="open = !open" type="button"
                                class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium rounded-lg transition-all group {{ request()->routeIs('admin.settings.*') || request()->routeIs('admin.users.*') ? 'bg-gray-50 text-gray-900' : 'text-gray-700 hover:bg-gray-50' }}">
                                <div class="flex items-center space-x-3">
                                    <i
                                        class="fas fa-cog w-5 {{ request()->routeIs('admin.settings.*') || request()->routeIs('admin.users.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                                    <span>{{ __('admin.settings') }}</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200"
                                    :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            <ul x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="mt-1 ml-8 space-y-1" style="display: none;">
                                <li>
                                    <a href="{{ route('admin.settings.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.settings.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.site_settings') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.users.index') }}"
                                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all {{ request()->routeIs('admin.users.*') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                        {{ __('admin.users') }}
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Language Switcher (Mobile) -->
                        @php
                            $currentLocale = app()->getLocale();
                            $availableLocales = ['vi' => 'Tiếng Việt', 'en' => 'English', 'zh' => '中文'];
                        @endphp
                        <li class="relative pt-2 border-t border-gray-200" x-data="{ open: false }">
                            <button type="button" @click="open = !open" @click.away="open = false"
                                class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium rounded-lg transition-all text-gray-700 hover:bg-gray-50">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-globe w-5 text-gray-400"></i>
                                    <span>{{ __('common.language') }}</span>
                                </div>
                                <span class="text-xs text-gray-500">
                                    {{ $availableLocales[$currentLocale] ?? strtoupper($currentLocale) }}
                                </span>
                            </button>
                            <div x-show="open" x-transition:enter="transition ease-out duration-150"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-1"
                                class="absolute left-0 right-0 z-20 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg">
                                @foreach ($availableLocales as $code => $label)
                                    <a href="{{ url($code) }}"
                                        class="flex items-center justify-between px-3 py-2 text-sm rounded-lg transition-all {{ $currentLocale === $code ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                                        <span>{{ $label }}</span>
                                        @if ($currentLocale === $code)
                                            <i class="fas fa-check text-blue-500"></i>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </li>

                        <!-- Quick Actions (Mobile) -->
                        <li class="pt-4">
                            <a href="{{ route('home') }}" target="_blank"
                                class="flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-50 hover:bg-gray-100 rounded-lg transition-all border border-gray-200">
                                <i class="fas fa-external-link-alt mr-2 text-gray-400"></i>
                                <span>{{ __('admin.view_website') }}</span>
                            </a>
                        </li>
                        <li>
                            <div class="px-4 py-3 bg-blue-50 rounded-lg border border-blue-100">
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-question-circle text-blue-500 mt-0.5"></i>
                                    <div>
                                        <p class="text-xs font-semibold text-gray-900 mb-1">{{ __('admin.need_help') }}</p>
                                        <p class="text-xs text-gray-600 leading-relaxed">{{ __('admin.contact_support_team') }}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex flex-col flex-1 min-w-0 overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = true"
                            class="lg:hidden text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="ml-4 lg:ml-0 text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- User Menu -->
                        <div class="relative" x-data="{ open: false }" x-cloak>
                            <button @click="open = !open" type="button"
                                class="flex items-center max-w-xs text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center">
                                            <span
                                                class="text-white font-semibold text-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                        </div>
                                    </div>
                                    <div class="hidden md:block text-left">
                                        <p class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</p>
                                        <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                                    </div>
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 z-50"
                                style="display: none;">
                                <a href="{{ route('admin.profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user-edit mr-2"></i>{{ __('Profile') }}
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i>{{ __('admin.logout') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-100">
                <div class="px-4 sm:px-6 lg:px-8 py-8">
                    <!-- Flash Messages -->
                    @if (session('success'))
                        <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-green-400 text-xl"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-400 text-xl"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-triangle text-red-400 text-xl"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800 mb-2">
                                        {{ __('admin.errors_heading') }}</h3>
                                    <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Page Content -->
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
