<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Headmaster extends Model
{
    protected $fillable = [
        'name',
        'position',
        'photo',
        'quote',
        'message',
        'greeting',
        'start_year',
        'end_year',
        'display_order',
        'period_start',
        'period_end',
        'is_active',
    ];

    protected $casts = [
        'period_start' => 'date',
        'period_end' => 'date',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
