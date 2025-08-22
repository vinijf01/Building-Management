<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Bookings;
use App\Models\Properties;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsCountOverview extends BaseWidget
{

    protected function getStats(): array
    {

        return [
            Stat::make('Users', User::count())
                ->description('Total users')
                ->descriptionIcon('heroicon-o-user-group', position: 'before')
                ->color('primary')
                ->url(route('filament.admin.resources.users.index')),
            Stat::make('Rooms', Properties::count())
                ->description('Total rooms')
                ->descriptionIcon('heroicon-o-building-office-2', position: 'before')
                ->color('primary')
                ->url(route('filament.admin.resources.bookings.index')),
            Stat::make('Bookings', Bookings::count())
                ->descriptionIcon('heroicon-o-ticket', position: 'before')
                ->description('Total bookings')
                ->color('primary')
                ->url(route('filament.admin.resources.properties.index')),
        ];
    }
}
