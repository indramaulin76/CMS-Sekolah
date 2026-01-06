<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $galleries = Gallery::published()
            ->latest()
            ->paginate(12);

        $settings = \App\Models\GeneralSetting::first();

        return view('gallery.index', compact('galleries', 'settings'));
    }

    public function show(string $slug): View
    {
        $gallery = Gallery::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $settings = \App\Models\GeneralSetting::first();

        return view('gallery.show', compact('gallery', 'settings'));
    }
}
