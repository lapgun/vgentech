<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Máy phát điện', 'slug' => 'may-phat-dien'],
            ['name' => 'Cummins', 'slug' => 'cummins'],
            ['name' => 'Doosan', 'slug' => 'doosan'],
            ['name' => 'VMAN', 'slug' => 'vman'],
            ['name' => 'Bảo trì', 'slug' => 'bao-tri'],
            ['name' => 'Sửa chữa', 'slug' => 'sua-chua'],
            ['name' => 'Phụ kiện', 'slug' => 'phu-kien'],
            ['name' => 'Tin tức', 'slug' => 'tin-tuc'],
            ['name' => 'Công nghệ', 'slug' => 'cong-nghe'],
            ['name' => 'Giải pháp', 'slug' => 'giai-phap'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
