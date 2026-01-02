<?php

namespace App\Filament\Resources\PpdbRegistrationResource\Pages;

use App\Filament\Resources\PpdbRegistrationResource;
use App\Models\PpdbRegistration;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Response;

class ListPpdbRegistrations extends ListRecords
{
    protected static string $resource = PpdbRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Export to Excel (CSV)
            Actions\Action::make('exportExcel')
                ->label('Export Excel')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    return $this->exportToCsv();
                }),
            
            // Export to PDF (opens print dialog)
            Actions\Action::make('exportPdf')
                ->label('Export PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('danger')
                ->url(fn () => route('admin.ppdb.export-pdf'))
                ->openUrlInNewTab(),
        ];
    }

    protected function exportToCsv()
    {
        $registrations = PpdbRegistration::with('period')
            ->orderBy('created_at', 'desc')
            ->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="data-ppdb-' . now()->format('Y-m-d') . '.csv"',
        ];

        $callback = function () use ($registrations) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for Excel UTF-8 compatibility
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            
            // Header row
            fputcsv($file, [
                'No',
                'Kode Pendaftaran',
                'Nama Lengkap',
                'Jenis Kelamin',
                'Tempat Lahir',
                'Tanggal Lahir',
                'Agama',
                'NISN',
                'NIK',
                'No. KK',
                'Asal Sekolah',
                'HP Siswa',
                'Nama Ortu',
                'Alamat Ortu',
                'Pekerjaan Ortu',
                'HP Ortu',
                'Status',
                'Berkas',
                'Periode',
                'Tanggal Daftar',
            ]);

            $no = 1;
            foreach ($registrations as $reg) {
                fputcsv($file, [
                    $no++,
                    $reg->registration_code,
                    $reg->full_name,
                    $reg->gender,
                    $reg->birth_place,
                    $reg->birth_date?->format('d/m/Y'),
                    $reg->religion,
                    $reg->nisn,
                    $reg->nik,
                    $reg->kk_number,
                    $reg->school_origin,
                    $reg->student_phone,
                    $reg->parent_name,
                    $reg->parent_address,
                    $reg->parent_job,
                    $reg->parent_phone,
                    $reg->status?->getLabel() ?? $reg->status,
                    $reg->files_submitted ? 'Sudah' : 'Belum',
                    $reg->period?->name ?? '-',
                    $reg->created_at?->format('d/m/Y H:i'),
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
