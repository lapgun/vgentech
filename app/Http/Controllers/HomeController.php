<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Project;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $homeAboutImage = Setting::get('home_about_image');

        $homeAbout = [
            'title' => Setting::get('home_about_title', __('common.company_name')),
            'lead' => Setting::get('home_about_lead', 'Công ty Cổ phần VGENTECH được thành lập bởi khát khao và đam mê cháy bỏng của người sáng lập. Với thời gian dài yêu và gắn bó với nghề Máy phát điện của Người sáng lập, đến nay đã gần 15 năm. Chúng tôi định hướng phát triển doanh nghiệp với kim chỉ nam <strong>"Sự hài lòng của quý Khách hàng là Chìa khóa cho thành công phát triển của Doanh nghiệp"</strong>.'),
            'description' => Setting::get('home_about_description', 'VGENTECH là nhà nhập khẩu và phân phối, bảo trì, bảo dưỡng, sửa chữa động cơ, đầu phát, tổ máy phát điện của các hãng sản xuất máy phát điện uy tín trên thế giới như CUMMINS, MITSUBISHI, PERKINS, JOHN DEERE, YUCHAI, WEICHAI, VOLVO PENTA, DOOSAN, DEUTZ, DENYO, FPT(IVECO), KOHLER, STAMFORD, LEROY SOMER, MECC ALTE, EVOTEC, TT POWER ...'),
            'years' => (int) Setting::get('home_about_years', 15),
            'clients' => (int) Setting::get('home_about_clients', 500),
            'image_url' => null,
        ];

        if ($homeAboutImage) {
            $imagePath = ltrim($homeAboutImage, '/');
            $homeAbout['image_url'] = Str::startsWith($homeAboutImage, ['http://', 'https://', 'data:'])
                ? $homeAboutImage
                : asset('storage/' . $imagePath);
        }

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
            'categories',
            'homeAbout'
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
