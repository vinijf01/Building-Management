<?php

namespace App\Filament\Penyewa\Resources\PropertiesResource\Pages;

use App\Filament\Penyewa\Resources\PropertiesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProperties extends EditRecord
{
    protected static string $resource = PropertiesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
