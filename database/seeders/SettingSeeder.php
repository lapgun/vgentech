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
            ['key' => 'contact_zalo', 'value' => '0123 456 789', 'type' => 'string'],
            ['key' => 'contact_address', 'value' => 'Hà Nội, Việt Nam', 'type' => 'string'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/vgentech', 'type' => 'string'],
            ['key' => 'youtube_url', 'value' => 'https://youtube.com/@vgentech', 'type' => 'string'],
            ['key' => 'linkedin_url', 'value' => 'https://linkedin.com/company/vgentech', 'type' => 'string'],
            ['key' => 'google_map_embed_url', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.863592744892!2d105.78466897503201!3d21.037499780613943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4cd0c66f05%3A0x85b098f35422f299!2zVmnhu4d0IFnDqm4sIE5nxakgSGnhu4dwLCBUaGFuaCBUcsOsLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1699520000000!5m2!1svi!2s', 'type' => 'text'],
            ['key' => 'contact_qr_image', 'value' => null, 'type' => 'string'],
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
