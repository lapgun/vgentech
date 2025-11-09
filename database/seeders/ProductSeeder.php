<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cummins = Category::where('slug', 'may-phat-dien-cummins')->first();
        $doosan = Category::where('slug', 'may-phat-dien-doosan')->first();

        $products = [
            [
                'category_id' => $cummins->id,
                'name' => 'Máy phát điện Cummins 50kVA',
                'slug' => 'may-phat-dien-cummins-50kva',
                'sku' => 'CUM-50',
                'description' => 'Máy phát điện Cummins 50kVA chính hãng, vận hành êm ái, tiết kiệm nhiên liệu',
                'featured_image' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=800&q=80',
                'specifications' => [
                    'Công suất dự phòng' => '50kVA / 40kW',
                    'Công suất chính' => '45kVA / 36kW',
                    'Động cơ' => 'Cummins 4BTA3.9-G2',
                    'Điện áp' => '220V/380V - 50Hz',
                    'Dung tích bình nhiên liệu' => '100 lít',
                    'Thời gian vận hành liên tục' => '8-12 giờ',
                    'Mức tiêu thụ nhiên liệu' => '10-12 lít/giờ',
                    'Độ ồn' => '75 dB(A) @ 7m'
                ],
                'price' => 150000000,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
                'meta_title' => 'Máy phát điện Cummins 50kVA - Giá tốt',
                'meta_description' => 'Máy phát điện Cummins 50kVA chính hãng, bảo hành 2 năm, giao hàng toàn quốc'
            ],
            [
                'category_id' => $cummins->id,
                'name' => 'Máy phát điện Cummins 100kVA',
                'slug' => 'may-phat-dien-cummins-100kva',
                'sku' => 'CUM-100',
                'description' => 'Máy phát điện Cummins 100kVA công suất lớn, phù hợp nhà máy, xí nghiệp',
                'featured_image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&q=80',
                'specifications' => [
                    'Công suất dự phòng' => '100kVA / 80kW',
                    'Công suất chính' => '90kVA / 72kW',
                    'Động cơ' => 'Cummins 6BTA5.9-G2',
                    'Điện áp' => '220V/380V - 50Hz',
                    'Dung tích bình nhiên liệu' => '200 lít',
                    'Thời gian vận hành liên tục' => '10-15 giờ',
                    'Mức tiêu thụ nhiên liệu' => '18-22 lít/giờ',
                    'Độ ồn' => '78 dB(A) @ 7m'
                ],
                'price' => 280000000,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
                'meta_title' => 'Máy phát điện Cummins 100kVA',
                'meta_description' => 'Máy phát điện Cummins 100kVA nhập khẩu, giá tốt nhất thị trường'
            ],
            [
                'category_id' => $cummins->id,
                'name' => 'Máy phát điện Cummins 250kVA',
                'slug' => 'may-phat-dien-cummins-250kva',
                'sku' => 'CUM-250',
                'description' => 'Máy phát điện Cummins 250kVA công nghiệp, độ bền cao',
                'featured_image' => 'https://images.unsplash.com/photo-1621905252507-b35492cc74b4?w=800&q=80',
                'specifications' => [
                    'Công suất dự phòng' => '250kVA / 200kW',
                    'Công suất chính' => '225kVA / 180kW',
                    'Động cơ' => 'Cummins NTA855-G1B',
                    'Điện áp' => '220V/380V - 50Hz',
                    'Dung tích bình nhiên liệu' => '500 lít',
                    'Thời gian vận hành liên tục' => '12-24 giờ',
                    'Mức tiêu thụ nhiên liệu' => '45-50 lít/giờ',
                    'Độ ồn' => '82 dB(A) @ 7m'
                ],
                'price' => 650000000,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'category_id' => $doosan->id,
                'name' => 'Máy phát điện Doosan 75kVA',
                'slug' => 'may-phat-dien-doosan-75kva',
                'sku' => 'DOO-75',
                'description' => 'Máy phát điện Doosan 75kVA Hàn Quốc, tiết kiệm nhiên liệu',
                'featured_image' => 'https://images.unsplash.com/photo-1581092795360-fd1ca04f0952?w=800&q=80',
                'specifications' => [
                    'Công suất dự phòng' => '75kVA / 60kW',
                    'Công suất chính' => '68kVA / 54kW',
                    'Động cơ' => 'Doosan P086TI',
                    'Điện áp' => '220V/380V - 50Hz',
                    'Dung tích bình nhiên liệu' => '150 lít',
                    'Thời gian vận hành liên tục' => '10-12 giờ',
                    'Mức tiêu thụ nhiên liệu' => '15-18 lít/giờ',
                    'Độ ồn' => '76 dB(A) @ 7m'
                ],
                'price' => 185000000,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'category_id' => $doosan->id,
                'name' => 'Máy phát điện Doosan 150kVA',
                'slug' => 'may-phat-dien-doosan-150kva',
                'sku' => 'DOO-150',
                'description' => 'Máy phát điện Doosan 150kVA công suất ổn định, vận hành tin cậy',
                'featured_image' => 'https://images.unsplash.com/photo-1621905252507-b35492cc74b4?w=800&q=80',
                'specifications' => [
                    'Công suất dự phòng' => '150kVA / 120kW',
                    'Công suất chính' => '135kVA / 108kW',
                    'Động cơ' => 'Doosan P126TI',
                    'Điện áp' => '220V/380V - 50Hz',
                    'Dung tích bình nhiên liệu' => '300 lít',
                    'Thời gian vận hành liên tục' => '12-15 giờ',
                    'Mức tiêu thụ nhiên liệu' => '28-32 lít/giờ',
                    'Độ ồn' => '79 dB(A) @ 7m'
                ],
                'price' => 380000000,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'category_id' => $cummins->id,
                'name' => 'Máy phát điện Cummins 30kVA',
                'slug' => 'may-phat-dien-cummins-30kva',
                'sku' => 'CUM-30',
                'description' => 'Máy phát điện Cummins 30kVA nhỏ gọn, phù hợp gia đình, văn phòng nhỏ',
                'featured_image' => 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?w=800&q=80',
                'specifications' => [
                    'Công suất dự phòng' => '30kVA / 24kW',
                    'Công suất chính' => '27kVA / 22kW',
                    'Động cơ' => 'Cummins 4B3.9-G1',
                    'Điện áp' => '220V/380V - 50Hz',
                    'Dung tích bình nhiên liệu' => '80 lít',
                    'Thời gian vận hành liên tục' => '8-10 giờ',
                    'Mức tiêu thụ nhiên liệu' => '7-9 lít/giờ',
                    'Độ ồn' => '72 dB(A) @ 7m'
                ],
                'price' => 95000000,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 6
            ],
            [
                'category_id' => $cummins->id,
                'name' => 'Máy phát điện Cummins 150kVA',
                'slug' => 'may-phat-dien-cummins-150kva',
                'sku' => 'CUM-150',
                'description' => 'Máy phát điện Cummins 150kVA hiệu suất cao, tiết kiệm nhiên liệu',
                'featured_image' => 'https://images.unsplash.com/photo-1581092334651-ddf26d9a09d0?w=800&q=80',
                'specifications' => [
                    'Công suất dự phòng' => '150kVA / 120kW',
                    'Công suất chính' => '135kVA / 108kW',
                    'Động cơ' => 'Cummins 6CTA8.3-G2',
                    'Điện áp' => '220V/380V - 50Hz',
                    'Dung tích bình nhiên liệu' => '300 lít',
                    'Thời gian vận hành liên tục' => '12-18 giờ',
                    'Mức tiêu thụ nhiên liệu' => '28-32 lít/giờ',
                    'Độ ồn' => '79 dB(A) @ 7m'
                ],
                'price' => 395000000,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 7
            ],
            [
                'category_id' => $cummins->id,
                'name' => 'Máy phát điện Cummins 500kVA',
                'slug' => 'may-phat-dien-cummins-500kva',
                'sku' => 'CUM-500',
                'description' => 'Máy phát điện Cummins 500kVA công suất siêu lớn cho nhà máy, khu công nghiệp',
                'featured_image' => 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=800&q=80',
                'specifications' => [
                    'Công suất dự phòng' => '500kVA / 400kW',
                    'Công suất chính' => '450kVA / 360kW',
                    'Động cơ' => 'Cummins KTA19-G3',
                    'Điện áp' => '220V/380V - 50Hz',
                    'Dung tích bình nhiên liệu' => '1000 lít',
                    'Thời gian vận hành liên tục' => '15-24 giờ',
                    'Mức tiêu thụ nhiên liệu' => '90-100 lít/giờ',
                    'Độ ồn' => '85 dB(A) @ 7m'
                ],
                'price' => 1250000000,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 8
            ],
            [
                'category_id' => $doosan->id,
                'name' => 'Máy phát điện Doosan 40kVA',
                'slug' => 'may-phat-dien-doosan-40kva',
                'sku' => 'DOO-40',
                'description' => 'Máy phát điện Doosan 40kVA tiết kiệm, vận hành êm ái',
                'featured_image' => 'https://images.unsplash.com/photo-1581092795360-fd1ca04f0952?w=800&q=80',
                'specifications' => [
                    'Công suất dự phòng' => '40kVA / 32kW',
                    'Công suất chính' => '36kVA / 29kW',
                    'Động cơ' => 'Doosan P066TI',
                    'Điện áp' => '220V/380V - 50Hz',
                    'Dung tích bình nhiên liệu' => '90 lít',
                    'Thời gian vận hành liên tục' => '8-12 giờ',
                    'Mức tiêu thụ nhiên liệu' => '9-11 lít/giờ',
                    'Độ ồn' => '73 dB(A) @ 7m'
                ],
                'price' => 125000000,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 9
            ],
            [
                'category_id' => $doosan->id,
                'name' => 'Máy phát điện Doosan 200kVA',
                'slug' => 'may-phat-dien-doosan-200kva',
                'sku' => 'DOO-200',
                'description' => 'Máy phát điện Doosan 200kVA công nghiệp, độ bền cao',
                'featured_image' => 'https://images.unsplash.com/photo-1581092334651-ddf26d9a09d0?w=800&q=80',
                'specifications' => [
                    'Công suất dự phòng' => '200kVA / 160kW',
                    'Công suất chính' => '180kVA / 144kW',
                    'Động cơ' => 'Doosan P158LE',
                    'Điện áp' => '220V/380V - 50Hz',
                    'Dung tích bình nhiên liệu' => '400 lít',
                    'Thời gian vận hành liên tục' => '12-20 giờ',
                    'Mức tiêu thụ nhiên liệu' => '38-42 lít/giờ',
                    'Độ ồn' => '81 dB(A) @ 7m'
                ],
                'price' => 520000000,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 10
            ],
            [
                'category_id' => $doosan->id,
                'name' => 'Máy phát điện Doosan 300kVA',
                'slug' => 'may-phat-dien-doosan-300kva',
                'sku' => 'DOO-300',
                'description' => 'Máy phát điện Doosan 300kVA hiệu suất cao, tiêu chuẩn công nghiệp',
                'featured_image' => 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?w=800&q=80',
                'specifications' => [
                    'Công suất dự phòng' => '300kVA / 240kW',
                    'Công suất chính' => '270kVA / 216kW',
                    'Động cơ' => 'Doosan P222LE',
                    'Điện áp' => '220V/380V - 50Hz',
                    'Dung tích bình nhiên liệu' => '600 lít',
                    'Thời gian vận hành liên tục' => '15-24 giờ',
                    'Mức tiêu thụ nhiên liệu' => '55-60 lít/giờ',
                    'Độ ồn' => '83 dB(A) @ 7m'
                ],
                'price' => 780000000,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 11
            ],
            [
                'category_id' => $cummins->id,
                'name' => 'Máy phát điện Cummins 20kVA',
                'slug' => 'may-phat-dien-cummins-20kva',
                'sku' => 'CUM-20',
                'description' => 'Máy phát điện Cummins 20kVA mini, lý tưởng cho gia đình',
                'featured_image' => 'https://images.unsplash.com/photo-1581092457119-2ed1181b6c3f?w=800&q=80',
                'specifications' => [
                    'Công suất dự phòng' => '20kVA / 16kW',
                    'Công suất chính' => '18kVA / 14kW',
                    'Động cơ' => 'Cummins 4B3.3-G1',
                    'Điện áp' => '220V/380V - 50Hz',
                    'Dung tích bình nhiên liệu' => '60 lít',
                    'Thời gian vận hành liên tục' => '6-8 giờ',
                    'Mức tiêu thụ nhiên liệu' => '5-6 lít/giờ',
                    'Độ ồn' => '70 dB(A) @ 7m'
                ],
                'price' => 68000000,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 12
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
