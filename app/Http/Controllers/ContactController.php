<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    /**
     * Display contact page
     */
    public function index()
    {
        // Get contact information from cached settings (shared via AppServiceProvider)
        // Using view-shared $siteSettings instead of individual Setting::get() calls
        $contactInfo = [
            'phone' => session('siteSettings.contact_phone', config('app.phone', '0123456789')),
            'email' => session('siteSettings.contact_email', config('app.email')),
            'address' => session('siteSettings.contact_address', ''),
            'facebook' => session('siteSettings.facebook_url', ''),
            'youtube' => session('siteSettings.youtube_url', ''),
            'linkedin' => session('siteSettings.linkedin_url', ''),
            'map_url' => session('siteSettings.google_map_embed_url', ''),
            'qr_url' => null,
        ];

        $qrPath = session('siteSettings.contact_qr_image_url');
        if (!empty($qrPath)) {
            $contactInfo['qr_url'] = $qrPath;
        }

        return view('contact', compact('contactInfo'));
    }

    /**
     * Store contact form submission
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'required|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'],
            'subject' => $validated['subject'] ?? __('Contact from website'),
            'message' => $validated['message'],
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', __('Thank you for contacting us. We will respond as soon as possible.'));
    }
}
