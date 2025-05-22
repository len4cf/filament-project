<?php

namespace App\Filament\Resources;

use App\Enums\TipoCliente;
use App\Filament\Resources\ClientesResource\Pages;
use App\Filament\Resources\ClientesResource\RelationManagers;
use App\Models\Clientes;
use Faker\Provider\PhoneNumber;
use Filament\Actions\ActionGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientesResource extends Resource
{
    protected static ?string $model = Clientes::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('nome')
                    ->required(),
                    Forms\Components\TextInput::make('email')
                    ->required(),
                    \Leandrocfe\FilamentPtbrFormFields\PhoneNumber::make('telefone')
                        ->mask('(99) 99999-9999')
                    ->required(),
                    Forms\Components\Select::make('tipo')
                    ->options(TipoCliente::class)
                    ->enum(TipoCliente::class)
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                Tables\Grouping\Group::make('tipo')
                ->label('Tipo')
                ->collapsible(),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                ->searchable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('telefone'),
                Tables\Columns\TextColumn::make('tipo')
                ->badge(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tipo')
                ->options(TipoCliente::class)
                ->preload()
                ->multiple()
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                    ->color('secondary'),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                ])->tooltip('Opções')
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
//            'create' => Pages\CreateClientes::route('/create'),
//            'edit' => Pages\EditClientes::route('/{record}/edit'),
        ];
    }
}
