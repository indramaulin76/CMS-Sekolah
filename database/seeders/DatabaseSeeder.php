<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin Users
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@smatunasharapan.sch.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Humas',
            'email' => 'humas@smatunasharapan.sch.id',
            'password' => Hash::make('password'),
            'role' => 'humas',
        ]);

        User::create([
            'name' => 'Kesiswaan',
            'email' => 'kesiswaan@smatunasharapan.sch.id',
            'password' => Hash::make('password'),
            'role' => 'kesiswaan',
        ]);

        // Create Default Categories
        $categories = [
            ['name' => 'Berita', 'slug' => 'berita', 'description' => 'Berita terkini sekolah'],
            ['name' => 'Pengumuman', 'slug' => 'pengumuman', 'description' => 'Pengumuman resmi sekolah'],
            ['name' => 'Kegiatan', 'slug' => 'kegiatan', 'description' => 'Kegiatan dan acara sekolah'],
            ['name' => 'Prestasi', 'slug' => 'prestasi', 'description' => 'Prestasi siswa dan sekolah'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
