<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ensure default admin account exists without creating duplicates when reseeding
        User::updateOrCreate(
            ['email' => 'admin@vgentech.vn'],
            [
                'name' => 'Admin User',
                'role' => User::ROLE_ADMIN,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        );

        // Ensure guest testing account exists without duplicate constraint errors
        User::updateOrCreate(
            ['email' => 'guest@vgentech.vn'],
            [
                'name' => 'Guest User',
                'role' => User::ROLE_GUEST,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        );

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
