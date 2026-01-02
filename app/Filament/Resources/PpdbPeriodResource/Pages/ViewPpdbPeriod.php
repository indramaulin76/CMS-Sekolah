<?php

namespace App\Filament\Resources\PpdbPeriodResource\Pages;

use App\Filament\Resources\PpdbPeriodResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPpdbPeriod extends ViewRecord
{
    protected static string $resource = PpdbPeriodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
