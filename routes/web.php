<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\ContactController;
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

// Admin only routes - require ADMIN role
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Profile management for admins
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // TODO: Add admin routes for managing products, projects, posts
    // Route::resource('admin/products', ProductController::class);
    // Route::resource('admin/projects', ProjectController::class);
    // Route::resource('admin/posts', PostController::class);
});

require __DIR__.'/auth.php';
