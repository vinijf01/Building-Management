<?php

use App\Models\Payments;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::call(function () {
    $expiredPayments = Payments::where('payment_status', 'pending_verification')
     ->where('payment_due_date', '<', now())
     ->get();

     foreach($expiredPayments as $payment) {
        $booking = $payment->booking;
        if($booking && $booking->status === 'pending_payment') {
            $booking->update(['status' => 'cancelled']);
            $booking->schedule()->delete();
        }
     }
})->everyMinute();