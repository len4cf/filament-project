<?php

namespace App\Filament\Resources\ImoveisResource\RelationManagers;

use App\Filament\Resources\ImoveisResource\Pages\ImovelFotosGallery;
use App\Models\ImovelFotos;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section as InfoListSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Table;

class FotosRelationManager extends RelationManager
{

    protected static string $relationship = 'fotos';
    protected static ?string $title = 'Fotos do Imóvel';
    protected static ?string $recordTitleAttribute = 'caminho';


    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\FileUpload::make('caminho')
                ->label('Foto')
                ->image()
                ->directory('imoveis/fotos')
                ->disk('public')
                ->imagePreviewHeight('200')
                ->required(),
        ]);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            InfoListSection::make([

                ImageEntry::make('caminho')
                ->label('Foto')
                ->size('lg')

            ])
        ]);
    }

    public function table(Table $table): Table
    {

        return $table

            ->columns([
                Tables\Columns\ImageColumn::make('caminho')
                    ->disk('public')
                    ->label('Foto')
                    ->height(100),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
//                Tables\Actions\Action::make('ver_fotos')
//                    ->label('Ver Fotos')
//                    ->url(fn () => route('filament.admin.resources.imoveis.fotos-gallery', ['record' => $this->ownerRecord->id]))
//                    ->icon('heroicon-o-photo')
//                    ->size(ActionSize::Small),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
