<?php

namespace App\Filament\Widgets;

use App\Models\Game;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class TotalUploadedGames extends BaseWidget
{
    protected ?string $heading = 'Uploaded Games';
    protected function getCards(): array
    {
        return [
            Card::make('Total Uploaded Games', Game::count()),
            Card::make('Total Windows Games', Game::where('platform_id', 1)->count()),
            Card::make('Total PS1 Games', Game::where('platform_id', 2)->count()),
            Card::make('Total PS2 Games', Game::where('platform_id', 3)->count()),
        ];
    }
}
