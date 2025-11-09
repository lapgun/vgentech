<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user with ADMIN role
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@vgentech.vn',
            'role' => User::ROLE_ADMIN,
        ]);

        // Create a guest user for testing
        User::factory()->create([
            'name' => 'Guest User',
            'email' => 'guest@vgentech.vn',
            'role' => User::ROLE_GUEST,
        ]);

        // Run all seeders in order
        $this->call([
            SettingSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            ProductSeeder::class,
            ProjectSeeder::class,
            PostSeeder::class,
            BannerSeeder::class,
            TestimonialSeeder::class,
            RecruitmentSeeder::class,
        ]);
    }
}
