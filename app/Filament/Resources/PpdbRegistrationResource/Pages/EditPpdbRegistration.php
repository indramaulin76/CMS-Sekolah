<?php

namespace App\Filament\Resources\PpdbRegistrationResource\Pages;

use App\Filament\Resources\PpdbRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPpdbRegistration extends EditRecord
{
    protected static string $resource = PpdbRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\RestoreAction::make(),
            Actions\ForceDeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
