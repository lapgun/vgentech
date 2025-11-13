<!-- Floating Contact Buttons -->
@php
    $contactPhone = trim((string) ($siteSettings['contact_phone'] ?? config('app.phone', '0123456789')));
    $contactZalo = trim((string) ($siteSettings['contact_zalo'] ?? ''));

    $phoneHref = null;
    if (!empty($contactPhone)) {
        $cleanPhone = preg_replace('/\D+/', '', $contactPhone);
        $phoneHref = 'tel:' . ($cleanPhone ?: $contactPhone);
    }

    $zaloUrl = null;
    $zaloSource = $contactZalo ?: $contactPhone;
    if (!empty($zaloSource)) {
        if (preg_match('/^https?:\/\//', $zaloSource)) {
            $zaloUrl = $zaloSource;
        } else {
            $cleanZalo = preg_replace('/\D+/', '', $zaloSource);
            $zaloUrl = 'https://zalo.me/' . ltrim($cleanZalo ?: $zaloSource, '+');
        }
    }
@endphp

<div class="floating-contact-buttons">
    <!-- Scroll to Top Button -->
    <button class="floating-btn scroll-top-btn" onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
        title="Lên đầu trang">
        <i class="fas fa-arrow-up"></i>
    </button>

    @if ($phoneHref)
        <!-- Phone Button -->
        <a href="{{ $phoneHref }}" class="floating-btn phone-btn" title="Gọi điện thoại">
            <i class="fas fa-phone"></i>
        </a>
    @endif

    @if ($zaloUrl)
        <!-- Zalo Button -->
        <a href="{{ $zaloUrl }}" target="_blank" class="floating-btn zalo-btn" title="Chat Zalo">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 460.1 436.6">
                <path fill="currentColor" class="st0"
                    d="M82.6 380.9c-1.8-.8-3.1-1.7-1-3.5 1.3-1 2.7-1.9 4.1-2.8 13.1-8.5 25.4-17.8 33.5-31.5 6.8-11.4 5.7-18.1-2.8-26.5C69 269.2 48.2 212.5 58.6 145.5 64.5 107.7 81.8 75 107 46.6c15.2-17.2 33.3-31.1 53.1-42.7 1.2-.7 2.9-.9 3.1-2.7-.4-1-1.1-.7-1.7-.7-33.7 0-67.4-.7-101 .2C28.3 1.7.5 26.6.6 62.3c.2 104.3 0 208.6 0 313 0 32.4 24.7 59.5 57 60.7 27.3 1.1 54.6.2 82 .1 2 .1 4 .2 6 .2H290c36 0 72 .2 108 0 33.4 0 60.5-27 60.5-60.3v-.6-58.5c0-1.4.5-2.9-.4-4.4-1.8.1-2.5 1.6-3.5 2.6-19.4 19.5-42.3 35.2-67.4 46.3-61.5 27.1-124.1 29-187.6 7.2-5.5-2-11.5-2.2-17.2-.8-8.4 2.1-16.7 4.6-25 7.1-24.4 7.6-49.3 11-74.8 6zm72.5-168.5c1.7-2.2 2.6-3.5 3.6-4.8 13.1-16.6 26.2-33.2 39.3-49.9 3.8-4.8 7.6-9.7 10-15.5 2.8-6.6-.2-12.8-7-15.2-3-.9-6.2-1.3-9.4-1.1-17.8-.1-35.7-.1-53.5 0-2.5 0-5 .3-7.4.9-5.6 1.4-9 7.1-7.6 12.8 1 3.8 4 6.8 7.8 7.7 2.4.6 4.9.9 7.4.8 10.8.1 21.7 0 32.5.1 1.2 0 2.7-.8 3.6 1-.9 1.2-1.8 2.4-2.7 3.5-15.5 19.6-30.9 39.3-46.4 58.9-3.8 4.9-5.8 10.3-3 16.3s8.5 7.1 14.3 7.5c4.6.3 9.3.1 14 .1 16.2 0 32.3.1 48.5-.1 8.6-.1 13.2-5.3 12.3-13.3-.7-6.3-5-9.6-13-9.7-14.1-.1-28.2 0-43.3 0zm116-52.6c-12.5-10.9-26.3-11.6-39.8-3.6-16.4 9.6-22.4 25.3-20.4 43.5 1.9 17 9.3 30.9 27.1 36.6 11.1 3.6 21.4 2.3 30.5-5.1 2.4-1.9 3.1-1.5 4.8.6 3.3 4.2 9 5.8 14 3.9 5-1.5 8.3-6.1 8.3-11.3.1-20 .2-40 0-60-.1-8-7.6-13.1-15.4-11.5-4.3.9-6.7 3.8-9.1 6.9zm69.3 37.1c-.4 25 20.3 43.9 46.3 41.3 23.9-2.4 39.4-20.3 38.6-45.6-.8-25-19.4-42.1-44.9-41.3-23.9.7-40.8 19.9-40 45.6zm-8.8-19.9c0-15.7.1-31.3 0-47 0-8-5.1-13-12.7-12.9-7.4.1-12.3 5.1-12.4 12.8-.1 4.7 0 9.3 0 14v79.5c0 6.2 3.8 11.6 8.8 12.9 6.9 1.9 14-2.2 15.8-9.1.3-1.2.5-2.4.4-3.7.2-15.5.1-31 .1-46.5z">
                </path>
            </svg>
        </a>
    @endif
</div>

<style>
    .floating-contact-buttons {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1050;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .floating-btn {
        width: 56px;
        height: 56px;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        cursor: pointer;
        opacity: 0;
        transform: translateX(100px);
        animation: slideIn 0.5s ease forwards;
    }

    .floating-btn:nth-child(1) {
        animation-delay: 0.1s;
    }

    .floating-btn:nth-child(2) {
        animation-delay: 0.2s;
    }

    .floating-btn:nth-child(3) {
        animation-delay: 0.3s;
    }

    @keyframes slideIn {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .floating-btn:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
    }

    .floating-btn:active {
        transform: translateY(-1px) scale(0.98);
    }

    /* Scroll to Top Button */
    .scroll-top-btn {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .scroll-top-btn i {
        font-size: 20px;
    }

    /* Phone Button */
    .phone-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .phone-btn i {
        font-size: 22px;
        animation: ring 2s ease-in-out infinite;
    }

    @keyframes ring {

        0%,
        100% {
            transform: rotate(0deg);
        }

        10%,
        30% {
            transform: rotate(-15deg);
        }

        20%,
        40% {
            transform: rotate(15deg);
        }

        50% {
            transform: rotate(0deg);
        }
    }

    /* Zalo Button */
    .zalo-btn {
        background: linear-gradient(135deg, #0068ff 0%, #0095ff 100%);
        color: white;
    }

    .zalo-btn svg {
        width: 28px;
        height: 28px;
    }

    /* Hide default scroll-to-top button from animations.js */
    .scroll-to-top {
        display: none !important;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .floating-contact-buttons {
            bottom: 15px;
            right: 15px;
            gap: 10px;
        }

        .floating-btn {
            width: 50px;
            height: 50px;
        }

        .scroll-top-btn i {
            font-size: 18px;
        }

        .phone-btn i {
            font-size: 20px;
        }

        .zalo-btn i {
            font-size: 22px;
        }
    }
</style>
