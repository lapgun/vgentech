<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display project listing
     */
    public function index(Request $request)
    {
        $query = Project::with('images')
            ->active();

        // Search by keyword
        if ($request->has('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhere('client_name', 'like', "%{$keyword}%");
            });
        }

        $projects = $query->orderBy('project_date', 'desc')
            ->paginate(9);

        return view('projects.index', compact('projects'));
    }

    /**
     * Display project detail
     */
    public function show($slug)
    {
        $project = Project::with('images')
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Increment view count
        $project->increment('view_count');

        // Get related projects
        $relatedProjects = Project::where('id', '!=', $project->id)
            ->active()
            ->take(3)
            ->get();

        return view('projects.show', compact('project', 'relatedProjects'));
    }
}
