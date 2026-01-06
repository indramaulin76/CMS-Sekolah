<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PpdbPeriod extends Model
{
    protected $fillable = [
        'name',
        'academic_year',
        'registration_start',
        'registration_end',
        'announcement_date',
        'quota',
        'status',
        'description',
        'requirements',
    ];

    protected $casts = [
        'registration_start' => 'datetime',
        'registration_end' => 'datetime',
        'announcement_date' => 'datetime',
        'quota' => 'integer',
        'requirements' => 'array',
    ];

    public function registrations(): HasMany
    {
        return $this->hasMany(PpdbRegistration::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOpen($query)
    {
        return $query->whereDate('registration_start', '<=', now())
            ->whereDate('registration_end', '>=', now());
    }
}
