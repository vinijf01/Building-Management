<?php

namespace App\Filament\Penyewa\Widgets;

use App\Models\Bookings;
use App\Models\Payments;
use App\Models\Properties;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

/**
 * Widget Statistik Ringkas
 */
class PenyewaDashboardOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 'full'; // widget full width

    protected function getCards(): array
    {
        $penyewaId = Auth::id();

        // 1. Total Properti
        $totalProperti = Properties::where('penyewa_id', $penyewaId)->count();

        // 2. Properti Sedang Disewa
        $totalDisewa = Bookings::whereHas('property', function ($q) use ($penyewaId) {
                $q->where('penyewa_id', $penyewaId);
            })
            ->where('status', 'confirmed')
            ->count();

        // 3. Booking Menunggu Konfirmasi
        $bookingMenunggu = Bookings::whereHas('property', function ($q) use ($penyewaId) {
                $q->where('penyewa_id', $penyewaId);
            })
            ->where('status', 'pending_payment')
            ->count();

        // 4. Pembayaran Belum Diverifikasi
        $pembayaranBelumLunas = Payments::whereHas('booking.property', function ($q) use ($penyewaId) {
                $q->where('penyewa_id', $penyewaId);
            })
            ->where('payment_status', 'pending_verification')
            ->count();

        // 5. Pendapatan Bulan Ini
        $pendapatanBulanIni = Payments::whereHas('booking.property', function ($q) use ($penyewaId) {
                $q->where('penyewa_id', $penyewaId);
            })
            ->where('payment_status', 'verified')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        // 6. Jadwal Booking Terdekat
        $jadwalTerdekat = Bookings::whereHas('property', function ($q) use ($penyewaId) {
                $q->where('penyewa_id', $penyewaId);
            })
            ->where('status', 'confirmed')
            ->orderBy('start_date', 'asc')
            ->value('start_date');

        return [
            Card::make('Total Properti', $totalProperti)
                ->description('Jumlah properti terdaftar')
                ->descriptionIcon('heroicon-o-building-office')
                ->color('primary'),

            Card::make('Properti Sedang Disewa', $totalDisewa)
                ->description('Sedang aktif disewa customer')
                ->descriptionIcon('heroicon-o-home')
                ->color('success'),

            Card::make('Booking Menunggu Konfirmasi', $bookingMenunggu)
                ->description('Butuh approve / reject')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),

            Card::make('Pembayaran Belum Diverifikasi', $pembayaranBelumLunas)
                ->description('Menunggu verifikasi pembayaran')
                ->descriptionIcon('heroicon-o-credit-card')
                ->color('danger'),

            Card::make('Pendapatan Bulan Ini', 'Rp ' . number_format($pendapatanBulanIni, 0, ',', '.'))
                ->description('Total pembayaran terverifikasi')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success'),

            Card::make(
                'Jadwal Booking Terdekat',
                $jadwalTerdekat ? date('d M Y', strtotime($jadwalTerdekat)) : 'Tidak ada'
            )
                ->description('Tanggal mulai sewa berikutnya')
                ->descriptionIcon('heroicon-o-calendar')
                ->color('info'),
        ];
    }
}


