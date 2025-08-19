<?php

namespace App\Filament\Penyewa\Resources\PaymentsResource\Pages;

use App\Filament\Penyewa\Resources\PaymentsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPayments extends EditRecord
{
    protected static string $resource = PaymentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $payment = $this->record; // model
        if ($payment->payment_status === 'verified' && $payment->booking) {
            $payment->booking->update(['status' => 'confirmed']);
        }

        if ($payment->payment_status === 'rejected' && $payment->booking) {
            $payment->booking->update(['status' => 'cancelled']);
            $payment->booking->schedule()->delete();
        }
    }
}
