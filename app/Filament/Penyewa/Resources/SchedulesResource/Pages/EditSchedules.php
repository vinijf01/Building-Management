<?php

namespace App\Filament\Penyewa\Resources\SchedulesResource\Pages;

use App\Filament\Penyewa\Resources\SchedulesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchedules extends EditRecord
{
    protected static string $resource = SchedulesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void{
        $schedule = $this->record;
        if ($schedule->status === 'completed' && $schedule->booking){
            $schedule->booking->update(['status' => 'completed']);
        }
    }
}
