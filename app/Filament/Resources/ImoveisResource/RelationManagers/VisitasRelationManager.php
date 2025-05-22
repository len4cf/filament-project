<?php

namespace App\Filament\Resources\ImoveisResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class VisitasRelationManager extends RelationManager
{
    protected static string $relationship = 'visitas';

//    public function form(Form $form): Form
//    {
//        return $form
//            ->schema([
//                Forms\Components\DateTimePicker::make('data_hora')->required(),
//                Forms\Components\Textarea::make('observacoes')->columnSpanFull(),
//                Forms\Components\Select::make('corretor_id')
//                    ->relationship('corretor', 'nome')
//                    ->required(),
//                Forms\Components\Select::make('cliente_id')
//                    ->relationship('cliente', 'nome')
//                    ->required(),
//            ]);
//    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Visitas')
            ->columns([
                Tables\Columns\TextColumn::make('data_hora')->dateTime('d/m/Y H:i'),
                Tables\Columns\TextColumn::make('cliente.nome')->label('Cliente'),
                Tables\Columns\TextColumn::make('corretor.nome')->label('Corretor'),
                Tables\Columns\TextColumn::make('status')->label('Status'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
