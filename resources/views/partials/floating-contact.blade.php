<!-- Floating Contact Buttons -->
<div class="floating-contact-buttons">
    <!-- Scroll to Top Button -->
    <button class="floating-btn scroll-top-btn" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" title="Lên đầu trang">
        <i class="fas fa-arrow-up"></i>
    </button>
    
    <!-- Phone Button -->
    <a href="tel:{{ config('app.phone', '0123456789') }}" class="floating-btn phone-btn" title="Gọi điện thoại">
        <i class="fas fa-phone"></i>
    </a>
    
    <!-- Zalo Button -->
    <a href="https://zalo.me/{{ config('app.zalo', '0123456789') }}" target="_blank" class="floating-btn zalo-btn" title="Chat Zalo">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="28px" height="28px">
            <path fill="#fff" d="M15,36V6.827l-1.211-0.811C8.64,8.083,5,13.112,5,19v10c0,7.732,6.268,14,14,14h10c4.722,0,8.883-2.348,11.417-5.931V36H15z"/>
            <path fill="#fff" d="M29,5H19c-1.845,0-3.601,0.366-5.214,1.014C10.453,9.25,8,14.528,8,19c0,6.771,0.936,10.735,3.712,14.607c0.216,0.301,0.357,0.653,0.376,1.022c0.043,0.835-0.129,2.365-1.634,3.742c-0.162,0.148-0.059,0.419,0.16,0.428c0.942,0.041,2.843-0.014,4.797-0.877c0.557-0.246,1.191-0.203,1.729,0.083C20.453,39.764,24.333,40,28,40c4.676,0,9.339-1.04,12.417-2.916C42.038,34.799,43,32.014,43,29V19C43,11.268,36.732,5,29,5z"/>
            <path fill="#2962ff" d="M36.75,27C34.683,27,33,25.317,33,23.25s1.683-3.75,3.75-3.75s3.75,1.683,3.75,3.75S38.817,27,36.75,27z M36.75,21c-1.24,0-2.25,1.01-2.25,2.25s1.01,2.25,2.25,2.25S39,24.49,39,23.25S37.99,21,36.75,21z"/>
            <path fill="#2962ff" d="M31.5,27h-1c-0.276,0-0.5-0.224-0.5-0.5V18c0-0.276,0.224-0.5,0.5-0.5h1c0.276,0,0.5,0.224,0.5,0.5v8.5C32,26.776,31.776,27,31.5,27z"/>
            <path fill="#2962ff" d="M27,19.75v0.519c-0.629-0.476-1.403-0.769-2.25-0.769c-2.067,0-3.75,1.683-3.75,3.75S22.683,27,24.75,27c0.847,0,1.621-0.293,2.25-0.769V26.5c0,0.276,0.224,0.5,0.5,0.5h1c0.276,0,0.5-0.224,0.5-0.5v-6.75c0-0.276-0.224-0.5-0.5-0.5h-1C27.224,19.25,27,19.474,27,19.75z M24.75,25.5c-1.24,0-2.25-1.01-2.25-2.25S23.51,21,24.75,21S27,22.01,27,23.25S25.99,25.5,24.75,25.5z"/>
            <path fill="#2962ff" d="M13.5,27c-1.933,0-3.5-1.567-3.5-3.5c0-0.276,0.224-0.5,0.5-0.5h1c0.276,0,0.5,0.224,0.5,0.5c0,0.827,0.673,1.5,1.5,1.5s1.5-0.673,1.5-1.5c0-0.403-0.156-0.778-0.438-1.056c-0.281-0.281-0.656-0.438-1.056-0.438c-0.827,0-1.5-0.673-1.5-1.5s0.673-1.5,1.5-1.5s1.5,0.673,1.5,1.5c0,0.276,0.224,0.5,0.5,0.5h1c0.276,0,0.5-0.224,0.5-0.5c0-1.933-1.567-3.5-3.5-3.5S10,17.567,10,19.5c0,1.933,1.567,3.5,3.5,3.5c0.276,0,0.5,0.224,0.5,0.5s-0.224,0.5-0.5,0.5c-0.276,0-0.5,0.224-0.5,0.5S13.224,25,13.5,25s0.5-0.224,0.5-0.5c0-0.276,0.224-0.5,0.5-0.5h1c0.276,0,0.5,0.224,0.5,0.5C16,25.433,14.933,27,13.5,27z"/>
        </svg>
    </a>
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

.floating-btn:nth-child(1) { animation-delay: 0.1s; }
.floating-btn:nth-child(2) { animation-delay: 0.2s; }
.floating-btn:nth-child(3) { animation-delay: 0.3s; }

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
    0%, 100% { transform: rotate(0deg); }
    10%, 30% { transform: rotate(-15deg); }
    20%, 40% { transform: rotate(15deg); }
    50% { transform: rotate(0deg); }
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
