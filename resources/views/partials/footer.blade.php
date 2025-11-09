<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- Company Info -->
            <div class="col-md-4 mb-4">
                <h5><i class="fas fa-bolt"></i> VgenTech</h5>
                <p>Chuyên cung cấp máy phát điện Cummins, Doosan, VMAN chính hãng với chất lượng cao và dịch vụ tốt nhất.</p>
                <div class="social-links mt-3">
                    @php
                        $facebook = \App\Models\Setting::get('facebook_url');
                        $youtube = \App\Models\Setting::get('youtube_url');
                        $linkedin = \App\Models\Setting::get('linkedin_url');
                    @endphp
                    
                    @if($facebook)
                        <a href="{{ $facebook }}" target="_blank" class="me-3"><i class="fab fa-facebook fa-2x"></i></a>
                    @endif
                    @if($youtube)
                        <a href="{{ $youtube }}" target="_blank" class="me-3"><i class="fab fa-youtube fa-2x"></i></a>
                    @endif
                    @if($linkedin)
                        <a href="{{ $linkedin }}" target="_blank" class="me-3"><i class="fab fa-linkedin fa-2x"></i></a>
                    @endif
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="col-md-2 mb-4">
                <h5>{{ __('common.quick_links') }}</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('home') }}"><i class="fas fa-angle-right"></i> {{ __('common.home') }}</a></li>
                    <li class="mb-2"><a href="{{ route('about') }}"><i class="fas fa-angle-right"></i> {{ __('common.about') }}</a></li>
                    <li class="mb-2"><a href="{{ route('products.index') }}"><i class="fas fa-angle-right"></i> {{ __('common.products') }}</a></li>
                    <li class="mb-2"><a href="{{ route('projects.index') }}"><i class="fas fa-angle-right"></i> {{ __('common.projects') }}</a></li>
                    <li class="mb-2"><a href="{{ route('contact') }}"><i class="fas fa-angle-right"></i> {{ __('common.contact') }}</a></li>
                </ul>
            </div>
            
            <!-- Product Categories -->
            <div class="col-md-3 mb-4">
                <h5>{{ __('common.products') }}</h5>
                <ul class="list-unstyled">
                    @php
                        $footerCategories = \App\Models\Category::root()->active()->take(5)->get();
                    @endphp
                    @foreach($footerCategories as $category)
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
                        $phone = \App\Models\Setting::get('contact_phone');
                        $email = \App\Models\Setting::get('contact_email');
                        $address = \App\Models\Setting::get('contact_address');
                    @endphp
                    
                    @if($address)
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt"></i> {{ $address }}
                        </li>
                    @endif
                    @if($phone)
                        <li class="mb-2">
                            <i class="fas fa-phone"></i> <a href="tel:{{ $phone }}">{{ $phone }}</a>
                        </li>
                    @endif
                    @if($email)
                        <li class="mb-2">
                            <i class="fas fa-envelope"></i> <a href="mailto:{{ $email }}">{{ $email }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        
        <!-- Google Map Section -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h5 class="mb-3"><i class="fas fa-map-marked-alt"></i> {{ __('common.location_map') }}</h5>
                <div class="map-container">
                    @php
                        $mapUrl = \App\Models\Setting::get('google_map_embed_url') ?? 
                                  'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.863592744892!2d105.78466897503201!3d21.037499780613943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4cd0c66f05%3A0x85b098f35422f299!2zVmnhu4d0IFnDqm4sIE5nxakgSGnhu4dwLCBUaGFuaCBUcsOsLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1699520000000!5m2!1svi!2s';
                    @endphp
                    <iframe 
                        src="{{ $mapUrl }}" 
                        width="100%" 
                        height="300" 
                        style="border:0; border-radius: 10px;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
        
        <hr class="my-4" style="border-color: rgba(255,255,255,0.1)">
        
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="mb-0">
                    @php
                        $copyright = \App\Models\Setting::get('footer_copyright') ?? '© ' . date('Y') . ' VgenTech. All rights reserved.';
                    @endphp
                    {{ $copyright }}
                </p>
            </div>
        </div>
    </div>
</footer>
