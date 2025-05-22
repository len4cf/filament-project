<?php

namespace App\Filament\Resources\ImoveisResource\Pages;

use Filament\Resources\Pages\Page;
use App\Models\Imoveis;
use Illuminate\Contracts\View\View;

class ImovelFotosGallery extends Page
{
    protected static string $resource = 'App\Filament\Resources\ImoveisResource';

    protected static ?string $route = '/{record}/fotos-gallery';


    public $record;
    public $imovel;

    public function mount($record): void
    {

        $this->record = Imoveis::with(['fotos', 'proprietario', 'corretor', 'inquilino'])->findOrFail($record);

    }

    public function render(): View
    {
        return view('filament.resources.imoveis-resource.pages.imovel-fotos-gallery', [
            'record' => $this->record,
        ]);
    }

}
