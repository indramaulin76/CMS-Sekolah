<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $upcomingEvents = Event::published()
            ->upcoming()
            ->orderBy('start_date', 'asc')
            ->paginate(9);

        $pastEvents = Event::published()
            ->where('start_date', '<', now())
            ->orderBy('start_date', 'desc')
            ->take(5)
            ->get();
            
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

        return view('events.index', compact('upcomingEvents', 'pastEvents', 'settings'));
    }

    public function show(string $slug): View
    {
        $event = Event::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $upcomingEvents = Event::published()
            ->upcoming()
            ->where('id', '!=', $event->id)
            ->orderBy('start_date')
            ->take(3)
            ->get();

        $settings = \App\Models\GeneralSetting::first();

        return view('events.show', compact('event', 'upcomingEvents', 'settings'));
    }
}
