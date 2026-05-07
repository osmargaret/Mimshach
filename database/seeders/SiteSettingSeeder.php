<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            'address' => 'Simon Mwansa Kapwepwe Avenue, 12, Avondale',
            'phone' => '+260973260412',
            'email' => 'Info@mimshachconsultancy.com',
            'working_hours' => 'Mon-Fri 9am-6pm GMT',
            'instagram_url' => 'https://www.instagram.com',
            'linkedin_url' => 'https://www.linkedin.com',
            'facebook_url' => 'https://www.facebook.com',
            'youtube_url' => 'https://www.youtube.com',
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253682.62283124574!2d3.28395955!3d6.548055099999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b8b2ae68280c1%3A0xdc9e87a367c3d9cb!2sLagos!5e0!3m2!1sen!2sng!4v1778113050887!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }
    }
}
