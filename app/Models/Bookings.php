<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    protected $fillable = ['booking_code', 'property_id', 'customer_id', 'start_date', 'end_date', 'status', 'total_price'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function property()
    {
        return $this->belongsTo(Properties::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function payment()
    {
        return $this->hasOne(Payments::class, 'booking_id', 'id');
    }

    public function schedule()
    {
        return $this->hasMany(\App\Models\Schedules::class, 'booking_id');
    }


    public function review()
    {
        return $this->hasOne(Reviews::class);
    }

    protected static function booted()
    {
        static::creating(function ($booking) {
            if (!$booking->booking_code) {
                $booking->booking_code = 'book-' . rand(10000000, 99999999);
            }
        });
    }
}
