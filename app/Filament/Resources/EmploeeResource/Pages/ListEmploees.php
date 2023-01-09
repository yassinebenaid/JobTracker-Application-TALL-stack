<?php

namespace App\Filament\Resources\EmploeeResource\Pages;

use App\Filament\Resources\EmploeeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmploees extends ListRecords
{
    protected static string $resource = EmploeeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
