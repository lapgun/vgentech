<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'VgenTech', 'type' => 'string'],
            ['key' => 'site_logo', 'value' => '/images/logo.png', 'type' => 'string'],
            ['key' => 'site_description', 'value' => 'Chuyên cung cấp máy phát điện, thiết bị điện công nghiệp', 'type' => 'text'],
            ['key' => 'contact_email', 'value' => 'info@vgentech.vn', 'type' => 'string'],
            ['key' => 'contact_phone', 'value' => '0123 456 789', 'type' => 'string'],
            ['key' => 'contact_address', 'value' => 'Hà Nội, Việt Nam', 'type' => 'string'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/vgentech', 'type' => 'string'],
            ['key' => 'youtube_url', 'value' => 'https://youtube.com/@vgentech', 'type' => 'string'],
            ['key' => 'linkedin_url', 'value' => 'https://linkedin.com/company/vgentech', 'type' => 'string'],
            ['key' => 'footer_copyright', 'value' => '© 2025 VgenTech. All rights reserved.', 'type' => 'string'],
            ['key' => 'items_per_page', 'value' => '12', 'type' => 'number'],
            ['key' => 'google_analytics_id', 'value' => 'UA-XXXXXXXXX-X', 'type' => 'string'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
