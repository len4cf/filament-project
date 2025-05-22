<?php

namespace App\Filament\Resources\CorretoresResource\Pages;

use App\Filament\Resources\CorretoresResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCorretores extends ListRecords
{
    protected static string $resource = CorretoresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
