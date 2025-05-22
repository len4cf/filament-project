<?php

namespace App\Enums;


use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusVisita: string implements HasLabel, HasIcon, HasColor
{

    case REALIZADA = 'Realizada';
    case CANCELADA = 'Cancelada';
    case AGENDADA = 'Agendada';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::REALIZADA => 'Realizada',
            self::CANCELADA => 'Cancelada',
            self::AGENDADA => 'Agendada',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::REALIZADA => 'heroicon-o-check-circle',
            self::CANCELADA => 'heroicon-o-x-circle',
            self::AGENDADA => 'heroicon-o-clock',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::REALIZADA => Color::Green,
            self::CANCELADA => Color::Red,
            self::AGENDADA => Color::Yellow,
        };
    }


}
