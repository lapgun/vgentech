@extends('layouts.admin')
@section('title', __('Site Settings'))
@section('page-title', __('Site Settings'))
@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">@csrf
                @method('PUT')
                <h3 class="text-lg font-semibold mb-4">{{ __('General Settings') }}</h3>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="col-span-2"><label
                            class="block text-gray-700 font-medium mb-2">{{ __('Site Name') }}</label><input type="text"
                            name="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}"
                            class="w-full px-4 py-2 border rounded-lg"></div>
                    <div class="col-span-2"><label>{{ __('Site Description') }}</label>
                        <textarea name="site_description" rows="3" class="w-full px-4 py-2 border rounded-lg">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                    </div>
                    <div class="col-span-2"><label>{{ __('Keywords') }}</label><input type="text" name="site_keywords"
                            value="{{ old('site_keywords', $settings['site_keywords'] ?? '') }}"
                            class="w-full px-4 py-2 border rounded-lg"></div>
                </div>
                <h3 class="text-lg font-semibold mb-4 mt-6">{{ __('Contact Information') }}</h3>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div><label>{{ __('Email') }}</label><input type="email" name="contact_email"
                            value="{{ old('contact_email', $settings['contact_email'] ?? '') }}"
                            class="w-full px-4 py-2 border rounded-lg"></div>
                    <div><label>{{ __('Phone') }}</label><input type="text" name="contact_phone"
                            value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}"
                            class="w-full px-4 py-2 border rounded-lg"></div>
                    <div><label>{{ __('Zalo') }}</label><input type="text" name="contact_zalo"
                            value="{{ old('contact_zalo', $settings['contact_zalo'] ?? '') }}"
                            class="w-full px-4 py-2 border rounded-lg"></div>
                    <div class="col-span-2"><label>{{ __('Address') }}</label>
                        <textarea name="contact_address" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('contact_address', $settings['contact_address'] ?? '') }}</textarea>
                    </div>
                    <div class="col-span-2"><label>{{ __('Google Map Embed URL') }}</label>
                        <textarea name="google_map_embed_url" rows="2" class="w-full px-4 py-2 border rounded-lg"
                            placeholder="https://www.google.com/maps/embed?...">{{ old('google_map_embed_url', $settings['google_map_embed_url'] ?? '') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ __('Paste the Google Maps embed URL or a full map link.') }}</p>
                    </div>
                    <div class="col-span-2">
                        <label>{{ __('Contact QR Code Image') }}</label>
                        @if (!empty($settings['contact_qr_image']))
                            <img src="{{ asset('storage/' . $settings['contact_qr_image']) }}"
                                class="h-32 mb-2 rounded border">
                        @endif
                        <input type="file" name="contact_qr_image" accept="image/*"
                            class="w-full px-4 py-2 border rounded-lg">
                        <p class="text-xs text-gray-500 mt-1">
                            {{ __('Upload a QR code image for quick contact (e.g., Zalo).') }}</p>
                    </div>
                </div>
                <h3 class="text-lg font-semibold mb-4 mt-6">{{ __('Social Media') }}</h3>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div><label>{{ __('Facebook') }}</label><input type="url" name="facebook_url"
                            value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}"
                            class="w-full px-4 py-2 border rounded-lg"></div>
                    <div><label>{{ __('Twitter') }}</label><input type="url" name="twitter_url"
                            value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}"
                            class="w-full px-4 py-2 border rounded-lg"></div>
                    <div><label>{{ __('LinkedIn') }}</label><input type="url" name="linkedin_url"
                            value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}"
                            class="w-full px-4 py-2 border rounded-lg"></div>
                    <div><label>{{ __('Instagram') }}</label><input type="url" name="instagram_url"
                            value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}"
                            class="w-full px-4 py-2 border rounded-lg"></div>
                </div>
                <h3 class="text-lg font-semibold mb-4 mt-6">{{ __('Homepage - About Section') }}</h3>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="col-span-2">
                        <label>{{ __('Title') }}</label>
                        <input type="text" name="home_about_title"
                            value="{{ old('home_about_title', $settings['home_about_title'] ?? '') }}"
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    <div class="col-span-2">
                        <label>{{ __('Intro Text') }}</label>
                        <textarea name="home_about_lead" rows="3" class="w-full px-4 py-2 border rounded-lg">{{ old('home_about_lead', $settings['home_about_lead'] ?? '') }}</textarea>
                    </div>
                    <div class="col-span-2">
                        <label>{{ __('Description') }}</label>
                        <textarea name="home_about_description" rows="4" class="w-full px-4 py-2 border rounded-lg">{{ old('home_about_description', $settings['home_about_description'] ?? '') }}</textarea>
                    </div>
                    <div>
                        <label>{{ __('Years of Experience') }}</label>
                        <input type="number" min="0" name="home_about_years"
                            value="{{ old('home_about_years', $settings['home_about_years'] ?? '') }}"
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label>{{ __('Happy Customers Count') }}</label>
                        <input type="number" min="0" name="home_about_clients"
                            value="{{ old('home_about_clients', $settings['home_about_clients'] ?? '') }}"
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    <div class="col-span-2">
                        <label>{{ __('Featured Image') }}</label>
                        @if (!empty($settings['home_about_image']))
                            <img src="{{ asset('storage/' . $settings['home_about_image']) }}" class="h-32 mb-2 rounded">
                        @endif
                        <input type="file" name="home_about_image" accept="image/*"
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>
                </div>
                <h3 class="text-lg font-semibold mb-4 mt-6">{{ __('Branding') }}</h3>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div><label>{{ __('Logo') }}</label>
                        @if (isset($settings['site_logo']))
                            <img src="{{ asset('storage/' . $settings['site_logo']) }}" class="h-16 mb-2">
                        @endif
                        <input type="file" name="site_logo" accept="image/*"
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    <div><label>{{ __('Favicon') }}</label>
                        @if (isset($settings['site_favicon']))
                            <img src="{{ asset('storage/' . $settings['site_favicon']) }}" class="h-8 mb-2">
                        @endif
                        <input type="file" name="site_favicon" accept="image/*"
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>
                </div>
                <div class="flex justify-end"><button type="submit"
                        class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">{{ __('Save Settings') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
