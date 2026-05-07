<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->has(Blog::factory(10))->create([
            'name' => 'Daniel Ubah',
            'email' => 'ubahchuks91@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '09051776591',
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        Event::factory()->count(12)->create();

        $this->call([
            UniversitySeeder::class,
            SiteSettingSeeder::class,
        ]);
    }
}
