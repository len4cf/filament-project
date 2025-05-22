<?php

namespace App\Filament\Resources\CorretoresResource\Pages;

use App\Filament\Resources\CorretoresResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCorretores extends EditRecord
{
    protected static string $resource = CorretoresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
