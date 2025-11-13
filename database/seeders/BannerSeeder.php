<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Máy phát điện Cummins - Giảm giá 10%',
                'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=1920&h=600&fit=crop',
                'link' => '/products',
                'position' => 'home_slider',
                'sort_order' => 1,
                'is_active' => true,
                'start_date' => now(),
                'end_date' => now()->addMonths(1)
            ],
            [
                'title' => 'Máy phát điện Doosan - Chính hãng 100%',
                'image' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=1920&h=600&fit=crop',
                'link' => '/products',
                'position' => 'home_slider',
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'Dự án lắp đặt tại Samsung Bắc Ninh',
                'image' => 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=1920&h=600&fit=crop',
                'link' => '/projects',
                'position' => 'home_slider',
                'sort_order' => 3,
                'is_active' => true
            ],
            [
                'title' => 'Tư vấn miễn phí 24/7 - Hotline: 0938.518.555',
                'image' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=1920&h=600&fit=crop',
                'link' => '/contact',
                'position' => 'home_slider',
                'sort_order' => 4,
                'is_active' => true
            ],
            [
                'title' => 'Máy phát điện VMAN - Công nghệ Đức',
                'image' => 'https://images.unsplash.com/photo-1581092334651-ddf26d9a09d0?w=1920&h=600&fit=crop',
                'link' => '/products',
                'position' => 'home_slider',
                'sort_order' => 5,
                'is_active' => true
            ],
            [
                'title' => 'Bảo hành chính hãng - Hỗ trợ trọn đời',
                'image' => 'https://images.unsplash.com/photo-1581092795360-fd1ca04f0952?w=1920&h=600&fit=crop',
                'link' => '/about',
                'position' => 'home_slider',
                'sort_order' => 6,
                'is_active' => true
            ]
        ];

        foreach ($banners as $banner) {
            Banner::updateOrCreate(
                [
                    'position' => $banner['position'],
                    'sort_order' => $banner['sort_order'],
                ],
                $banner
            );
        }
    }
}
