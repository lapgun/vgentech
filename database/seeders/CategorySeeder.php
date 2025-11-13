<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Main categories (idempotent to support repeated seeding)
        $parentCategories = [
            [
                'name' => 'Máy phát điện Cummins',
                'slug' => 'may-phat-dien-cummins',
                'description' => 'Máy phát điện Cummins nhập khẩu chính hãng, công suất từ 10kVA đến 3000kVA',
                'sort_order' => 1,
                'meta_title' => 'Máy phát điện Cummins - VgenTech',
                'meta_description' => 'Cung cấp máy phát điện Cummins chính hãng, giá tốt, bảo hành uy tín',
            ],
            [
                'name' => 'Máy phát điện Doosan',
                'slug' => 'may-phat-dien-doosan',
                'description' => 'Máy phát điện Doosan Hàn Quốc chính hãng, chất lượng cao',
                'sort_order' => 2,
                'meta_title' => 'Máy phát điện Doosan - VgenTech',
                'meta_description' => 'Máy phát điện Doosan nhập khẩu Hàn Quốc, uy tín chất lượng',
            ],
            [
                'name' => 'Máy phát điện VMAN',
                'slug' => 'may-phat-dien-vman',
                'description' => 'Máy phát điện VMAN Đức, công nghệ tiên tiến',
                'sort_order' => 3,
                'meta_title' => 'Máy phát điện VMAN - VgenTech',
                'meta_description' => 'Máy phát điện VMAN nhập khẩu Đức, hiệu suất cao',
            ],
            [
                'name' => 'Phụ kiện & Linh kiện',
                'slug' => 'phu-kien-linh-kien',
                'description' => 'Phụ kiện và linh kiện chính hãng cho máy phát điện',
                'sort_order' => 4,
                'meta_title' => 'Phụ kiện máy phát điện - VgenTech',
                'meta_description' => 'Phụ kiện, linh kiện thay thế cho máy phát điện các loại',
            ],
        ];

        $parentIds = [];
        foreach ($parentCategories as $categoryData) {
            $category = Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                [
                    'parent_id' => null,
                    'name' => $categoryData['name'],
                    'description' => $categoryData['description'],
                    'is_active' => true,
                    'sort_order' => $categoryData['sort_order'],
                    'meta_title' => $categoryData['meta_title'],
                    'meta_description' => $categoryData['meta_description'],
                ]
            );

            $parentIds[$categoryData['slug']] = $category->id;
        }

        // Subcategories mapping to parent slugs to keep seeding idempotent
        $childCategories = [
            [
                'parent_slug' => 'may-phat-dien-cummins',
                'name' => 'Máy phát điện Cummins 10-100kVA',
                'slug' => 'may-phat-dien-cummins-10-100kva',
                'description' => 'Máy phát điện Cummins công suất nhỏ 10-100kVA',
                'sort_order' => 1,
            ],
            [
                'parent_slug' => 'may-phat-dien-cummins',
                'name' => 'Máy phát điện Cummins 100-500kVA',
                'slug' => 'may-phat-dien-cummins-100-500kva',
                'description' => 'Máy phát điện Cummins công suất trung bình 100-500kVA',
                'sort_order' => 2,
            ],
            [
                'parent_slug' => 'may-phat-dien-cummins',
                'name' => 'Máy phát điện Cummins 500-1000kVA',
                'slug' => 'may-phat-dien-cummins-500-1000kva',
                'description' => 'Máy phát điện Cummins công suất lớn 500-1000kVA',
                'sort_order' => 3,
            ],
            [
                'parent_slug' => 'phu-kien-linh-kien',
                'name' => 'Bộ điều khiển ATS',
                'slug' => 'bo-dieu-khien-ats',
                'description' => 'Bộ điều khiển chuyển đổi nguồn tự động ATS',
                'sort_order' => 1,
            ],
            [
                'parent_slug' => 'phu-kien-linh-kien',
                'name' => 'Tủ ATS',
                'slug' => 'tu-ats',
                'description' => 'Tủ chuyển đổi nguồn tự động ATS các loại',
                'sort_order' => 2,
            ],
        ];

        foreach ($childCategories as $categoryData) {
            $parentId = $parentIds[$categoryData['parent_slug']] ?? null;

            Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                [
                    'parent_id' => $parentId,
                    'name' => $categoryData['name'],
                    'description' => $categoryData['description'],
                    'is_active' => true,
                    'sort_order' => $categoryData['sort_order'],
                ]
            );
        }
    }
}
