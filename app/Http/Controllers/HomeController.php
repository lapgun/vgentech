<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Project;
use App\Models\Post;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get active banners for homepage slider
        $banners = Banner::active()
            ->position('home_slider')
            ->orderBy('sort_order')
            ->get();

        // Get featured products
        $featuredProducts = Product::with('category')
            ->active()
            ->featured()
            ->orderBy('sort_order')
            ->take(12)
            ->get();

        // Get featured projects
        $featuredProjects = Project::active()
            ->featured()
            ->orderBy('project_date', 'desc')
            ->take(9)
            ->get();

        // Get latest blog posts
        $latestPosts = Post::with(['author', 'tags'])
            ->published()
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();

        // Get testimonials
        $testimonials = Testimonial::active()
            ->orderBy('sort_order')
            ->get();

        // Get main categories for menu
        $categories = Category::with('children')
            ->root()
            ->active()
            ->orderBy('sort_order')
            ->get();

        return view('home', compact(
            'banners',
            'featuredProducts',
            'featuredProjects',
            'latestPosts',
            'testimonials',
            'categories'
        ));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $type = $request->input('type');

        if (empty($query)) {
            return redirect()->back()->with('error', __('common.search_empty'));
        }

        $results = [
            'products' => collect(),
            'projects' => collect(),
            'posts' => collect(),
        ];

        // Search Products
        if (empty($type) || $type === 'products') {
            $results['products'] = Product::with('category')
                ->active()
                ->where(function($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%");
                })
                ->orderBy('sort_order', 'asc')
                ->take(10)
                ->get();
        }

        // Search Projects
        if (empty($type) || $type === 'projects') {
            $results['projects'] = Project::active()
                ->where(function($q) use ($query) {
                    $q->where('title', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%")
                      ->orWhere('short_description', 'LIKE', "%{$query}%")
                      ->orWhere('location', 'LIKE', "%{$query}%")
                      ->orWhere('client_name', 'LIKE', "%{$query}%");
                })
                ->orderBy('project_date', 'desc')
                ->take(10)
                ->get();
        }

        // Search Blog Posts
        if (empty($type) || $type === 'blog') {
            $results['posts'] = Post::with('author')
                ->published()
                ->where(function($q) use ($query) {
                    $q->where('title', 'LIKE', "%{$query}%")
                      ->orWhere('content', 'LIKE', "%{$query}%")
                      ->orWhere('excerpt', 'LIKE', "%{$query}%");
                })
                ->orderBy('published_at', 'desc')
                ->take(10)
                ->get();
        }

        $totalResults = $results['products']->count() + 
                       $results['projects']->count() + 
                       $results['posts']->count();

        return view('search', compact('query', 'type', 'results', 'totalResults'));
    }
}
