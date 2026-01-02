<?php

namespace App\Filament\Resources\PpdbRegistrationResource\Pages;

use App\Filament\Resources\PpdbRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPpdbRegistration extends ViewRecord
{
    protected static string $resource = PpdbRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
