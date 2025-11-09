<?php

namespace App\Http\Controllers;

use App\Models\Recruitment;
use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    /**
     * Display recruitment listing
     */
    public function index(Request $request)
    {
        $query = Recruitment::active();

        // Search by keyword
        if ($request->has('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('location', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        $recruitments = $query->orderBy('deadline', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('recruitment.index', ['jobs' => $recruitments]);
    }

    /**
     * Display recruitment detail
     */
    public function show($slug)
    {
        $job = Recruitment::where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Increment view count
        $job->increment('view_count');

        // Get other job openings
        $otherJobs = Recruitment::where('id', '!=', $job->id)
            ->active()
            ->take(5)
            ->get();

        return view('recruitment.show', compact('job', 'otherJobs'));
    }

    /**
     * Handle job application submission
     */
    public function apply(Request $request, $slug)
    {
        $job = Recruitment::where('slug', $slug)
            ->active()
            ->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'cv_file' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
            'cover_letter' => 'nullable|string|max:2000',
        ]);

        // Handle CV file upload
        if ($request->hasFile('cv_file')) {
            $cvPath = $request->file('cv_file')->store('cvs', 'public');
            $validated['cv_file'] = $cvPath;
        }

        // Store application data (you can create a JobApplication model later)
        // For now, we'll just send email notification
        
        // TODO: Send email to HR
        // TODO: Store in database if needed

        return redirect()
            ->route('recruitment.show', $slug)
            ->with('success', __('common.application_submitted'));
    }
}
