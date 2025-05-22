<?php

namespace App\Filament\Resources;

use App\Enums\StatusImoveis;
use App\Enums\TipoImovel;
use App\Filament\Resources\ImoveisResource\Pages;
use App\Filament\Resources\ImoveisResource\RelationManagers;
use App\Models\Clientes;
use App\Models\Corretores;
use App\Models\Imoveis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section as InfoListSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Leandrocfe\FilamentPtbrFormFields\Cep;
use Leandrocfe\FilamentPtbrFormFields\Money;

class ImoveisResource extends Resource
{
    protected static ?string $model = Imoveis::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Geral')
                        ->icon('heroicon-o-information-circle')
                    ->schema([
                        Forms\Components\TextInput::make('titulo')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Titulo'),
                        Forms\Components\Select::make('tipo')
                            ->options(TipoImovel::class)
                            ->required()
                            ->placeholder('Escolha o tipo do imóvel'),
                        Forms\Components\Textarea::make('descricao')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Descricao')
                            ->autosize(),
                    ]),
                    Forms\Components\Wizard\Step::make('Endereco')
                        ->columns(2)
                        ->icon('heroicon-o-building-office-2')
                    ->schema([
                        Cep::make('cep')
                            ->viaCep(
                                mode: 'suffix',
                                errorMessage: 'CEP inválido.',
                                setFields: [
                                    'endereco' => 'logradouro',
                                    'bairro' => 'bairro',
                                    'cidade' => 'localidade',
                                    'uf' => 'uf'
                                ]
                            ),
                        Forms\Components\TextInput::make('endereco')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bairro')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('cidade')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('uf')
                            ->label('UF')
                            ->required()
                            ->maxLength(2),
                    ]),
                    Forms\Components\Wizard\Step::make('Caracteristicas')
                        ->icon('heroicon-o-cog')
                    ->schema([
                        Forms\Components\Section::make()
                            ->columns(3)
                        ->schema([
                            Forms\Components\TextInput::make('area')
                                ->required()
                                ->numeric()
                                ->maxLength(10),
                            Forms\Components\TextInput::make('num_quartos')
                                ->required()
                                ->maxLength(10)
                                ->numeric(),
                            Forms\Components\TextInput::make('num_banheiros')
                                ->required()
                                ->maxLength(10)
                                ->numeric(),
                        ]),
                        Money::make('valor')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('caminho')
                            ->label('Foto')
                            ->hiddenOn('edit')
                            ->image()
                            ->directory('imoveis/fotos')
                            ->disk('public')
                            ->imagePreviewHeight('200')
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->options(StatusImoveis::class)
                            ->enum(StatusImoveis::class)
                            ->required()
                            ->placeholder('Status')
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('cliente_id', null)),
                        Forms\Components\Select::make('inquilino_id')
                            ->label('Selecionar inquilino')
                            ->options(Clientes::where('tipo', 'inquilino')->pluck('nome', 'id'))
                            ->searchable()
                            ->visible(fn (callable $get) => $get('status') === StatusImoveis::Alugado->value)
                            ->required(fn (callable $get) => $get('status') === StatusImoveis::Alugado->value),
                        Forms\Components\Select::make('proprietario_id')
                            ->label('Proprietário')
                            ->options(Clientes::where('tipo', 'proprietario')->pluck('nome', 'id'))
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('corretor_id')
                            ->label('Corretor Responsável')
                            ->options(Corretores::query()->pluck('nome', 'id'))
                            ->searchable()
                            ->required(false),
                    ])
                ])
                    ->columnSpanFull()
                ->skippable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                Tables\Grouping\Group::make('status')
                ->label('Status')
                ->collapsible()
            ])
            ->columns([
                Tables\Columns\TextColumn::make('id')
                ->label('ID'),
                Tables\Columns\TextColumn::make('titulo')
                ->label('Titulo')
                ->searchable(),
                Tables\Columns\TextColumn::make('tipo')
                ->label('Tipo')
                ->searchable(),
                Tables\Columns\TextColumn::make('cidade')
                ->label('Cidade')
                ->searchable(),
                Tables\Columns\TextColumn::make('uf')
                ->label('UF')
                ->searchable(),
                Tables\Columns\TextColumn::make('area')
                ->label('Area (m2)')
                ->searchable(),
                Tables\Columns\TextColumn::make('valor')
                    ->money('brl')
                ->label('Valor')
                ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('proprietario.nome')
                ->label('Proprietário')
                ->searchable(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                ->options(StatusImoveis::class)
                ->preload()
                ->multiple()
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation(),
                ])->tooltip('Opções')
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
//                TextEntry::make('titulo')
//                    ->size('lg')
//                    ->weight('bold')
//                    ->hiddenLabel(),
//
//
//            ])
//                ->columnSpan(2),
//            InfoListSection::make([])
//                ->columnSpan(1)
//        ])
//            ->columns(3);
//    }


    public static function getRelations(): array
    {
        return [
            RelationManagers\VisitasRelationManager::class,
            RelationManagers\FotosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListImoveis::route('/'),
//            'create' => Pages\CreateImoveis::route('/create'),
            'view' => Pages\ViewImoveis::route('/{record}'),
            'edit' => Pages\EditImoveis::route('/{record}/edit'),
//            'fotos-gallery' => Pages\ImovelFotosGallery::route('/{record}/fotos-gallery'),
        ];
    }
}
