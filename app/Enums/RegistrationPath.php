<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Registration path/track for PPDB
 */
enum RegistrationPath: string
{
    case REGULER = 'reguler';
    case PRESTASI_AKADEMIK = 'prestasi_akademik';
    case PRESTASI_NON_AKADEMIK = 'prestasi_non_akademik';
    case AFIRMASI = 'afirmasi';
    case PINDAHAN = 'pindahan';

    /**
     * Get human readable label
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::REGULER => 'Jalur Reguler',
            self::PRESTASI_AKADEMIK => 'Jalur Prestasi Akademik',
            self::PRESTASI_NON_AKADEMIK => 'Jalur Prestasi Non-Akademik',
            self::AFIRMASI => 'Jalur Afirmasi (KIP/KPS)',
            self::PINDAHAN => 'Jalur Pindahan',
        };
    }

    /**
     * Get short label for badges
     */
    public function getShortLabel(): string
    {
        return match ($this) {
            self::REGULER => 'Reguler',
            self::PRESTASI_AKADEMIK => 'Prestasi Akademik',
            self::PRESTASI_NON_AKADEMIK => 'Prestasi Non-Akademik',
            self::AFIRMASI => 'Afirmasi',
            self::PINDAHAN => 'Pindahan',
        };
    }

    /**
     * Get badge color for Filament
     */
    public function getColor(): string
    {
        return match ($this) {
            self::REGULER => 'gray',
            self::PRESTASI_AKADEMIK => 'success',
            self::PRESTASI_NON_AKADEMIK => 'info',
            self::AFIRMASI => 'warning',
            self::PINDAHAN => 'primary',
        };
    }

    /**
     * Get icon for Filament
     */
    public function getIcon(): string
    {
        return match ($this) {
            self::REGULER => 'heroicon-o-user-group',
            self::PRESTASI_AKADEMIK => 'heroicon-o-academic-cap',
            self::PRESTASI_NON_AKADEMIK => 'heroicon-o-trophy',
            self::AFIRMASI => 'heroicon-o-heart',
            self::PINDAHAN => 'heroicon-o-arrow-right-circle',
        };
    }

    /**
     * Get required documents for this path
     */
    public function getRequiredDocuments(): array
    {
        $base = [
            DocumentType::KK,
            DocumentType::AKTA_KELAHIRAN,
            DocumentType::FOTO,
        ];

        return match ($this) {
            self::REGULER => [...$base, DocumentType::RAPOR],
            self::PRESTASI_AKADEMIK, self::PRESTASI_NON_AKADEMIK => [...$base, DocumentType::RAPOR, DocumentType::IJAZAH],
            self::AFIRMASI => [...$base, DocumentType::RAPOR, DocumentType::BUKTI_BAYAR],
            self::PINDAHAN => [...$base, DocumentType::RAPOR, DocumentType::IJAZAH],
        };
    }

    /**
     * Get all cases as array for select options
     */
    public static function toSelectArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $path) => [$path->value => $path->getLabel()])
            ->toArray();
    }
}
