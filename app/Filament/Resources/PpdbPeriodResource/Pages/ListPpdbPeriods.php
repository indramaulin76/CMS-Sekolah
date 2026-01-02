<?php

namespace App\Filament\Resources\PpdbPeriodResource\Pages;

use App\Filament\Resources\PpdbPeriodResource;
use Filament\Resources\Pages\ListRecords;

class ListPpdbPeriods extends ListRecords
{
    protected static string $resource = PpdbPeriodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
