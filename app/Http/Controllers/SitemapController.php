<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Event;
use App\Models\Gallery;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Homepage
        $sitemap .= $this->addUrl(route('home'), now(), 'daily', '1.0');

        // Static pages
        $staticPages = [
            'pages.profil' => ['priority' => '0.9', 'changefreq' => 'monthly'],
            'pages.visi-misi' => ['priority' => '0.9', 'changefreq' => 'monthly'],
            'pages.struktur-organisasi' => ['priority' => '0.8', 'changefreq' => 'monthly'],
            'pages.galeri' => ['priority' => '0.8', 'changefreq' => 'weekly'],
            'pages.kontak' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            'posts.index' => ['priority' => '0.9', 'changefreq' => 'daily'],
            'events.index' => ['priority' => '0.8', 'changefreq' => 'weekly'],
        ];

        foreach ($staticPages as $route => $config) {
            if (\Route::has($route)) {
                $sitemap .= $this->addUrl(
                    route($route),
                    now(),
                    $config['changefreq'],
                    $config['priority']
                );
            }
        }

        // Blog posts
        $posts = Post::orderBy('published_at', 'desc')
            ->limit(100) // Limit untuk performa
            ->get();

        foreach ($posts as $post) {
            $sitemap .= $this->addUrl(
                route('posts.show', $post->slug),
                $post->updated_at,
                'weekly',
                '0.8'
            );
        }

        // Events
        $events = Event::orderBy('date', 'desc')
            ->limit(50)
            ->get();

        foreach ($events as $event) {
            $sitemap .= $this->addUrl(
                route('events.show', $event->slug),
                $event->updated_at,
                'monthly',
                '0.7'
            );
        }

        // Galleries
        $galleries = Gallery::orderBy('created_at', 'desc')->get();
        foreach ($galleries as $gallery) {
            $sitemap .= $this->addUrl(
                route('pages.galeri') . '#gallery-' . $gallery->id,
                $gallery->updated_at,
                'monthly',
                '0.6'
            );
        }

        $sitemap .= '</urlset>';

        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }

    private function addUrl($loc, $lastmod = null, $changefreq = 'weekly', $priority = '0.5')
    {
        $url = '<url>';
        $url .= '<loc>' . htmlspecialchars($loc) . '</loc>';
        
        if ($lastmod) {
            $url .= '<lastmod>' . $lastmod->toAtomString() . '</lastmod>';
        }
        
        $url .= '<changefreq>' . $changefreq . '</changefreq>';
        $url .= '<priority>' . $priority . '</priority>';
        $url .= '</url>';

        return $url;
    }
}
