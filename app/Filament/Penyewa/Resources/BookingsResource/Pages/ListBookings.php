<?php

namespace App\Filament\Penyewa\Resources\BookingsResource\Pages;

use App\Filament\Penyewa\Resources\BookingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
