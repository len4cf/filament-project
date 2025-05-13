<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientesResource\Pages;
use App\Filament\Resources\ClientesResource\RelationManagers;
use App\Models\Clientes;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientesResource extends Resource
{
    protected static ?string $model = Clientes::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nome')
                ->required()
                ->maxLength(255)
                ->placeholder('Nome'),
                TextInput::make('email')
                ->required()
                ->maxLength(255)
                ->placeholder('Email'),
                TextInput::make('cpf')
                ->required(),
                TextInput::make('telefone')
                ->required()
                ->maxLength(255)
                ->placeholder('Telefone'),
                Select::make('tipo')
                ->options([
                    'proprietario' => 'proprietario',
                    'interessado' => 'interessado',
                    'inquilino' => 'inquilino',
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome'),
                TextColumn::make('email'),
                TextColumn::make('cpf'),
                TextColumn::make('telefone'),
                Select::make('tipo')
                ->options([
                    'proprietario' => 'proprietario',
                    'interessado' => 'interessado',
                    'inquilino' => 'inquilino',
                ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClientes::route('/'),
            'create' => Pages\CreateClientes::route('/create'),
            'edit' => Pages\EditClientes::route('/{record}/edit'),
        ];
    }
}
