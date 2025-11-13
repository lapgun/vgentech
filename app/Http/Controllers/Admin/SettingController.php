<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_description' => 'nullable|string',
            'site_keywords' => 'nullable|string',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'contact_zalo' => 'nullable|string|max:50',
            'contact_address' => 'nullable|string',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'google_map_embed_url' => 'nullable|string|max:2048',
            'contact_qr_image' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'site_logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:1024',
            'site_favicon' => 'nullable|image|mimes:png,jpg,jpeg,ico|max:512',
            'footer_text' => 'nullable|string',
            'google_analytics' => 'nullable|string',
            'home_about_title' => 'nullable|string|max:255',
            'home_about_lead' => 'nullable|string',
            'home_about_description' => 'nullable|string',
            'home_about_years' => 'nullable|integer|min:0',
            'home_about_clients' => 'nullable|integer|min:0',
            'home_about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        // Handle logo upload
        if ($request->hasFile('site_logo')) {
            $oldLogo = Setting::where('key', 'site_logo')->first();
            if ($oldLogo && $oldLogo->value) {
                Storage::disk('public')->delete($oldLogo->value);
            }
            $path = $request->file('site_logo')->store('settings', 'public');
            $validated['site_logo'] = $path;
        }

        // Handle favicon upload
        if ($request->hasFile('site_favicon')) {
            $oldFavicon = Setting::where('key', 'site_favicon')->first();
            if ($oldFavicon && $oldFavicon->value) {
                Storage::disk('public')->delete($oldFavicon->value);
            }
            $path = $request->file('site_favicon')->store('settings', 'public');
            $validated['site_favicon'] = $path;
        }

        // Handle home about image
        if ($request->hasFile('home_about_image')) {
            $oldImage = Setting::where('key', 'home_about_image')->first();
            if ($oldImage && $oldImage->value) {
                Storage::disk('public')->delete($oldImage->value);
            }
            $path = $request->file('home_about_image')->store('settings', 'public');
            $validated['home_about_image'] = $path;
        }

        if ($request->hasFile('contact_qr_image')) {
            $oldQr = Setting::where('key', 'contact_qr_image')->first();
            if ($oldQr && $oldQr->value) {
                Storage::disk('public')->delete($oldQr->value);
            }
            $path = $request->file('contact_qr_image')->store('settings', 'public');
            $validated['contact_qr_image'] = $path;
        }

        // Update or create settings
        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Cache::forget('site.settings');

        return redirect()->route('admin.settings.index')
            ->with('success', __('Settings updated successfully.'));
    }
}
