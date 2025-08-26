<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Bookings;
use Carbon\CarbonPeriod;
use Filament\Widgets\ChartWidget;

class BookingChart extends ChartWidget
{
    protected static ?string $heading = 'Booking Information';
    protected static ?string $pollingInterval = '10s';

    protected function getData(): array
    {
        $startDate = Carbon::today()->subDays(9); // tampil 9 hari terakhir termasuk hari ini
        $endDate = Carbon::today();

        // Ambil booking count per tanggal
        $bookings = Bookings::query()
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->pluck('total', 'date');

        // Generate 10 hari terakhir pakai CarbonPeriod
        $period = CarbonPeriod::create($startDate, $endDate);

        $mapped = collect($period)->map(function ($date) use ($bookings) {
            return [
                'label' => $date->format('d M'),
                'value' => $bookings[$date->toDateString()] ?? 0,
            ];
        });

        return [
            'datasets' => [
                [
                    'label' => 'Bookings',
                    'data' => $mapped->pluck('value'),
                    'backgroundColor' => 'rgba(79, 70, 229, 0.6)',
                    'borderColor' => 'rgba(79, 70, 229, 1)',
                    'tension' => 0.3,
                    'fill' => true,
                ],
            ],
            'labels' => $mapped->pluck('label'),
        ];
    }


    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true, // mulai dari 0
                    'min' => 0,            
                ],
            ],
        ];
    }
}
