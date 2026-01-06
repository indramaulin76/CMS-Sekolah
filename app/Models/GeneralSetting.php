<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $table = 'general_settings';
    
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
        'hero_title',
        'hero_subtitle',
        'sidebar_video_url',
        'logo',
        'meta_description',
        'meta_keywords',
    ];
}
