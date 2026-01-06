<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Headmaster;
use Illuminate\View\View;

class PageController extends Controller
{
    public function profil(): View
    {
        $page = Page::where('slug', 'profil')->first();
        $settings = \App\Models\GeneralSetting::first() ?? (object) [
            'school_name' => 'SMA Tunas Harapan',
            'logo' => null,
            'hero_image' => null,
            'facebook_url' => null,
            'instagram_url' => null,
            'youtube_url' => null,
            'tiktok_url' => null,
            'address' => 'Jl. Pendidikan No. 123',
            'phone' => '(021) 12345678',
            'email' => 'info@smatunasharapan.sch.id',
            'footer_text' => '© 2024 SMA Tunas Harapan',
        ];
        $headmaster = Headmaster::active()->first();
        return view('pages.profil', compact('page', 'settings', 'headmaster'));
    }

    public function visiMisi(): View
    {
        $page = Page::where('slug', 'visi-misi')->first();
        $settings = \App\Models\GeneralSetting::first() ?? (object) [
            'school_name' => 'SMA Tunas Harapan',
            'logo' => null,
            'hero_image' => null,
            'facebook_url' => null,
            'instagram_url' => null,
            'youtube_url' => null,
            'tiktok_url' => null,
            'address' => 'Jl. Pendidikan No. 123',
            'phone' => '(021) 12345678',
            'email' => 'info@smatunasharapan.sch.id',
            'footer_text' => '© 2024 SMA Tunas Harapan',
        ];
        return view('pages.visi-misi', compact('page', 'settings'));
    }

    public function organisasi(): View
    {
        $page = Page::where('slug', 'organisasi')->first();
        $headmaster = Headmaster::active()->first();
        $wakas = \App\Models\Staff::waka()->active()->get();
        $others = \App\Models\Staff::teachers()->active()->get();
        
        $settings = \App\Models\GeneralSetting::first() ?? (object) [
            'school_name' => 'SMA Tunas Harapan',
            'logo' => null,
            'hero_image' => null,
            'facebook_url' => null,
            'instagram_url' => null,
            'youtube_url' => null,
            'tiktok_url' => null,
            'address' => 'Jl. Pendidikan No. 123',
            'phone' => '(021) 12345678',
            'email' => 'info@smatunasharapan.sch.id',
            'footer_text' => '© 2024 SMA Tunas Harapan',
        ];

        return view('pages.organisasi', compact('page', 'headmaster', 'wakas', 'others', 'settings'));
    }

    public function kontak(): View
    {
        $page = Page::where('slug', 'hubungi-kami')->first();
        $settings = \App\Models\GeneralSetting::first() ?? (object) [
            'school_name' => 'SMA Tunas Harapan',
            'logo' => null,
            'hero_image' => null,
            'facebook_url' => null,
            'instagram_url' => null,
            'youtube_url' => null,
            'tiktok_url' => null,
            'address' => 'Jl. Pendidikan No. 123',
            'phone' => '(021) 12345678',
            'email' => 'info@smatunasharapan.sch.id',
            'footer_text' => '© 2024 SMA Tunas Harapan',
        ];
        return view('pages.kontak', compact('page', 'settings'));
    }

    public function sambutanKepsek(): View
    {
        $headmaster = Headmaster::active()->first();
        $settings = \App\Models\GeneralSetting::first() ?? (object) [
            'school_name' => 'SMA Tunas Harapan',
            'logo' => null,
            'hero_image' => null,
            'facebook_url' => null,
            'instagram_url' => null,
            'youtube_url' => null,
            'tiktok_url' => null,
            'address' => 'Jl. Pendidikan No. 123',
            'phone' => '(021) 12345678',
            'email' => 'info@smatunasharapan.sch.id',
            'footer_text' => '© 2024 SMA Tunas Harapan',
        ];
        return view('pages.sambutan', compact('headmaster', 'settings'));
    }
}
