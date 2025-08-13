<?php

namespace App\Filament\Penyewa\Resources\PropertiesResource\Pages;

use App\Filament\Penyewa\Resources\PropertiesResource;
use App\Models\PropertyImages;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditProperties extends EditRecord
{
    protected static string $resource = PropertiesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function ($record) {
                    // Hapus cover image
                    if(!empty($record->cover_image)){
                        Storage::disk('public')->delete($record->cover_image);
                    }

                    // Hapus semua image terkait
                    $images = PropertyImages::where('property_id', $record->id)->get();

                    $paths = $images
                        ->pluck('image')
                        ->filter()
                        ->toArray();

                    if(!empty($paths)) {
                        Storage::disk('public')->delete($paths);
                    }

                    $images->each->delete();
                    Storage::disk('public')->deleteDirectory("properties/{$record->id}");
                }),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Hapus cover lama jika ganti baru
        if (!empty($data['cover_image']) && $this->record->cover_image !== $data['cover_image']) {
            Storage::disk('public')->delete($this->record->cover_image ?? []);
        }

        return $data;
    }
}
