<?php

namespace App\Filament\Resources\ImoveisResource\Pages;

use App\Enums\StatusImoveis;
use App\Enums\TipoImovel;
use App\Filament\Resources\ImoveisResource;
use App\Models\Clientes;
use App\Models\Corretores;
use Filament\Actions;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Actions\EditAction;
use Leandrocfe\FilamentPtbrFormFields\Cep;
use Leandrocfe\FilamentPtbrFormFields\Money;

class ViewImoveis extends ViewRecord
{
    protected static string $resource = ImoveisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('editar')
                ->label('Editar')
                ->icon('heroicon-o-pencil')
                ->url(fn () => static::getResource()::getUrl('edit', ['record' => $this->record->getKey()])),
        ];
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Dados do Imovel')
                    ->collapsible()
                    ->collapsed()
                    ->description('Visualize os dados gerais do imóvel')
                    ->icon('heroicon-o-home')
                    ->schema([
                        Section::make('Geral')
                            ->columns(2)
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextInput::make('titulo')
                                    ->required()
                                    ->maxLength(255),
                                Select::make('tipo')
                                    ->options(TipoImovel::class)
                                    ->required(),
                                Textarea::make('descricao')
                                    ->required()
                                    ->columnSpanFull()
                                    ->maxLength(255)
                                    ->autosize(),
                            ]),
                        Section::make('Endereço')
                            ->icon('heroicon-o-building-office-2')
                            ->columns(3)
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
                                TextInput::make('endereco')->required(),
                                TextInput::make('bairro')->required(),
                                TextInput::make('cidade')->required(),
                                TextInput::make('uf')->label('UF')->required()->maxLength(2),
                            ]),
                        Section::make('Características')
                            ->icon('heroicon-o-cog')
                            ->schema([
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('area')->required()->numeric(),
                                        TextInput::make('num_quartos')->required()->numeric(),
                                        TextInput::make('num_banheiros')->required()->numeric(),
                                    ]),
                                Money::make('valor')->required(),
                                Select::make('status')
                                    ->options(StatusImoveis::class)
                                    ->enum(StatusImoveis::class)
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn (callable $set) => $set('cliente_id', null)),
                                Select::make('inquilino_id')
                                    ->label('Selecionar inquilino')
                                    ->options(Clientes::where('tipo', 'inquilino')->pluck('nome', 'id'))
                                    ->searchable()
                                    ->visible(fn (callable $get) => $get('status') === StatusImoveis::Alugado->value)
                                    ->required(fn (callable $get) => $get('status') === StatusImoveis::Alugado->value),
                                Select::make('proprietario_id')
                                    ->label('Proprietário')
                                    ->options(Clientes::where('tipo', 'proprietario')->pluck('nome', 'id'))
                                    ->searchable()
                                    ->required(),
                                Select::make('corretor_id')
                                    ->label('Corretor Responsável')
                                    ->options(Corretores::pluck('nome', 'id'))
                                    ->searchable(),
                            ]),
                    ])
            ]);
    }


}
