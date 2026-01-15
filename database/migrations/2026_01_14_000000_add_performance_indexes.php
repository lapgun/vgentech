<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Products table indexes
        Schema::table('products', function (Blueprint $table) {
            // Check if indexes don't already exist before creating
            $table->index('is_active', 'idx_products_is_active');
            $table->index('is_featured', 'idx_products_is_featured');
            $table->index('category_id', 'idx_products_category_id');
            $table->index('view_count', 'idx_products_view_count');
            $table->index(['category_id', 'is_active'], 'idx_products_category_active');
        });

        // Posts table indexes
        Schema::table('posts', function (Blueprint $table) {
            $table->index('is_active', 'idx_posts_is_active');
            $table->index('is_featured', 'idx_posts_is_featured');
            $table->index('published_at', 'idx_posts_published_at');
            $table->index(['is_active', 'published_at'], 'idx_posts_active_published');
        });

        // Projects table indexes
        Schema::table('projects', function (Blueprint $table) {
            $table->index('is_active', 'idx_projects_is_active');
            $table->index('is_featured', 'idx_projects_is_featured');
            $table->index('project_date', 'idx_projects_project_date');
        });

        // Categories table indexes
        Schema::table('categories', function (Blueprint $table) {
            $table->index('is_active', 'idx_categories_is_active');
            $table->index('parent_id', 'idx_categories_parent_id');
        });

        // Product Inquiries table indexes
        Schema::table('product_inquiries', function (Blueprint $table) {
            $table->index('is_processed', 'idx_product_inquiries_is_processed');
            $table->index('created_at', 'idx_product_inquiries_created_at');
        });

        // Testimonials table indexes
        Schema::table('testimonials', function (Blueprint $table) {
            $table->index('is_active', 'idx_testimonials_is_active');
            $table->index('sort_order', 'idx_testimonials_sort_order');
        });

        // Banners table indexes
        Schema::table('banners', function (Blueprint $table) {
            $table->index('is_active', 'idx_banners_is_active');
            $table->index(['position', 'is_active'], 'idx_banners_position_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Products table
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('idx_products_is_active');
            $table->dropIndex('idx_products_is_featured');
            $table->dropIndex('idx_products_category_id');
            $table->dropIndex('idx_products_view_count');
            $table->dropIndex('idx_products_category_active');
        });

        // Posts table
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex('idx_posts_is_active');
            $table->dropIndex('idx_posts_is_featured');
            $table->dropIndex('idx_posts_published_at');
            $table->dropIndex('idx_posts_active_published');
        });

        // Projects table
        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex('idx_projects_is_active');
            $table->dropIndex('idx_projects_is_featured');
            $table->dropIndex('idx_projects_project_date');
        });

        // Categories table
        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex('idx_categories_is_active');
            $table->dropIndex('idx_categories_parent_id');
        });

        // Product Inquiries table
        Schema::table('product_inquiries', function (Blueprint $table) {
            $table->dropIndex('idx_product_inquiries_is_processed');
            $table->dropIndex('idx_product_inquiries_created_at');
        });

        // Testimonials table
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropIndex('idx_testimonials_is_active');
            $table->dropIndex('idx_testimonials_sort_order');
        });

        // Banners table
        Schema::table('banners', function (Blueprint $table) {
            $table->dropIndex('idx_banners_is_active');
            $table->dropIndex('idx_banners_position_active');
        });
    }
};
