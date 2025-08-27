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

class PenyewaIncomeChart extends ChartWidget
{
    protected static ?string $heading = 'Pendapatan 6 Bulan Terakhir';

    protected function getData(): array
    {
        $penyewaId = Auth::id();

        // Ambil pendapatan per bulan + tahun untuk 6 bulan terakhir
        $data = Payments::whereHas('booking.property', function ($q) use ($penyewaId) {
                $q->where('penyewa_id', $penyewaId);
            })
            ->where('payment_status', 'verified')
            ->where('created_at', '>=', now()->subMonths(6))
            ->selectRaw("DATE_PART('year', created_at) as tahun, DATE_PART('month', created_at) as bulan, SUM(amount) as total")
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->get();

        // Ubah hasil query ke associative array [YYYY-MM => total]
        $dataMap = [];
        foreach ($data as $row) {
            $key = sprintf('%04d-%02d', $row->tahun, $row->bulan); // contoh: 2025-02
            $dataMap[$key] = $row->total;
        }

        // Buat label 6 bulan terakhir
        $labels = [];
        $values = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $key = $date->format('Y-m'); // contoh: 2025-02
            $labels[] = $date->format('M Y'); // contoh: Feb 2025
            $values[] = $dataMap[$key] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan',
                    'data' => $values,
                   'backgroundColor' => 'rgba(79, 70, 229, 0.6)',
                    'borderColor' => 'rgba(79, 70, 229, 1)',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line'; // bisa diganti 'line' kalau mau
    }
}