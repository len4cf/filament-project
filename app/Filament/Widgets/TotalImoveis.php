<?php

namespace App\Filament\Widgets;

use App\Models\Imoveis;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalImoveis extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total de Imóveis', Imoveis::count())
                ->description('Número total cadastrado')
                ->icon('heroicon-o-home')
                ->color('success'),
        ];
    }



}
