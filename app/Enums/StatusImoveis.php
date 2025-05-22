<?php

namespace App\Enums;



use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusImoveis: string implements HasLabel, HasIcon, HasColor
{

    case VENDA = 'A venda';
    case VENDIDO = 'Vendido';
    case ALUGUEL = 'Aluguel';
    case Alugado = 'Alugado';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::VENDA => "À venda",
            self::VENDIDO => "Vendido",
            self::ALUGUEL => "Aluguel",
            self::Alugado => "Alugado",
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::VENDA => 'heroicon-o-currency-dollar',
            self::VENDIDO => 'heroicon-o-check-circle',
            self::ALUGUEL => 'heroicon-o-key',
            self::Alugado => 'heroicon-o-document-currency-dollar',
        };
    }

    public function getColor(): array
    {
        return match ($this) {
            self::VENDA => \Filament\Support\Colors\Color::Red,
            self::VENDIDO => \Filament\Support\Colors\Color::Green,
            self::ALUGUEL => \Filament\Support\Colors\Color::Blue,
            self::Alugado => \Filament\Support\Colors\Color::Yellow,
        };
    }

    public static function fromValue(string $value): static
    {
        return match ($value) {
            '0' => self::VENDA,
            '1' => self::VENDIDO,
            '2' => self::ALUGUEL,
            '3' => self::Alugado,
        };
    }

}
