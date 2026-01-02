<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Payment status for PPDB registration
 */
enum PaymentStatus: string
{
    case UNPAID = 'unpaid';
    case PROCESSING = 'processing';
    case PAID = 'paid';
    case FAILED = 'failed';

    /**
     * Get human readable label
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::UNPAID => 'Belum Bayar',
            self::PROCESSING => 'Menunggu Konfirmasi',
            self::PAID => 'Lunas',
            self::FAILED => 'Gagal',
        };
    }

    /**
     * Get badge color for Filament
     */
    public function getColor(): string
    {
        return match ($this) {
            self::UNPAID => 'gray',
            self::PROCESSING => 'warning',
            self::PAID => 'success',
            self::FAILED => 'danger',
        };
    }

    /**
     * Get icon for Filament
     */
    public function getIcon(): string
    {
        return match ($this) {
            self::UNPAID => 'heroicon-o-currency-dollar',
            self::PROCESSING => 'heroicon-o-clock',
            self::PAID => 'heroicon-o-check-circle',
            self::FAILED => 'heroicon-o-x-circle',
        };
    }

    /**
     * Check if payment allows registration to proceed
     */
    public function allowsRegistration(): bool
    {
        return in_array($this, [self::PAID, self::PROCESSING]);
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
