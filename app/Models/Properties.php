<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Properties extends Model
{
    use HasFactory;

    protected $fillable = ['penyewa_id','name','slug','description','cover_image','category','price'];

    public function penyewa() {
        return $this->belongsTo(User::class, 'penyewa_id');
    }

    public function images(){
        return $this->hasMany(PropertyImages::class, 'property_id');
    }

    public function bookings(){
        return $this->hasMany(Bookings::class);
    }

    public function schedules(){
        return $this->hasMany(Schedules::class);
    }

    public function changeRequest(){
        return $this->hasMany(PropertyChangeRequest::class);
    }
}
