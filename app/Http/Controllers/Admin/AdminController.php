<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Product;
use App\Models\ProductInquiry;
use App\Models\Project;
use App\Models\Recruitment;
use App\Models\Post;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display admin dashboard with key operational metrics.
     */
    public function index()
    {
        $now = Carbon::now();

        // Product metrics
        $totalProducts = Product::count();
        $activeProducts = Product::active()->count();
        $featuredProducts = Product::featured()->count();

        // Project metrics
        $totalProjects = Project::count();
        $activeProjects = Project::active()->count();
        $featuredProjects = Project::featured()->count();

        // Content metrics
        $totalPosts = Post::count();
        $publishedPosts = Post::published()->count();
        $contentProgress = $totalPosts > 0 ? (int) round(($publishedPosts / $totalPosts) * 100) : 0;
        $projectDelivery = $totalProjects > 0 ? (int) round(($activeProjects / $totalProjects) * 100) : 0;

        // Support queues
        $totalContacts = Contact::count();
        $unreadContacts = Contact::unread()->count();
        $resolvedContacts = $totalContacts - $unreadContacts;

        $totalInquiries = ProductInquiry::count();
        $openInquiries = ProductInquiry::unprocessed()->count();
        $resolvedInquiries = $totalInquiries - $openInquiries;

        $contactResponse = $totalContacts > 0 ? (int) round(($resolvedContacts / $totalContacts) * 100) : 100;
        $inquiryResolution = $totalInquiries > 0 ? (int) round(($resolvedInquiries / $totalInquiries) * 100) : 100;

        // Weekly interactions (current calendar week)
        $weekStart = $now->copy()->startOfWeek();
        $contactsThisWeek = Contact::whereBetween('created_at', [$weekStart, $now])->count();
        $inquiriesThisWeek = ProductInquiry::whereBetween('created_at', [$weekStart, $now])->count();
        $weeklyInteractions = $contactsThisWeek + $inquiriesThisWeek;

        // Sparkline data for weekly interactions
        $sparkCounts = collect(range(0, 6))->map(function (int $offset) use ($weekStart) {
            $day = $weekStart->copy()->addDays($offset);

            $contacts = Contact::whereDate('created_at', $day)->count();
            $inquiries = ProductInquiry::whereDate('created_at', $day)->count();

            return $contacts + $inquiries;
        });

        $maxSparkCount = $sparkCounts->max() ?: 0;
        $sparkHeights = $sparkCounts->map(function (int $count) use ($maxSparkCount) {
            if ($maxSparkCount === 0) {
                return 0;
            }

            return max(8, (int) round(($count / $maxSparkCount) * 100));
        })->values();

        // Activity feed (latest contacts and inquiries)
        $recentContacts = Contact::latest()->take(5)->get()->map(function (Contact $contact) {
            return [
                'type' => 'contact',
                'title' => $contact->name ?? __('New contact'),
                'subtitle' => $contact->subject ?: $contact->email,
                'created_at' => $contact->created_at,
                'link' => route('admin.contacts.show', $contact),
            ];
        });

        $recentInquiries = ProductInquiry::with('product')->latest()->take(5)->get()->map(function (ProductInquiry $inquiry) {
            $subtitleParts = [];

            if ($inquiry->product) {
                $subtitleParts[] = $inquiry->product->name;
            }

            if ($inquiry->customer_email) {
                $subtitleParts[] = $inquiry->customer_email;
            }

            $subtitle = implode(' • ', array_filter($subtitleParts)) ?: __('Product inquiry received');

            return [
                'type' => 'inquiry',
                'title' => $inquiry->customer_name ?: __('New product inquiry'),
                'subtitle' => $subtitle,
                'created_at' => $inquiry->created_at,
                'link' => route('admin.product-inquiries.show', $inquiry),
            ];
        });

        $activityFeed = $recentContacts
            ->merge($recentInquiries)
            ->sortByDesc('created_at')
            ->take(8)
            ->values();

        // Collections for cards/lists
        $topProducts = Product::with('category')
            ->orderByDesc('view_count')
            ->take(5)
            ->get();

        $activeProjectsList = Project::active()
            ->orderByDesc('updated_at')
            ->take(5)
            ->get();

        $openRecruitments = Recruitment::active()
            ->orderByRaw('deadline IS NULL')
            ->orderBy('deadline')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'now',
            'totalProducts',
            'activeProducts',
            'featuredProducts',
            'totalProjects',
            'activeProjects',
            'featuredProjects',
            'totalPosts',
            'publishedPosts',
            'contentProgress',
            'projectDelivery',
            'totalContacts',
            'unreadContacts',
            'resolvedContacts',
            'totalInquiries',
            'openInquiries',
            'resolvedInquiries',
            'contactResponse',
            'inquiryResolution',
            'contactsThisWeek',
            'inquiriesThisWeek',
            'weeklyInteractions',
            'sparkHeights',
            'activityFeed',
            'topProducts',
            'activeProjectsList',
            'openRecruitments'
        ));
    }
}
