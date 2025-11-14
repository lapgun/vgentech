<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- Company Info -->
            <div class="col-md-4 mb-4">
                @php
                    $siteName = $siteSettings['site_name'] ?? 'VgenTech';
                    $hasLogo = !empty($siteSettings['site_logo_url']);
                @endphp
                <div class="mb-4">
                    <div class="d-inline-flex align-items-center gap-3 px-3 py-2 rounded-4 border border-white border-opacity-10"
                        style="background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(6px);">
                        <span
                            class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning text-primary"
                            style="width: 44px; height: 44px;">
                            <i class="fas fa-bolt"></i>
                        </span>
                        <div class="d-flex flex-column">
                            <span class="text-uppercase fw-semibold text-white">{{ $siteName }}</span>
                            <span
                                class="text-white-50 small">{{ $siteSettings['site_tagline'] ?? __('common.power_solution_partner') }}</span>
                        </div>
                    </div>
                </div>
                <p>{{ $siteSettings['site_description'] ?? 'Chuyên cung cấp máy phát điện Cummins, Doosan, VMAN chính hãng với chất lượng cao và dịch vụ tốt nhất.' }}
                </p>
                <div class="social-links mt-3">
                    @php
                        $facebook = $siteSettings['facebook_url'] ?? null;
                        $youtube = $siteSettings['youtube_url'] ?? null;
                        $linkedin = $siteSettings['linkedin_url'] ?? null;
                        $instagram = $siteSettings['instagram_url'] ?? null;
                    @endphp

                    @if ($facebook)
                        <a href="{{ $facebook }}" target="_blank" class="me-3"><i
                                class="fab fa-facebook fa-2x"></i></a>
                    @endif
                    @if ($youtube)
                        <a href="{{ $youtube }}" target="_blank" class="me-3"><i
                                class="fab fa-youtube fa-2x"></i></a>
                    @endif
                    @if ($linkedin)
                        <a href="{{ $linkedin }}" target="_blank" class="me-3"><i
                                class="fab fa-linkedin fa-2x"></i></a>
                    @endif
                    @if ($instagram)
                        <a href="{{ $instagram }}" target="_blank" class="me-3"><i
                                class="fab fa-instagram fa-2x"></i></a>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-2 mb-4">
                <h5>{{ __('common.quick_links') }}</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('home') }}"><i class="fas fa-angle-right"></i>
                            {{ __('common.home') }}</a></li>
                    <li class="mb-2"><a href="{{ route('about') }}"><i class="fas fa-angle-right"></i>
                            {{ __('common.about') }}</a></li>
                    <li class="mb-2"><a href="{{ route('products.index') }}"><i class="fas fa-angle-right"></i>
                            {{ __('common.products') }}</a></li>
                    <li class="mb-2"><a href="{{ route('projects.index') }}"><i class="fas fa-angle-right"></i>
                            {{ __('common.projects') }}</a></li>
                    <li class="mb-2"><a href="{{ route('contact') }}"><i class="fas fa-angle-right"></i>
                            {{ __('common.contact') }}</a></li>
                </ul>
            </div>

            <!-- Product Categories -->
            <div class="col-md-3 mb-4">
                <h5>{{ __('common.products') }}</h5>
                <ul class="list-unstyled">
                    @php
                        $footerCategories = \App\Models\Category::root()->active()->take(5)->get();
                    @endphp
                    @foreach ($footerCategories as $category)
                        <li class="mb-2">
                            <a href="{{ route('products.index', ['category' => $category->slug]) }}">
                                <i class="fas fa-angle-right"></i> {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-md-3 mb-4">
                <h5>{{ __('common.contact_info') }}</h5>
                <ul class="list-unstyled">
                    @php
                        $phone = $siteSettings['contact_phone'] ?? null;
                        $email = $siteSettings['contact_email'] ?? null;
                        $address = $siteSettings['contact_address'] ?? null;
                    @endphp

                    @if ($address)
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt"></i> {{ $address }}
                        </li>
                    @endif
                    @if ($phone)
                        <li class="mb-2">
                            <i class="fas fa-phone"></i> <a href="tel:{{ $phone }}">{{ $phone }}</a>
                        </li>
                    @endif
                    @if ($email)
                        <li class="mb-2">
                            <i class="fas fa-envelope"></i> <a
                                href="mailto:{{ $email }}">{{ $email }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        @php
            $mapUrl =
                $siteSettings['google_map_embed_url'] ??
                'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.863592744892!2d105.78466897503201!3d21.037499780613943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4cd0c66f05%3A0x85b098f35422f299!2zVmnhu4d0IFnDqm4sIE5nxakgSGnhu4dwLCBUaGFuaCBUcsOsLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1699520000000!5m2!1svi!2s';
            $qrUrl = $siteSettings['contact_qr_image_url'] ?? null;
        @endphp

        @if ($mapUrl || $qrUrl)
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div
                            class="card-header card-header-gradient text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-map-marked-alt"></i> {{ __('common.location_map') }}
                            </h5>
                            @if ($qrUrl)
                                <span class="text-sm text-white-50">{{ __('common.scan_qr_to_connect') }}</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row g-4 align-items-stretch">
                                @if ($qrUrl)
                                    <div class="col-md-4 col-lg-3 d-flex">
                                        <div
                                            class="bg-white rounded w-100 h-100 p-3 d-flex flex-column justify-content-center align-items-center shadow-sm">
                                            <img src="{{ $qrUrl }}" alt="{{ __('common.contact_qr_code') }}"
                                                class="img-fluid" style="max-height: 260px;">
                                            <p class="mt-3 mb-0 text-muted small text-center">
                                                {{ __('common.scan_qr_to_connect') }}</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="{{ $qrUrl ? 'col-md-8 col-lg-9' : 'col-12' }} d-flex">
                                    <div class="w-100 h-100">
                                        <iframe src="{{ $mapUrl }}" class="w-100 h-100 rounded-3 border-0"
                                            style="min-height: 260px;" allowfullscreen="" loading="lazy"
                                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <hr class="my-4" style="border-color: rgba(255,255,255,0.1)">

        <div class="row">
            <div class="col-md-12 text-center">
                <p class="mb-0">
                    @php
                        $defaultCopyright =
                            '© ' .
                            date('Y') .
                            ' ' .
                            ($siteSettings['site_name'] ?? 'VgenTech') .
                            '. All rights reserved.';
                        $copyright = $siteSettings['footer_copyright'] ?? $defaultCopyright;
                    @endphp
                    {{ $copyright }}
                </p>
            </div>
        </div>
    </div>
</footer>
