<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Force HTTPS for all generated URLs (only in production)
        if (app()->environment('production')) {
            URL::forceScheme('https');

            // Force Storage URLs to use HTTPS regardless of APP_URL in .env
            $appUrl = config('app.url');
            if ($appUrl && !str_contains($appUrl, 'https://')) {
                $httpsUrl = str_replace('http://', 'https://', $appUrl);
                config(['filesystems.disks.public.url' => $httpsUrl . '/storage']);
            } else if (!$appUrl) {
                 // Fallback if APP_URL is missing
                 config(['filesystems.disks.public.url' => 'https://' . request()->getHttpHost() . '/storage']);
            }
        }

        // Share settings globally across all views
        // This eliminates the need to fetch settings in every controller
        View::composer('*', function ($view) {
            // Check if settings is already set (to allow controllers to override)
            if (!isset($view->getData()['settings'])) {
                $settings = \App\Models\GeneralSetting::first() ?? (object) [
                    'school_name' => config('app.name', 'SMA Tunas Harapan'),
                    'logo' => null,
                    'hero_image' => null,
                    'facebook_url' => null,
                    'instagram_url' => null,
                    'youtube_url' => null,
                    'tiktok_url' => null,
                    'address' => 'Jl. Pendidikan No. 123',
                    'phone' => '(021) 12345678',
                    'email' => 'info@smatunasharapan.sch.id',
                    'footer_text' => '© ' . date('Y') . ' SMA Tunas Harapan',
                    'whatsapp' => null,
                    'office_hours' => null,
                    'map_embed_link' => null,
                ];
                $view->with('settings', $settings);
            }
        });
    }
}
