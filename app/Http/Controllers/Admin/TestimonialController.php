<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('sort_order', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_position' => 'nullable|string|max:255',
            'customer_company' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
            'sort_order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('testimonials', 'public');
            $validated['avatar'] = $path;
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', __('Testimonial created successfully.'));
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_position' => 'nullable|string|max:255',
            'customer_company' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
            'sort_order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($testimonial->avatar) {
                Storage::disk('public')->delete($testimonial->avatar);
            }
            $path = $request->file('avatar')->store('testimonials', 'public');
            $validated['avatar'] = $path;
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', __('Testimonial updated successfully.'));
    }

    public function destroy(Testimonial $testimonial)
    {
        // Delete avatar
        if ($testimonial->avatar) {
            Storage::disk('public')->delete($testimonial->avatar);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', __('Testimonial deleted successfully.'));
    }
}
