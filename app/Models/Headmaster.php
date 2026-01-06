<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Headmaster extends Model
{
    protected $fillable = [
        'name',
        'photo',
        'greeting',
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
