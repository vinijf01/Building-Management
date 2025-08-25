<?php

namespace App\Filament\Penyewa\Resources\BookingsResource\Pages;

use App\Filament\Penyewa\Resources\BookingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookings extends EditRecord
{
    protected static string $resource = BookingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['payment_status'])) {
            $payment = $this->record->payment;

            if ($payment) { // pastikan payment tidak null
                if ($data['payment_status'] === 'verified') {
                    $payment->update(['payment_status' => 'verified']);
                    $this->record->update(['status' => 'confirmed']);
                }

                if ($data['payment_status'] === 'rejected') {
                    $payment->update([
                        'payment_status' => 'rejected',
                        'remark' => $data['payment']['remark'] ?? null,
                    ]);

                    $this->record->update(['status' => 'pending_payment']);
                }

                if ($data['payment_status'] === 'cancelled') {
                    $payment->update([
                        'payment_status' => 'cancelled',
                        'remark' => $data['payment']['remark'] ?? null, // simpan remark
                    ]);
                    $this->record->update(['status' => 'cancelled']);
                    $this->record->schedule()->delete();
                }
            }
        }

        return $data;
    }
}
