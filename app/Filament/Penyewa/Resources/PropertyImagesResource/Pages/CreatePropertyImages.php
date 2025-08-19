<?php

namespace App\Filament\Penyewa\Resources\PropertyImagesResource\Pages;

use App\Filament\Penyewa\Resources\PropertyImagesResource;
use App\Models\PropertyImages;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePropertyImages extends CreateRecord
{
    protected static string $resource = PropertyImagesResource::class;

    protected function handleRecordCreation(array $data): PropertyImages
    {
        $images = $data['images'] ?? [];

        $firstPath = is_array($images) && count($images) > 0 ? $images[0] : null;

        $record = PropertyImages::create([
            'property_id' => $data['property_id'],
            'image_path' => $firstPath ?? '',
        ]);

        if(count($images) > 1) {
            foreach (array_slice($images, 1) as $path) {
                PropertyImages::create([
                    'property_id' => $data['property_id'],
                    'image_path' => $path,
                ]);
            }
        }
        return $record;
    }
}
