<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Payments;
use App\Models\Schedules;

class CancelExpiredBookings extends Command
{
    protected $signature = 'bookings:cancel-expired {--dry-run : Only log what would happen}';
    protected $description = 'Cancel bookings whose payment window has expired (24h), and clean up schedules.';

    public function handle(): int
    {
        $dry = (bool) $this->option('dry-run');
        $now = now();

        // We process only PENDING payments past due date, whose booking is still pending_payment.
        // Chunk for memory & lock safety in high volume.
        $countAffected = 0;

        Payments::query()
            ->where('payment_status', 'pending_verification')
            ->where('payment_due_date', '<', $now)
            ->with(['booking:id,property_id,status'])     // eager load the booking
            ->whereHas('booking', fn($q) => $q->where('status', 'pending_payment'))
            ->orderBy('id')
            ->chunkById(200, function ($payments) use (&$countAffected, $dry) {
                foreach ($payments as $payment) {
                    DB::transaction(function () use ($payment, $dry, &$countAffected) {
                        // Re-fetch with FOR UPDATE to avoid race conditions if workers run in parallel
                        $booking = $payment->booking()->lockForUpdate()->first();

                        if (!$booking || $booking->status !== 'pending_payment') {
                            return; // already handled by another process
                        }

                        if ($dry) {
                            Log::info('[DRY RUN] Would cancel booking', [
                                'booking_id' => $booking->id,
                                'payment_id' => $payment->id,
                            ]);
                            return;
                        }

                        // 1) Cancel booking
                        $booking->update(['status' => 'cancelled']);

                        // 2) Cancel payment
                        $payment->update(['payment_status' => 'cancelled']);

                        // 3) Delete schedules rows for this booking
                        Schedules::where('booking_id', $booking->id)->delete();

                        $countAffected++;
                    });
                }
            });

        $msg = "Expired booking cleanup finished. Affected: {$countAffected}";
        $this->info($msg);
        Log::info($msg);

        return self::SUCCESS;
    }
}
