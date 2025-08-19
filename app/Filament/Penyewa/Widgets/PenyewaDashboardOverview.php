<?php

namespace App\Filament\Penyewa\Widgets;

use App\Models\Booking;
use App\Models\Bookings;
use App\Models\Payment;
use App\Models\Payments;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\Auth;

class PenyewaDashboardOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $penyewaId = Auth::id(); // user yang login di panel penyewa

        // Total properti yang disewa milik penyewa ini
        $totalProperti = Bookings::whereHas('property', function ($q) use ($penyewaId) {
                $q->where('penyewa_id', $penyewaId);
            })
            ->where('status', 'confirmed') // atau 'confirmed' kalau mau aktif
            ->count();

        // Pembayaran yang belum lunas untuk properti milik penyewa ini
        $pembayaranBelumLunas = Payments::whereHas('booking.property', function ($q) use ($penyewaId) {
                $q->where('penyewa_id', $penyewaId);
            })
            ->where('payment_status', 'pending_verification')
            ->count();

        // Jadwal booking terdekat untuk properti milik penyewa ini
        $jadwalTerdekat = Bookings::whereHas('property', function ($q) use ($penyewaId) {
                $q->where('penyewa_id', $penyewaId);
            })
            ->where('status', 'confirmed')
            ->orderBy('start_date', 'asc')
            ->value('start_date');

        return [
            Card::make('Total Properti Disewa', $totalProperti)
                ->description('Properti aktif saat ini')
                ->descriptionIcon('heroicon-o-home')
                ->color('primary'),

            Card::make('Pembayaran Belum Lunas', $pembayaranBelumLunas)
                ->description('Menunggu verifikasi admin')
                ->descriptionIcon('heroicon-o-credit-card')
                ->color('danger'),

            Card::make(
                'Jadwal Booking Terdekat',
                $jadwalTerdekat ? date('d M Y', strtotime($jadwalTerdekat)) : 'Tidak ada'
            )
                ->description('Tanggal mulai sewa berikutnya')
                ->descriptionIcon('heroicon-o-calendar')
                ->color('success'),
        ];
    }
}
