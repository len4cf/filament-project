<?php

namespace App\Filament\Admin\Themes;

use Filament\Panel;
use Hasnayeen\Themes\Contracts\CanModifyPanelConfig;
use Hasnayeen\Themes\Contracts\Theme;

class Awesome implements CanModifyPanelConfig, Theme
{
    public static function getName(): string
    {
        return 'awesome';
    }

    public static function getPath(): string
    {
        return 'resources/css/filament/admin/themes/awesome.css';
    }

    public function getThemeColor(): array
    {
        return [
            'primary' => '#D5451B',
        ];
    }

    public function modifyPanelConfig(Panel $panel): Panel
    {
        return $panel
            ->viteTheme($this->getPath());
    }
}
