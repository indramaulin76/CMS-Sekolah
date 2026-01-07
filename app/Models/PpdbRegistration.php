<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class PpdbRegistration extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'ppdb_period_id',
        'registration_code',
        'full_name',
        'nickname',
        'birth_place',
        'birth_date',
        'gender',
        'religion',
        'address',
        'phone',
        'email',
        'previous_school',
        'nisn',
        'kk_number',
        'nik',
        'parent_name',
        'parent_phone',
        'parent_occupation',
        'parent_address',
        'photo',
        'documents',
        'status',
        'notes',
        'files_submitted',
        'received_by',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'documents' => 'array',
        'status' => \App\Enums\RegistrationStatus::class,
    ];

    protected static function booted(): void
    {
        static::creating(function ($registration) {
            if (empty($registration->registration_code)) {
                $registration->registration_code = 'PPDB-' . strtoupper(Str::random(8));
            }
        });
    }

    public function period(): BelongsTo
    {
        return $this->belongsTo(PpdbPeriod::class, 'ppdb_period_id');
    }

    /**
     * Accessor for school_origin - maps to previous_school field
     */
    public function getSchoolOriginAttribute(): ?string
    {
        return $this->previous_school;
    }

    /**
     * Accessor for birth_info - combines birth_place and birth_date
     */
    public function getBirthInfoAttribute(): string
    {
        $date = $this->birth_date ? $this->birth_date->format('d-m-Y') : '-';
        return ($this->birth_place ?? '-') . ', ' . $date;
    }

    /**
     * Accessor for student_phone - maps to phone field
     */
    public function getStudentPhoneAttribute(): ?string
    {
        return $this->phone;
    }

    /**
     * Accessor for parent_job - maps to parent_occupation field
     */
    public function getParentJobAttribute(): ?string
    {
        return $this->parent_occupation;
    }

    public function scopePending($query)
    {
        return $query->where('status', \App\Enums\RegistrationStatus::PENDING);
    }

    public function verify(?int $userId = null): void
    {
        $this->update([
            'status' => \App\Enums\RegistrationStatus::VERIFIED,
            // 'verified_by' => $userId, // If needed in future
        ]);
    }

    public function accept(): void
    {
        $this->update([
            'status' => \App\Enums\RegistrationStatus::ACCEPTED,
        ]);
    }

    public function reject(string $reason): void
    {
        $this->update([
            'status' => \App\Enums\RegistrationStatus::REJECTED,
            'notes' => $this->notes . "\n[REJECTED] " . $reason,
        ]);
    }
}
