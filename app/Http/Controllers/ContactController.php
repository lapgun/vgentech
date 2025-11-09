<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display contact page
     */
    public function index()
    {
        // Get contact information from settings
        $contactInfo = [
            'phone' => Setting::get('contact_phone'),
            'email' => Setting::get('contact_email'),
            'address' => Setting::get('contact_address'),
            'facebook' => Setting::get('facebook_url'),
            'youtube' => Setting::get('youtube_url'),
            'linkedin' => Setting::get('linkedin_url'),
        ];

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
