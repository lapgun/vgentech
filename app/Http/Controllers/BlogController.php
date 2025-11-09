<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display blog listing
     */
    public function index(Request $request)
    {
        $query = Post::with(['author', 'category', 'tags'])
            ->published();

        // Filter by tag
        if ($request->has('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        // Search by keyword
        if ($request->has('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('excerpt', 'like', "%{$keyword}%")
                    ->orWhere('content', 'like', "%{$keyword}%");
            });
        }

        $posts = $query->orderBy('published_at', 'desc')
            ->paginate(10);

        // Get all tags for filter
        $tags = Tag::withCount('posts')
            ->orderBy('name')
            ->get();

        // Get categories for sidebar
        $categories = \App\Models\Category::where('type', 'post')
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        // Get featured posts for sidebar
        $featuredPosts = Post::published()
            ->featured()
            ->take(5)
            ->get();

        return view('blog.index', compact('posts', 'tags', 'categories', 'featuredPosts'));
    }

    /**
     * Display blog post detail
     */
    public function show($slug)
    {
        $post = Post::with(['author', 'category', 'tags'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Increment view count
        $post->increment('view_count');

        // Get related posts (same tags)
        $relatedPosts = Post::with(['author', 'tags'])
            ->whereHas('tags', function ($q) use ($post) {
                $q->whereIn('tags.id', $post->tags->pluck('id'));
            })
            ->where('id', '!=', $post->id)
            ->published()
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }
}
