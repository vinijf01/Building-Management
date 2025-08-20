<?php

namespace App\Filament\Penyewa\Resources\SchedulesResource\Pages;

use App\Filament\Penyewa\Resources\SchedulesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchedules extends ListRecords
{
    protected static string $resource = SchedulesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
