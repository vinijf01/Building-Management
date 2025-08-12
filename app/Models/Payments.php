<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'payment_method', 'payment_type', 'payment_status', 'amount', 'proof_image', 'payment_due_date'];

    protected $casts = [
        'payment_due_date' => 'datetime',
    ];

    public function booking(){
        return $this->belongsTo(Bookings::class);
    }
}
