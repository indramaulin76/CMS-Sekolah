<?php

namespace App\Filament\Resources\HeadmasterResource\Pages;

use App\Filament\Resources\HeadmasterResource;
use Filament\Resources\Pages\ListRecords;

class ListHeadmasters extends ListRecords
{
    protected static string $resource = HeadmasterResource::class;

    public function mount(): void
    {
        $headmaster = \App\Models\Headmaster::first();

        if ($headmaster) {
            redirect()->to(static::$resource::getUrl('edit', ['record' => $headmaster]));
        } else {
            redirect()->to(static::$resource::getUrl('create'));
        }
    }
}
