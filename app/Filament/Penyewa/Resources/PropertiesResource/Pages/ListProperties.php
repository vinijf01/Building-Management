<?php

namespace App\Filament\Penyewa\Resources\PropertiesResource\Pages;

use App\Filament\Penyewa\Resources\PropertiesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProperties extends ListRecords
{
    protected static string $resource = PropertiesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
