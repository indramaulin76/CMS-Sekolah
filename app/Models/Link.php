<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'title',
        'url',
        'target',
        'order',
        'is_active',
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
