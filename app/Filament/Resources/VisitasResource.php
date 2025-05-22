<?php

namespace App\Filament\Resources;

use App\Enums\StatusVisita;
use App\Filament\Resources\VisitasResource\Pages;
use App\Filament\Resources\VisitasResource\RelationManagers;
use App\Models\Clientes;
use App\Models\Corretores;
use App\Models\Imoveis;
use App\Models\Visitas;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VisitasResource extends Resource
{
    protected static ?string $model = Visitas::class;
    protected static ?string $navigationLabel = 'Visitas';
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Agendar Visita')
                ->schema([
                    Forms\Components\Select::make('imovel_id')
                        ->label('Imóvel')
                        ->searchable()
                        ->options(function () {
                            return Imoveis::limit(20)->pluck('titulo', 'id');
                        })
                        ->getSearchResultsUsing(function (string $search) {
                            return Imoveis::query()
                                ->where('titulo', 'like', "%{$search}%")
                                ->orWhere('id', $search)
                                ->limit(20)
                                ->pluck('titulo', 'id');
                        })
                        ->getOptionLabelUsing(function ($value): ?string {
                            $imovel = Imoveis::find($value);
                            return $imovel ? "{$imovel->id} - {$imovel->titulo}" : null;
                        })
                        ->placeholder('Digite o ID ou o nome do imovel')
                        ->required(),
                    Forms\Components\Select::make('cliente_id')
                        ->label('Cliente interessado')
                        ->options(\App\Models\Clientes::where('tipo', 'interessado')->pluck('nome', 'id'))
                        ->searchable()
                        ->required(),
                    Forms\Components\Select::make('corretor_id')
                        ->label('Corretor')
                        ->options(Corretores::all()->pluck('nome', 'id'))
                        ->searchable()
                        ->required(),
                    Forms\Components\DateTimePicker::make('data_hora')
                        ->label('Data e Hora da Visita')
                        ->required(),
                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->options(StatusVisita::class)
                        ->required(),
                    Forms\Components\Textarea::make('observacoes')
                        ->label('Observações')
                        ->columnSpanFull()
                        ->nullable()
                        ->autosize()
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('imovel.titulo'),
                TextColumn::make('cliente.nome')
                ->label("Cliente Interessado"),
                TextColumn::make('corretor.nome')
                ->label("Corretor Responsavel"),
                TextColumn::make('data_hora'),
                TextColumn::make('status'),
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
            'index' => Pages\ListVisitas::route('/'),
//            'create' => Pages\CreateVisitas::route('/create'),
//            'edit' => Pages\EditVisitas::route('/{record}/edit'),
        ];
    }
}
