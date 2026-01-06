<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    public function run(): void
    {
        if (GeneralSetting::count() === 0) {
            GeneralSetting::create([
                'school_name' => 'SMA Tunas Harapan',
                'tagline' => 'Sekolahnya Para Pemimpin',
                'address' => 'Jl. Pendidikan No. 123, Kota Jakarta',
                'phone' => '(021) 12345678',
                'email' => 'info@smatunasharapan.sch.id',
                'office_hours' => 'Senin - Jumat: 07:00 - 15:00',
                'hero_title' => 'Selamat Datang di SMA Tunas Harapan',
                'hero_subtitle' => 'Mencetak Generasi Unggul dan Berakhlak Mulia',
                'meta_description' => 'Website resmi SMA Tunas Harapan - Sekolahnya Para Pemimpin',
                'hero_keywords' => 'SMA Tunas Harapan, Sekolah, Pendidikan',
                'facebook_url' => 'https://facebook.com',
                'instagram_url' => 'https://instagram.com',
                'youtube_url' => 'https://youtube.com',
                'tiktok_url' => 'https://tiktok.com',
            ]);
        }
    }
}
