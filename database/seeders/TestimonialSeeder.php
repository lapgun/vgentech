<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'customer_name' => 'Nguyễn Văn An',
                'customer_position' => 'Giám đốc kỹ thuật',
                'customer_company' => 'Công ty TNHH ABC',
                'content' => 'Sản phẩm chất lượng, dịch vụ tận tâm. Máy phát điện hoạt động rất ổn định, đội ngũ kỹ thuật hỗ trợ nhiệt tình.',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'customer_name' => 'Trần Thị Bình',
                'customer_position' => 'Quản lý dự án',
                'customer_company' => 'Tập đoàn XYZ',
                'content' => 'Đã sử dụng máy phát điện của VgenTech được 2 năm, rất hài lòng về chất lượng và bảo hành.',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'customer_name' => 'Lê Minh Cường',
                'customer_position' => 'Giám đốc',
                'customer_company' => 'Khách sạn 5 sao Golden',
                'content' => 'Hệ thống máy phát điện dự phòng của khách sạn hoạt động hoàn hảo. Tư vấn và lắp đặt rất chuyên nghiệp.',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 3
            ]
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(
                [
                    'customer_name' => $testimonial['customer_name'],
                    'customer_company' => $testimonial['customer_company'],
                ],
                $testimonial
            );
        }
    }
}
