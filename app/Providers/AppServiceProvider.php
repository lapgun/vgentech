<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        $settings = Cache::remember('site.settings', now()->addMinutes(10), function () {
            return Setting::all()->pluck('value', 'key')->toArray();
        });

        $settings['site_name'] = $settings['site_name'] ?? 'VgenTech';
        $settings['site_description'] = $settings['site_description'] ?? 'Cung cấp máy phát điện Cummins, Doosan, VMAN chính hãng, giá tốt';
        $settings['site_keywords'] = $settings['site_keywords'] ?? 'máy phát điện, cummins, doosan, vman';
    $settings['contact_phone'] = $settings['contact_phone'] ?? config('app.phone', '0123456789');
    $settings['contact_zalo'] = $settings['contact_zalo'] ?? ($settings['contact_phone'] ?? config('app.zalo', '0123456789'));
    $settings['google_map_embed_url'] = $settings['google_map_embed_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.863592744892!2d105.78466897503201!3d21.037499780613943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4cd0c66f05%3A0x85b098f35422f299!2zVmnhu4d0IFnDqm4sIE5nxakgSGnhu4dwLCBUaGFuaCBUcsOsLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1699520000000!5m2!1svi!2s';
    $settings['contact_qr_image_url'] = $this->resolveMediaUrl($settings['contact_qr_image'] ?? null);

        $settings['site_logo_url'] = $this->resolveMediaUrl($settings['site_logo'] ?? null);
        $settings['site_favicon_url'] = $this->resolveMediaUrl($settings['site_favicon'] ?? null);
        $settings['home_about_image_url'] = $this->resolveMediaUrl($settings['home_about_image'] ?? null);

        View::share('siteSettings', $settings);
    }

    /**
     * Convert a stored path or URL to a publicly accessible URL.
     */
    protected function resolveMediaUrl(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }

        if (Str::startsWith($value, ['http://', 'https://', 'data:'])) {
            return $value;
        }

        return asset('storage/' . ltrim($value, '/'));
    }
}
