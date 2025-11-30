<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\Admin\ChatSessionController;
use Illuminate\Support\Facades\Route;

// Language Switcher
Route::get('/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'vi', 'zh'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
        return redirect()->back();
    }
    abort(404);
})->where('locale', 'en|vi|zh');

// Public routes - accessible by everyone (GUEST and ADMIN)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products/{slug}/inquiry', [ProductController::class, 'inquiry'])->name('products.inquiry');

// Projects
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Recruitment
Route::get('/recruitment', [RecruitmentController::class, 'index'])->name('recruitment.index');
Route::get('/recruitment/{slug}', [RecruitmentController::class, 'show'])->name('recruitment.show');
Route::post('/recruitment/{slug}/apply', [RecruitmentController::class, 'apply'])->name('recruitment.apply');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Search
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::prefix('chatbot')->name('chatbot.')->group(function () {
    Route::post('/session', [ChatbotController::class, 'start'])->name('session.start');
    Route::get('/session/{chatSession}', [ChatbotController::class, 'show'])->name('session.show');
    Route::post('/session/{chatSession}/messages', [ChatbotController::class, 'message'])->name('session.message');
});

// Admin only routes - require ADMIN role
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');
    
    // Profile management for admins
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Content Management
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::delete('products/{image}/delete-image', [\App\Http\Controllers\Admin\ProductController::class, 'deleteImage'])->name('products.delete-image');
    Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);
    Route::delete('projects/{image}/delete-image', [\App\Http\Controllers\Admin\ProjectController::class, 'deleteImage'])->name('projects.delete-image');
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
    Route::resource('tags', \App\Http\Controllers\Admin\TagController::class);
    
    // Marketing
    Route::resource('banners', \App\Http\Controllers\Admin\BannerController::class);
    Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);
    
    // HR & Inquiries
    Route::resource('recruitments', \App\Http\Controllers\Admin\RecruitmentController::class);
    Route::get('contacts', [\App\Http\Controllers\Admin\ContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [\App\Http\Controllers\Admin\ContactController::class, 'show'])->name('contacts.show');
    Route::post('contacts/{contact}/mark-read', [\App\Http\Controllers\Admin\ContactController::class, 'markAsRead'])->name('contacts.mark-read');
    Route::post('contacts/{contact}/mark-unread', [\App\Http\Controllers\Admin\ContactController::class, 'markAsUnread'])->name('contacts.mark-unread');
    Route::delete('contacts/{contact}', [\App\Http\Controllers\Admin\ContactController::class, 'destroy'])->name('contacts.destroy');
    
    Route::get('product-inquiries', [\App\Http\Controllers\Admin\ProductInquiryController::class, 'index'])->name('product-inquiries.index');
    Route::get('product-inquiries/{inquiry}', [\App\Http\Controllers\Admin\ProductInquiryController::class, 'show'])->name('product-inquiries.show');
    Route::post('product-inquiries/{inquiry}/mark-read', [\App\Http\Controllers\Admin\ProductInquiryController::class, 'markAsRead'])->name('product-inquiries.mark-read');
    Route::post('product-inquiries/{inquiry}/mark-unread', [\App\Http\Controllers\Admin\ProductInquiryController::class, 'markAsUnread'])->name('product-inquiries.mark-unread');
    Route::delete('product-inquiries/{inquiry}', [\App\Http\Controllers\Admin\ProductInquiryController::class, 'destroy'])->name('product-inquiries.destroy');

    Route::get('chat-sessions', [ChatSessionController::class, 'index'])->name('chat-sessions.index');
    Route::get('chat-sessions/{chatSession}', [ChatSessionController::class, 'show'])->name('chat-sessions.show');
    
    // Settings
    Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
});

require __DIR__.'/auth.php';
