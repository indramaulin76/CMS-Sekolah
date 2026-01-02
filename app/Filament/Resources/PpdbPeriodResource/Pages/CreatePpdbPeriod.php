<?php

namespace App\Filament\Resources\PpdbPeriodResource\Pages;

use App\Filament\Resources\PpdbPeriodResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePpdbPeriod extends CreateRecord
{
    protected static string $resource = PpdbPeriodResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
