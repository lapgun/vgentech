<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Cung cấp máy phát điện cho Tập đoàn Vingroup',
                'slug' => 'cung-cap-may-phat-dien-vingroup',
                'description' => 'Lắp đặt hệ thống máy phát điện dự phòng 500kVA cho tòa nhà Vincom',
                'client_name' => 'Tập đoàn Vingroup',
                'location' => 'Hà Nội',
                'featured_image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&q=80',
                'project_date' => now()->subMonths(4),
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'title' => 'Dự án máy phát điện Nhà máy Samsung Bắc Ninh',
                'slug' => 'du-an-samsung-bac-ninh',
                'description' => 'Cung cấp và lắp đặt 3 máy phát điện Cummins 1000kVA song song',
                'client_name' => 'Samsung Electronics Vietnam',
                'location' => 'Bắc Ninh',
                'featured_image' => 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=800&q=80',
                'project_date' => now()->subMonths(5),
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'title' => 'Hệ thống điện dự phòng Bệnh viện Đa khoa',
                'slug' => 'he-thong-dien-benh-vien',
                'description' => 'Lắp đặt máy phát điện 300kVA với hệ thống ATS tự động',
                'client_name' => 'Bệnh viện Đa khoa Trung ương',
                'location' => 'Hà Nội',
                'featured_image' => 'https://images.unsplash.com/photo-1587351021759-3e566b6af7cc?w=800&q=80',
                'project_date' => now()->subMonths(2),
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'title' => 'Khu công nghiệp VSIP Bình Dương',
                'slug' => 'khu-cong-nghiep-vsip-binh-duong',
                'description' => 'Cung cấp 5 máy phát điện Doosan 500kVA cho nhà máy sản xuất linh kiện điện tử',
                'client_name' => 'Công ty TNHH Electronics Vietnam',
                'location' => 'Bình Dương',
                'featured_image' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=800&q=80',
                'project_date' => now()->subMonths(6),
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'title' => 'Trung tâm thương mại Aeon Mall',
                'slug' => 'trung-tam-thuong-mai-aeon-mall',
                'description' => 'Lắp đặt hệ thống máy phát điện dự phòng 800kVA cho trung tâm thương mại',
                'client_name' => 'Aeon Mall Vietnam',
                'location' => 'Hồ Chí Minh',
                'featured_image' => 'https://images.unsplash.com/photo-1555529669-e69e7aa0ba9a?w=800&q=80',
                'project_date' => now()->subMonths(3),
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'title' => 'Khách sạn 5 sao Sheraton Hanoi',
                'slug' => 'khach-san-sheraton-hanoi',
                'description' => 'Cung cấp 2 máy phát điện Cummins 600kVA song song cho khách sạn',
                'client_name' => 'Sheraton Hanoi Hotel',
                'location' => 'Hà Nội',
                'featured_image' => 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?w=800&q=80',
                'project_date' => now()->subMonths(7),
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 6
            ],
            [
                'title' => 'Nhà máy xi măng Hoàng Thạch',
                'slug' => 'nha-may-xi-mang-hoang-thach',
                'description' => 'Lắp đặt máy phát điện 1500kVA Cummins cho nhà máy xi măng',
                'client_name' => 'Xi măng Hoàng Thạch',
                'location' => 'Nghệ An',
                'featured_image' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800&q=80',
                'project_date' => now()->subMonths(8),
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 7
            ],
            [
                'title' => 'Tòa nhà văn phòng FPT Software',
                'slug' => 'toa-nha-fpt-software',
                'description' => 'Cung cấp máy phát điện 400kVA với tủ ATS tự động chuyển nguồn',
                'client_name' => 'FPT Software',
                'location' => 'Đà Nẵng',
                'featured_image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&q=80',
                'project_date' => now()->subMonths(4),
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 8
            ],
            [
                'title' => 'Khu đô thị Vinhomes Ocean Park',
                'slug' => 'khu-do-thi-vinhomes-ocean-park',
                'description' => 'Lắp đặt 10 máy phát điện Doosan 200kVA cho hệ thống điện dự phòng khu đô thị',
                'client_name' => 'Vinhomes JSC',
                'location' => 'Hà Nội',
                'featured_image' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800&q=80',
                'project_date' => now()->subMonths(9),
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 9
            ],
            [
                'title' => 'Sân bay Quốc tế Cam Ranh',
                'slug' => 'san-bay-cam-ranh',
                'description' => 'Cung cấp và bảo trì máy phát điện 2000kVA Cummins cho sân bay',
                'client_name' => 'Cảng hàng không Cam Ranh',
                'location' => 'Khánh Hòa',
                'featured_image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80',
                'project_date' => now()->subMonths(12),
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 10
            ],
            [
                'title' => 'Nhà máy thép Hòa Phát Dung Quất',
                'slug' => 'nha-may-thep-hoa-phat',
                'description' => 'Lắp đặt hệ thống máy phát điện công suất 3000kVA cho nhà máy thép',
                'client_name' => 'Tập đoàn Hòa Phát',
                'location' => 'Quảng Ngãi',
                'featured_image' => 'https://images.unsplash.com/photo-1587293852726-70cdb56c2866?w=800&q=80',
                'project_date' => now()->subMonths(10),
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 11
            ],
            [
                'title' => 'Trung tâm dữ liệu Viettel IDC',
                'slug' => 'trung-tam-du-lieu-viettel',
                'description' => 'Cung cấp 4 máy phát điện Cummins 1000kVA song song cho Data Center',
                'client_name' => 'Tập đoàn Viettel',
                'location' => 'Hà Nội',
                'featured_image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800&q=80',
                'project_date' => now()->subMonth(),
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 12
            ]
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
