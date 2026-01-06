<?php

namespace App\Filament\Resources\PpdbAnnouncementResource\Pages;

use App\Filament\Resources\PpdbAnnouncementResource;
use App\Filament\Resources\PpdbRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPpdbAnnouncement extends ViewRecord
{
    protected static string $resource = PpdbAnnouncementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('print_acceptance')
                ->label('Cetak Surat Penerimaan')
                ->icon('heroicon-o-printer')
                ->color('success')
                ->url(fn () => route('ppdb.print', $this->record->registration_code))
                ->openUrlInNewTab(),
            
            Actions\Action::make('back_to_registrations')
                ->label('Lihat di Data Pendaftar')
                ->icon('heroicon-o-arrow-left')
                ->color('gray')
                ->url(fn () => PpdbRegistrationResource::getUrl('view', ['record' => $this->record])),
        ];
    }
}
