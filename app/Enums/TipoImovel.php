<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TipoImovel: string implements HasLabel, HasColor, HasIcon
{

    case CASA = 'Casa';
    case APARTAMENTO = 'Apartamento';
    case TERRENO = 'Terreno';
    case COMERCIAL = 'Comercial';
    case OUTRO = 'Outro';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::CASA => 'Casa',
            self::APARTAMENTO => 'Apartamento',
            self::TERRENO => 'Terreno',
            self::COMERCIAL => 'Comercial',
            self::OUTRO => 'Outro',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::CASA => 'heroicon-o-home',
            self::APARTAMENTO => 'heroicon-o-building-office',
            self::TERRENO => 'heroicon-o-building-library',
            self::COMERCIAL => 'heroicon-o-briefcase',
            self::OUTRO => 'heroicon-o-question-mark-circle',
        };
    }

    public function getColor(): array
    {
        return match ($this) {
            self::CASA => Color::Red,
            self::APARTAMENTO => Color::Green,
            self::TERRENO => Color::Zinc,
            self::COMERCIAL => Color::Blue,
            self::OUTRO => Color::Orange,
        };
    }

}
