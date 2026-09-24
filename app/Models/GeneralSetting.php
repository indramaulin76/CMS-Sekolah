<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $table = 'general_settings';

    protected function casts(): array
    {
        return [
            'hero_images' => 'array',
        ];
    }

    protected $fillable = [
        'school_name',
        'tagline',
        'address',
        'phone',
        'email',
        'whatsapp',
        'office_hours',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'tiktok_url',
        'map_embed_link',
        'google_maps_link',
        'hero_image',
        'hero_images',
        'hero_title',
        'hero_subtitle',
        'sidebar_video_url',
        'logo',
        'meta_description',
        'meta_keywords',
    ];

    /**
     * Return the configured hero images in display order.
     *
     * The single hero_image field is kept as a fallback for settings that
     * were created before the multi-image hero slider was introduced.
     */
    public function heroImagePaths(): array
    {
        $heroImages = $this->hero_images;

        if (is_string($heroImages)) {
            $heroImages = json_decode($heroImages, true);
        }

        if (is_array($heroImages)) {
            return array_values(array_filter(
                $heroImages,
                static fn ($image): bool => is_string($image) && $image !== ''
            ));
        }

        return filled($this->hero_image) ? [$this->hero_image] : [];
    }

    public function heroImageForSeo(): ?string
    {
        return $this->heroImagePaths()[0] ?? null;
    }
}
