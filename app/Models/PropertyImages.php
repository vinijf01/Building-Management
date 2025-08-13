<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PropertyImages extends Model
{
    use HasFactory;

    protected $fillable = ['property_id', 'image_path'];

    public function property(){
        return $this->belongsTo(Properties::class, 'property_id');
    }

    protected static function boot()
    {
        parent::boot();

        // Hapus file kalau record dihapus
        static::deleting(function ($image) {
            if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
        });

        // Hapus file lama kalau update gambar
        static::updating(function ($image) {
            if ($image->isDirty('image_path')) { // Cek kalau image_path berubah
                $oldPath = $image->getOriginal('image_path');
                if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
        });
    }

}
