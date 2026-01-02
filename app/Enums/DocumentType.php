<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Document types required for PPDB registration
 */
enum DocumentType: string
{
    case KK = 'kk';
    case AKTA_KELAHIRAN = 'akta_kelahiran';
    case IJAZAH = 'ijazah';
    case RAPOR = 'rapor';
    case FOTO = 'foto';
    case BUKTI_BAYAR = 'bukti_bayar';

    /**
     * Get human readable label
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::KK => 'Kartu Keluarga',
            self::AKTA_KELAHIRAN => 'Akta Kelahiran',
            self::IJAZAH => 'Ijazah / SKL',
            self::RAPOR => 'Rapor Terakhir',
            self::FOTO => 'Pas Foto 3x4',
            self::BUKTI_BAYAR => 'Bukti Pembayaran',
        };
    }

    /**
     * Get description for upload hints
     */
    public function getDescription(): string
    {
        return match ($this) {
            self::KK => 'Upload scan/foto Kartu Keluarga yang masih berlaku',
            self::AKTA_KELAHIRAN => 'Upload scan/foto Akta Kelahiran',
            self::IJAZAH => 'Upload scan/foto Ijazah atau Surat Keterangan Lulus',
            self::RAPOR => 'Upload scan/foto Rapor semester terakhir',
            self::FOTO => 'Upload pas foto 3x4 latar merah dengan format JPG/PNG',
            self::BUKTI_BAYAR => 'Upload bukti pembayaran/transfer',
        };
    }

    /**
     * Get icon for Filament
     */
    public function getIcon(): string
    {
        return match ($this) {
            self::KK => 'heroicon-o-home',
            self::AKTA_KELAHIRAN => 'heroicon-o-document-text',
            self::IJAZAH => 'heroicon-o-academic-cap',
            self::RAPOR => 'heroicon-o-clipboard-document-list',
            self::FOTO => 'heroicon-o-photo',
            self::BUKTI_BAYAR => 'heroicon-o-banknotes',
        };
    }

    /**
     * Get allowed file extensions
     */
    public function getAllowedExtensions(): array
    {
        return match ($this) {
            self::FOTO => ['jpg', 'jpeg', 'png'],
            default => ['jpg', 'jpeg', 'png', 'pdf'],
        };
    }

    /**
     * Get max file size in KB
     */
    public function getMaxFileSize(): int
    {
        return match ($this) {
            self::FOTO => 500, // 500KB for photo
            default => 2048, // 2MB for documents
        };
    }

    /**
     * Get all cases as array for select options
     */
    public static function toSelectArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $type) => [$type->value => $type->getLabel()])
            ->toArray();
    }
}
