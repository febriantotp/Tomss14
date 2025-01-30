<?php

namespace App\Filament\Resources\GameRequestResource\Pages;

use App\Filament\Resources\GameRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGameRequests extends ListRecords
{
    protected static string $resource = GameRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
