<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Registration status for PPDB
 */
enum RegistrationStatus: string
{
    case DRAFT = 'draft';
    case PENDING = 'pending';
    case VERIFIED = 'verified';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
    case RESERVED = 'reserved';

    /**
     * Get human readable label
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::PENDING => 'Menunggu Verifikasi',
            self::VERIFIED => 'Terverifikasi',
            self::ACCEPTED => 'Diterima',
            self::REJECTED => 'Ditolak',
            self::RESERVED => 'Cadangan',
        };
    }

    /**
     * Get badge color for Filament
     */
    public function getColor(): string
    {
        return match ($this) {
            self::DRAFT => 'gray',
            self::PENDING => 'warning',
            self::VERIFIED => 'info',
            self::ACCEPTED => 'success',
            self::REJECTED => 'danger',
            self::RESERVED => 'primary',
        };
    }

    /**
     * Get icon for Filament
     */
    public function getIcon(): string
    {
        return match ($this) {
            self::DRAFT => 'heroicon-o-pencil',
            self::PENDING => 'heroicon-o-clock',
            self::VERIFIED => 'heroicon-o-check-circle',
            self::ACCEPTED => 'heroicon-o-check-badge',
            self::REJECTED => 'heroicon-o-x-circle',
            self::RESERVED => 'heroicon-o-queue-list',
        };
    }

    /**
     * Check if registration can be edited
     */
    public function isEditable(): bool
    {
        return in_array($this, [self::DRAFT, self::PENDING]);
    }

    /**
     * Get all cases as array for select options
     */
    public static function toSelectArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $status) => [$status->value => $status->getLabel()])
            ->toArray();
    }
}
