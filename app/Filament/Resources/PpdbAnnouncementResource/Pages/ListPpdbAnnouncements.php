<?php

namespace App\Filament\Resources\PpdbAnnouncementResource\Pages;

use App\Enums\RegistrationStatus;
use App\Filament\Resources\PpdbAnnouncementResource;
use App\Models\PpdbRegistration;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ListPpdbAnnouncements extends ListRecords
{
    protected static string $resource = PpdbAnnouncementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('export_all')
                ->label('Export Excel')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function (): StreamedResponse {
                    return $this->exportToCsv();
                }),
        ];
    }

    protected function exportToCsv(): StreamedResponse
    {
        $filename = 'pengumuman_ppdb_' . date('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            
            // Header row
            fputcsv($file, [
                'No',
                'Kode Pendaftaran',
                'Nama Lengkap',
                'NISN',
                'Jenis Kelamin',
                'Tempat Lahir',
                'Tanggal Lahir',
                'Agama',
                'Asal Sekolah',
                'NIK',
                'No. KK',
                'No. HP Siswa',
                'Nama Orang Tua',
                'No. HP Orang Tua',
                'Pekerjaan Orang Tua',
                'Alamat Orang Tua',
                'Periode',
                'Tahun Ajaran',
                'Tanggal Daftar',
                'Status',
            ]);
            
            // Data rows
            $registrations = PpdbRegistration::query()
                ->where('status', RegistrationStatus::ACCEPTED)
                ->with('period')
                ->orderBy('full_name')
                ->get();
            
            $no = 1;
            foreach ($registrations as $reg) {
                fputcsv($file, [
                    $no++,
                    $reg->registration_code,
                    $reg->full_name,
                    $reg->nisn ?? '-',
                    $reg->gender === 'male' ? 'Laki-laki' : 'Perempuan',
                    $reg->birth_place ?? '-',
                    $reg->birth_date?->format('d/m/Y') ?? '-',
                    $reg->religion ?? '-',
                    $reg->previous_school ?? '-',
                    $reg->nik ?? '-',
                    $reg->kk_number ?? '-',
                    $reg->phone ?? '-',
                    $reg->parent_name ?? '-',
                    $reg->parent_phone ?? '-',
                    $reg->parent_occupation ?? '-',
                    $reg->parent_address ?? '-',
                    $reg->period?->name ?? '-',
                    $reg->period?->academic_year ?? '-',
                    $reg->created_at?->format('d/m/Y H:i') ?? '-',
                    'DITERIMA',
                ]);
            }
            
            fclose($file);
        };

        Notification::make()
            ->title('Export berhasil!')
            ->success()
            ->send();

        return response()->stream($callback, 200, $headers);
    }

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }
}
