<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    use HasFactory;

    protected $fillable = ['property_id', 'booking_id', 'start_date', 'end_date', 'status'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function property(){
        return $this->belongsTo(Properties::class);
    }

     public function booking()
    {
        return $this->belongsTo(Bookings::class, 'booking_id');
    }


}
