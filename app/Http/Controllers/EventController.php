<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $agendaItems = Event::agendaItems();
        $now = now();

        $upcomingEvents = $agendaItems
            ->filter(fn ($item): bool => $item->start_date !== null && $item->start_date->greaterThanOrEqualTo($now))
            ->take(9)
            ->values();

        $pastEvents = $agendaItems
            ->filter(fn ($item): bool => $item->start_date !== null && $item->start_date->lessThan($now))
            ->sortByDesc('start_date')
            ->take(5)
            ->values();
            
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

        $upcomingEvents = Event::agendaItems()
            ->filter(fn ($item): bool => $item->start_date !== null && $item->start_date->greaterThanOrEqualTo(now()))
            ->reject(fn ($item): bool => $item->source === 'event' && $item->id === $event->id)
            ->take(3)
            ->values();

        $settings = \App\Models\GeneralSetting::first();

        return view('events.show', compact('event', 'upcomingEvents', 'settings'));
    }
}
