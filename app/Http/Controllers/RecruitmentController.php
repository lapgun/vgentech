<?php

namespace App\Http\Controllers;

use App\Models\Recruitment;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
            'cover_letter' => 'nullable|string|max:2000',
        ]);

        // Handle CV file upload
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
            $validated['cv'] = $cvPath;
        }

        // Store application data
        $application = JobApplication::create([
            'recruitment_id' => $job->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'cv_file' => $validated['cv'] ?? null,
            'cover_letter' => $validated['cover_letter'] ?? null,
        ]);

        // Send email to HR
        try {
            Mail::send('emails.hr_application', [
                'job' => $job,
                'application' => $application
            ], function ($message) use ($job, $application) {
                $message->to(config('mail.hr_address', config('mail.from.address')))
                    ->subject('New Job Application: ' . $job->title);
                if ($application->cv_file) {
                    $message->attach(storage_path('app/public/' . $application->cv_file));
                }
            });
        } catch (\Exception $e) {
            // Log or handle email error if needed
            Log::error('Failed to send job application email: ' . $e->getMessage());
        }

        return redirect()
            ->route('recruitment.show', $slug)
            ->with('success', __('common.application_submitted'));
    }
}
