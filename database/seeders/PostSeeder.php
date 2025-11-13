<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        if (! $user) {
            if ($this->command) {
                $this->command->warn('Skipping PostSeeder: no users found.');
            }
            return;
        }

        $tags = Tag::all();
        $defaultTagIds = $tags->pluck('id')->take(min(3, $tags->count()))->all();
        $category = \App\Models\Category::where('type', 'post')->first();

        $posts = [
            [
                'user_id' => $user->id,
                'category_id' => $category->id ?? null,
                'title' => 'Hướng dẫn bảo trì máy phát điện định kỳ',
                'slug' => 'huong-dan-bao-tri-may-phat-dien-dinh-ky',
                'excerpt' => 'Bảo trì định kỳ giúp máy phát điện hoạt động ổn định và kéo dài tuổi thọ',
                'content' => '<p>Máy phát điện cần được bảo trì định kỳ để đảm bảo hoạt động ổn định...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=800&q=80',
                'is_active' => true,
                'published_at' => now()->subDays(5),
                'view_count' => 156,
                'meta_title' => 'Hướng dẫn bảo trì máy phát điện',
                'meta_description' => 'Hướng dẫn chi tiết cách bảo trì máy phát điện định kỳ hiệu quả'
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id ?? null,
                'title' => 'So sánh máy phát điện Cummins và Doosan',
                'slug' => 'so-sanh-may-phat-dien-cummins-va-doosan',
                'excerpt' => 'Phân tích ưu nhược điểm của hai thương hiệu máy phát điện hàng đầu',
                'content' => '<p>Cummins và Doosan đều là những thương hiệu uy tín...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&q=80',
                'is_active' => true,
                'published_at' => now()->subDays(10),
                'view_count' => 234,
                'meta_title' => 'So sánh Cummins và Doosan',
                'meta_description' => 'So sánh chi tiết máy phát điện Cummins và Doosan'
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id ?? null,
                'title' => 'Lựa chọn công suất máy phát điện phù hợp',
                'slug' => 'lua-chon-cong-suat-may-phat-dien-phu-hop',
                'excerpt' => 'Cách tính toán và lựa chọn công suất máy phát điện phù hợp với nhu cầu',
                'content' => '<p>Việc lựa chọn công suất máy phát điện đúng rất quan trọng...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&q=80',
                'is_active' => true,
                'published_at' => now()->subDays(15),
                'view_count' => 189
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id ?? null,
                'title' => 'Xu hướng máy phát điện năm 2024',
                'slug' => 'xu-huong-may-phat-dien-2024',
                'excerpt' => 'Những công nghệ mới và xu hướng phát triển của ngành máy phát điện',
                'content' => '<p>Năm 2024 đánh dấu những bước tiến công nghệ đáng kể...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&q=80',
                'is_active' => true,
                'published_at' => now()->subDays(3),
                'view_count' => 342,
                'meta_title' => 'Xu hướng máy phát điện 2024',
                'meta_description' => 'Tìm hiểu xu hướng và công nghệ mới của máy phát điện'
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id ?? null,
                'title' => 'Lắp đặt máy phát điện cho nhà xưởng',
                'slug' => 'lap-dat-may-phat-dien-cho-nha-xuong',
                'excerpt' => 'Quy trình và lưu ý khi lắp đặt hệ thống máy phát điện công nghiệp',
                'content' => '<p>Lắp đặt máy phát điện cho nhà xưởng đòi hỏi kỹ thuật chuyên môn cao...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800&q=80',
                'is_active' => true,
                'published_at' => now()->subDays(7),
                'view_count' => 278,
                'meta_title' => 'Lắp đặt máy phát điện nhà xưởng',
                'meta_description' => 'Quy trình lắp đặt máy phát điện cho nhà xưởng chuyên nghiệp'
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id ?? null,
                'title' => 'Tiết kiệm nhiên liệu cho máy phát điện',
                'slug' => 'tiet-kiem-nhien-lieu-may-phat-dien',
                'excerpt' => 'Những mẹo giúp giảm chi phí nhiên liệu khi vận hành máy phát điện',
                'content' => '<p>Chi phí nhiên liệu chiếm tỷ trọng lớn trong vận hành máy phát điện...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=800&q=80',
                'is_active' => true,
                'published_at' => now()->subDays(12),
                'view_count' => 412,
                'meta_title' => 'Tiết kiệm nhiên liệu máy phát điện',
                'meta_description' => 'Cách tiết kiệm nhiên liệu hiệu quả cho máy phát điện'
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id ?? null,
                'title' => 'Máy phát điện cho bệnh viện - Yêu cầu đặc biệt',
                'slug' => 'may-phat-dien-cho-benh-vien',
                'excerpt' => 'Tiêu chuẩn và yêu cầu kỹ thuật cho hệ thống điện dự phòng tại bệnh viện',
                'content' => '<p>Bệnh viện đòi hỏi hệ thống điện dự phòng với độ tin cậy tuyệt đối...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=800&q=80',
                'is_active' => true,
                'published_at' => now()->subDays(18),
                'view_count' => 195,
                'meta_title' => 'Máy phát điện bệnh viện',
                'meta_description' => 'Tiêu chuẩn máy phát điện dự phòng cho bệnh viện'
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id ?? null,
                'title' => 'Khắc phục sự cố máy phát điện thường gặp',
                'slug' => 'khac-phuc-su-co-may-phat-dien',
                'excerpt' => 'Cách nhận biết và xử lý các sự cố thường gặp khi vận hành máy phát điện',
                'content' => '<p>Trong quá trình vận hành, máy phát điện có thể gặp một số sự cố...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=800&q=80',
                'is_active' => true,
                'published_at' => now()->subDays(20),
                'view_count' => 523,
                'meta_title' => 'Khắc phục sự cố máy phát điện',
                'meta_description' => 'Hướng dẫn xử lý sự cố máy phát điện phổ biến'
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id ?? null,
                'title' => 'Máy phát điện chạy dầu hay xăng - Nên chọn loại nào?',
                'slug' => 'may-phat-dien-chay-dau-hay-xang',
                'excerpt' => 'So sánh ưu nhược điểm giữa máy phát điện chạy dầu diesel và xăng',
                'content' => '<p>Lựa chọn giữa máy phát điện chạy dầu diesel hay xăng phụ thuộc vào nhiều yếu tố...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=800&q=80',
                'is_active' => true,
                'published_at' => now()->subDays(22),
                'view_count' => 687,
                'meta_title' => 'Máy phát điện dầu hay xăng',
                'meta_description' => 'So sánh máy phát điện dầu diesel và xăng'
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id ?? null,
                'title' => 'Chính sách bảo hành máy phát điện tại VgenTech',
                'slug' => 'chinh-sach-bao-hanh-vgentech',
                'excerpt' => 'Thông tin chi tiết về chế độ bảo hành và hỗ trợ kỹ thuật từ VgenTech',
                'content' => '<p>VgenTech cam kết cung cấp dịch vụ bảo hành tốt nhất cho khách hàng...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=800&q=80',
                'is_active' => true,
                'published_at' => now()->subDays(25),
                'view_count' => 298,
                'meta_title' => 'Chính sách bảo hành VgenTech',
                'meta_description' => 'Chính sách bảo hành máy phát điện tại VgenTech'
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id ?? null,
                'title' => 'Máy phát điện im lặng - Giải pháp cho khu dân cư',
                'slug' => 'may-phat-dien-im-lang',
                'excerpt' => 'Công nghệ giảm tiếng ồn cho máy phát điện sử dụng trong khu dân cư',
                'content' => '<p>Máy phát điện im lặng với công nghệ cách âm hiện đại, phù hợp sử dụng trong khu dân cư, bệnh viện, khách sạn...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800&q=80',
                'is_active' => true,
                'published_at' => now()->subDays(8),
                'view_count' => 445,
                'meta_title' => 'Máy phát điện im lặng',
                'meta_description' => 'Máy phát điện chống ồn cho khu dân cư'
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id ?? null,
                'title' => 'Hệ thống ATS tự động chuyển nguồn',
                'slug' => 'he-thong-ats-tu-dong-chuyen-nguon',
                'excerpt' => 'Tìm hiểu về hệ thống ATS và lợi ích khi tích hợp với máy phát điện',
                'content' => '<p>Hệ thống ATS (Automatic Transfer Switch) tự động chuyển đổi giữa nguồn điện lưới và máy phát điện một cách nhanh chóng...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80',
                'is_active' => true,
                'published_at' => now()->subDays(14),
                'view_count' => 367,
                'meta_title' => 'Hệ thống ATS tự động',
                'meta_description' => 'Tìm hiểu về hệ thống ATS chuyển nguồn tự động'
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id ?? null,
                'title' => 'Dự án lắp đặt thành công tại Samsung Bắc Ninh',
                'slug' => 'du-an-samsung-bac-ninh-thanh-cong',
                'excerpt' => 'VgenTech hoàn thành xuất sắc dự án cung cấp máy phát điện cho Samsung',
                'content' => '<p>VgenTech vinh dự được Samsung tin tưởng lựa chọn cung cấp hệ thống máy phát điện dự phòng 3x1000kVA...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1487017159836-4e23ece2e4cf?w=800&q=80',
                'is_active' => true,
                'published_at' => now()->subDays(4),
                'view_count' => 521,
                'meta_title' => 'Dự án Samsung Bắc Ninh',
                'meta_description' => 'Dự án máy phát điện Samsung Bắc Ninh'
            ]
        ];

        foreach ($posts as $postData) {
            $post = Post::updateOrCreate(
                ['slug' => $postData['slug']],
                $postData
            );

            if (! empty($defaultTagIds)) {
                $post->tags()->sync($defaultTagIds);
            }
        }
    }
}
