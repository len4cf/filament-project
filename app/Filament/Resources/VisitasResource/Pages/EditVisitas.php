<?php

namespace App\Filament\Resources\VisitasResource\Pages;

use App\Filament\Resources\VisitasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVisitas extends EditRecord
{
    protected static string $resource = VisitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
