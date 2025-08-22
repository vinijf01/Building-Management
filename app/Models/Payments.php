<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Payments extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'payment_method', 'payment_type', 'payment_status', 'amount', 'proof_image', 'payment_due_date', 'remark'];

    protected $casts = [
        'payment_due_date' => 'datetime',
    ];

    public function booking(){
        return $this->belongsTo(Bookings::class);
    }

    public function getProofImageUrlAttribute(): ?string
{
    return $this->proof_image ? asset('storage/' . $this->proof_image) : null;
}


    protected static function boot()
    {
        parent::boot();

        // hapus file bukti saat record dihapus
        static::deleting(function ($payment) {
            if (!empty($payment->proof_image) && Storage::disk('public')->exists($payment->proof_image)) {
                Storage::disk('public')->delete($payment->proof_image);
            }
        });

        // hapus file lama saat bukti diganti
        static::updating(function ($payment) {
            if ($payment->isDirty('proof_image')) {
                $old = $payment->getOriginal('proof_image');
                if (!empty($old) && Storage::disk('public')->exists($old)) {
                    Storage::disk('public')->delete($old);
                }
            }
        });
    }

}
