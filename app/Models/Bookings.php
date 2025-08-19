<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    protected $fillable = ['property_id', 'customer_id', 'start_date', 'end_date', 'status', 'total_price'];

    public function property(){ return $this->belongsTo(Properties::class);}

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }
   public function payment()
{
    return $this->hasOne(Payments::class, 'booking_id', 'id');
}

    public function schedule(){
        return $this->hasOne(Schedules::class, 'booking_id');
    }

    public function review(){
        return $this->hasOne(Reviews::class);
    }
}
