<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RecruitmentController extends Controller
{
    public function index()
    {
        $recruitments = Recruitment::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.recruitments.index', compact('recruitments'));
    }

    public function create()
    {
        return view('admin.recruitments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:recruitments',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'salary_range' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:100',
            'deadline' => 'nullable|date',
            'contact_email' => 'nullable|email|max:255',
            'is_active' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        Recruitment::create($validated);

        return redirect()->route('admin.recruitments.index')
            ->with('success', __('Recruitment created successfully.'));
    }

    public function edit(Recruitment $recruitment)
    {
        return view('admin.recruitments.edit', compact('recruitment'));
    }

    public function update(Request $request, Recruitment $recruitment)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:recruitments,slug,' . $recruitment->id,
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'salary_range' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:100',
            'deadline' => 'nullable|date',
            'contact_email' => 'nullable|email|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $recruitment->update($validated);

        return redirect()->route('admin.recruitments.index')
            ->with('success', __('Recruitment updated successfully.'));
    }

    public function destroy(Recruitment $recruitment)
    {
        $recruitment->delete();

        return redirect()->route('admin.recruitments.index')
            ->with('success', __('Recruitment deleted successfully.'));
    }
}
