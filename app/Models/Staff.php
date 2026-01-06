<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    protected $fillable = [
        'name',
        'nip',
        'position',
        'type', // 'waka', 'teacher', 'staff'
        'photo',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    public function scopeWaka($query)
    {
        return $query->where('type', 'waka')->orderBy('order');
    }

    public function scopeTeachers($query)
    {
        return $query->whereIn('type', ['teacher', 'staff'])->orderBy('order');
    }
}
