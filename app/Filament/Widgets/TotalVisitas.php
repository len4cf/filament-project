<?php

namespace App\Filament\Widgets;

use App\Models\Imoveis;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalVisitas extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total de visitas', Imoveis::count())
                ->description('Número total visitas')
                ->icon('heroicon-o-calendar-days')
                ->color('success'),
        ];
    }



}
