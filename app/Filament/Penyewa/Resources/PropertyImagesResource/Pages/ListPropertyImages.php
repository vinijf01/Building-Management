<?php

namespace App\Filament\Penyewa\Resources\PropertyImagesResource\Pages;

use App\Filament\Penyewa\Resources\PropertyImagesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPropertyImages extends ListRecords
{
    protected static string $resource = PropertyImagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
