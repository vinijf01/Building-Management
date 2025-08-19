<?php

namespace App\Filament\Penyewa\Widgets;

use App\Models\Payments;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class PenyewaIncomeChart extends ChartWidget
{
    protected static ?string $heading = 'Pendapatan 6 Bulan Terakhir';

    protected function getData(): array
    {
        $penyewaId = Auth::id();

        // Ambil pendapatan per bulan untuk 6 bulan terakhir
        $data = Payments::whereHas('booking.property', function ($q) use ($penyewaId) {
                $q->where('penyewa_id', $penyewaId);
            })
            ->where('payment_status', 'verified')
            ->where('created_at', '>=', now()->subMonths(6))
            ->selectRaw('MONTH(created_at) as bulan, SUM(amount) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // Label bulan (dari sekarang mundur 6 bulan)
        $labels = [];
        $values = [];

        for ($i = 5; $i >= 0; $i--) {
            $bulan = now()->subMonths($i)->month;
            $labels[] = now()->subMonths($i)->format('M Y');
            $values[] = $data[$bulan] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan',
                    'data' => $values,
                    'backgroundColor' => '#4ade80', // hijau
                    'borderColor' => '#22c55e',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // bisa 'line' atau 'bar'
    }
}
