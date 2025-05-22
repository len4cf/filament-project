<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TipoCliente: string implements HasLabel, HasColor
{

    case Inquilino = 'Inquilino';
    case Proprietario = 'Proprietario';
    case Interessado = 'Interessado';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Inquilino => 'Inquilino',
            self::Proprietario => 'Proprietario',
            self::Interessado => 'Interessado',
        };
    }

    public function getColor(): array
    {
        return match ($this) {
            self::Inquilino => Color::Yellow,
            self::Proprietario => Color::Red,
            self::Interessado => Color::Green,
        };
    }

    public static function fromValue(string $value): static
    {
        return match ($value) {
            '0' => self::Inquilino,
            '1' => self::Proprietario,
            '2' => self::Interessado,
        };
    }

}
