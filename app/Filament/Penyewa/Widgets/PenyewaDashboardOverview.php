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
            ->where('status', 'pending')
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

/**
 * Widget Chart Pendapatan Bulanan
 */
class PenyewaIncomeChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pendapatan Bulanan';
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $penyewaId = Auth::id();

        // PostgreSQL-friendly: gunakan EXTRACT(MONTH FROM created_at)
        $income = Payments::whereHas('booking.property', function ($q) use ($penyewaId) {
                $q->where('penyewa_id', $penyewaId);
            })
            ->where('payment_status', 'verified')
            ->whereYear('created_at', now()->year)
            ->selectRaw('EXTRACT(MONTH FROM created_at) AS bulan, SUM(amount) AS total')
            ->groupByRaw('EXTRACT(MONTH FROM created_at)')
            ->orderByRaw('EXTRACT(MONTH FROM created_at)')
            ->pluck('total', 'bulan')
            ->toArray();

       // Lengkapi 12 bulan (Jan–Des)
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = isset($income[$i]) ? (float) $income[$i] : 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan',
                    'data' => $data,
                    'backgroundColor' => 'rgba(79, 70, 229, 0.6)',
                    'borderColor' => 'rgba(79, 70, 229, 1)',
                    'fill' => true,
                ],
            ],
            'labels' => [
                'Jan','Feb','Mar','Apr','Mei','Jun',
                'Jul','Agu','Sep','Okt','Nov','Des'
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line'; // bisa diganti 'bar' kalau mau
    }
}
