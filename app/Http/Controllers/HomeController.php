<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Event;
use App\Models\Category;
use App\Models\Headmaster;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredPosts = Post::published()
            ->featured()
            ->latest('published_at')
            ->take(3)
            ->get();

        $latestPosts = Post::published()
            ->latest('published_at')
            ->take(6)
            ->get();

        $upcomingEvents = Event::published()
            ->upcoming()
            ->orderBy('start_date')
            ->take(3)
            ->get();

        $headmaster = Headmaster::active()->first();
        
        $categories = Category::withCount(['posts' => function($query) {
            $query->published();
        }])->get();
        
        // Get settings from database or fallback to defaults
        $settings = \App\Models\GeneralSetting::first() ?? (object) [
            'school_name' => 'SMA Tunas Harapan',
            'tagline' => 'Sekolahnya Para Pemimpin',
            'address' => 'Jl. Pendidikan No. 123, Kota Jakarta',
            'phone' => '(021) 12345678',
            'email' => 'info@smatunasharapan.sch.id',
            'office_hours' => 'Senin - Jumat: 07:00 - 15:00',
            'hero_title' => 'Selamat Datang di SMA Tunas Harapan',
            'hero_subtitle' => 'Mencetak Generasi Unggul dan Berakhlak Mulia',
            'hero_image' => null,
            'logo' => null,
            'meta_description' => 'Website resmi SMA Tunas Harapan - Sekolahnya Para Pemimpin',
            'meta_keywords' => 'SMA Tunas Harapan, Sekolah, Pendidikan',
            'facebook_url' => null,
            'instagram_url' => null,
            'tiktok_url' => null,
            'youtube_url' => null,
        ];

        return view('home', compact(
            'featuredPosts',
            'latestPosts',
            'upcomingEvents',
            'headmaster',
            'categories',
            'settings'
        ));
    }
}

