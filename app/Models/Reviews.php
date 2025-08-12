<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'customer_id', 'rating', 'comment'];

    public function booking(){
        return $this->belongsTo(Bookings::class);
    }

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }
}
