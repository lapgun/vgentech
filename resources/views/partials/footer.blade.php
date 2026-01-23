<footer class="footer footer-hero">
    @php
        $siteName = $siteSettings['site_name'] ?? 'VgenTech';
        $hasLogo = !empty($siteSettings['site_logo_url']);
        $tagline = $siteSettings['site_tagline'] ?? __('common.power_solution_partner');
        $businessPhone = $siteSettings['business_phone'] ?? ($siteSettings['contact_phone'] ?? '0983 933 933');
        $technicalPhone = $siteSettings['technical_phone'] ?? ($siteSettings['contact_phone'] ?? '090 467 4466');
        $officePhone = $siteSettings['office_phone'] ?? ($siteSettings['contact_phone'] ?? '024 7300 1080');
        $officeHours = $siteSettings['office_hours'] ?? '08h - 17h';
        $vpAddress = $siteSettings['contact_address'] ?? __('common.contact_info');
        $factoryAddress = $siteSettings['factory_address'] ?? ($siteSettings['contact_address'] ?? null);
        $hotline = $siteSettings['contact_phone'] ?? null;
        $email = $siteSettings['contact_email'] ?? null;
        $facebook = $siteSettings['facebook_url'] ?? null;
        $youtube = $siteSettings['youtube_url'] ?? null;
        $linkedin = $siteSettings['linkedin_url'] ?? null;
        $instagram = $siteSettings['instagram_url'] ?? null;
        $mapUrl =
            $siteSettings['google_map_embed_url'] ??
            'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.863592744892!2d105.78466897503201!3d21.037499780613943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4cd0c66f05%3A0x85b098f35422f299!2zVmnhu4d0IFnDqm4sIE5nxakgSGnhu4dwLCBUaGFuaCBUcsOsLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1699520000000!5m2!1svi!2s';
        $qrUrl = $siteSettings['contact_qr_image_url'] ?? null;
    @endphp

    <div class="footer-overlay"></div>

    <div class="container position-relative">
        <div class="footer-topline">
            <div class="footer-chip">
                <div class="footer-chip-icon bg-warning text-primary"><i class="fas fa-headset"></i></div>
                <div class="footer-chip-body">
                    <div class="footer-chip-title">{{ __('common.business_support_247') }}</div>
                    <a href="tel:{{ $businessPhone }}" class="footer-chip-value">{{ $businessPhone }}</a>
                </div>
            </div>
            <div class="footer-chip">
                <div class="footer-chip-icon bg-info text-white"><i class="fas fa-tools"></i></div>
                <div class="footer-chip-body">
                    <div class="footer-chip-title">{{ __('common.technical_support_247') }}</div>
                    <a href="tel:{{ $technicalPhone }}" class="footer-chip-value">{{ $technicalPhone }}</a>
                </div>
            </div>
            <div class="footer-chip">
                <div class="footer-chip-icon bg-primary text-white"><i class="fas fa-building"></i></div>
                <div class="footer-chip-body">
                    <div class="footer-chip-title">{{ __('common.office_hours_label', ['hours' => $officeHours]) }}</div>
                    <a href="tel:{{ $officePhone }}" class="footer-chip-value">{{ $officePhone }}</a>
                </div>
            </div>
        </div>

        <div class="row g-4 align-items-start footer-main">
            <div class="col-lg-4">
                <div class="font-semibold text-xl my-3">{{ __('common.company_name_full') }}</div>
                <div class="footer-contact-grid single-column">
                    <div class="footer-contact-item">
                        <span class="label">{{ __('common.office_abbr') }}:</span>
                        <span class="value">{{ $vpAddress }}</span>
                    </div>
                    @if ($factoryAddress)
                        <div class="footer-contact-item">
                            <span class="label">{{ __('common.factory') }}:</span>
                            <span class="value">{{ $factoryAddress }}</span>
                        </div>
                    @endif
                    @if ($hotline)
                        <div class="footer-contact-item">
                            <span class="label">{{ __('common.phone') }}:</span>
                            <a href="tel:{{ $hotline }}" class="value">{{ $hotline }}</a>
                        </div>
                    @endif
                    @if ($email)
                        <div class="footer-contact-item">
                            <span class="label">{{ __('common.email') }}:</span>
                            <a href="mailto:{{ $email }}" class="value">{{ $email }}</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-4">
                <div class="footer-qr-only h-100 d-flex align-items-center justify-content-center">
                    @if ($qrUrl)
                        <div class="footer-qr-box">
                            <img src="{{ $qrUrl }}" alt="QR" class="img-fluid">
                        </div>
                    @endif
                </div>
            </div>

            @if ($mapUrl)
            <div class="col-lg-4">
                <div class="footer-map-compact h-100">
                    <iframe src="{{ $mapUrl }}" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            @endif
        </div>

        <div class="footer-bottom mt-4 pt-3">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                @php
                    $defaultCopyright =
                        '© ' .
                        date('Y') .
                        ' ' .
                        ($siteSettings['site_name'] ?? 'VgenTech') .
                        '. All rights reserved.';
                    $copyright = $siteSettings['footer_copyright'] ?? $defaultCopyright;
                @endphp
                <p class="mb-0 text-white-50">{{ $copyright }}</p>
                <div class="footer-social">
                    @if ($facebook)
                        <a href="{{ $facebook }}" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if ($youtube)
                        <a href="{{ $youtube }}" target="_blank" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    @endif
                    @if ($linkedin)
                        <a href="{{ $linkedin }}" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if ($instagram)
                        <a href="{{ $instagram }}" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>
