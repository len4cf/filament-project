<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CorretoresResource\Pages;
use App\Filament\Resources\CorretoresResource\RelationManagers;
use App\Models\Corretores;
use Filament\Actions\ActionGroup;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section as InfoListSection;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CorretoresResource extends Resource
{
    protected static ?string $model = Corretores::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('nome')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Digite o nome do corretor'),
                    Forms\Components\TextInput::make('email')
                    ->email()
                        ->required()
                    ->maxLength(255)
                    ->placeholder('Digite o email do corretor'),
                    Forms\Components\TextInput::make('creci')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Digite o creci do corretor'),
                    Forms\Components\TextInput::make('telefone')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Digite o telefone do corretor'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('creci'),
                Tables\Columns\TextColumn::make('telefone'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                    ->color('secondary'),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

//    public static function infolist(Infolist $infolist): Infolist
//    {
//        return $infolist->schema([
//            InfoListSection::make([
//                TextEntry::make('nome')
//                ->label('Nome')
//
//            ])
//            ->columnSpan(2),
//            InfoListSection::make([])
//            ->columnSpan(1)
//        ])
//            ->columns(3);
//    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCorretores::route('/'),
            'create' => Pages\CreateCorretores::route('/create'),
            'edit' => Pages\EditCorretores::route('/{record}/edit'),
        ];
    }
}
