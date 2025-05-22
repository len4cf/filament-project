<?php

namespace App\Filament\Resources\ImoveisResource\Pages;

use App\Filament\Resources\ImoveisResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListImoveis extends ListRecords
{
    protected static string $resource = ImoveisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

//    public function getTabs(): array
//    {
//        $tabs = [];
//        $tabs['Todos']= \Filament\Resources\Pages\ListRecords\Tab::make()
//            ->icon('heroicon-o-bars-3');
//        $tabs['Aluguel']= Tab::make()
//            ->icon('heroicon-o-building-office-2')
//            ->modifyQueryUsing(function ($query){
//                return $query->where('status', 'aluguel');
//            });
//        $tabs['A venda']= Tab::make()
//            ->icon('heroicon-o-building-office-2')
//            ->modifyQueryUsing(function ($query){
//                return $query->where('status', 'a_venda');
//            });
//        $tabs['Vendido']= Tab::make()
//            ->icon('heroicon-o-building-office-2')
//            ->modifyQueryUsing(function ($query){
//                return $query->where('status', 'vendido');
//            });
//        return $tabs;
//    }
}
