<?php

namespace App\Filament\Resources\EmploeeResource\Pages;

use App\Filament\ComponentProvider;
use App\Filament\Resources\EmploeeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEmploee extends ViewRecord
{
    protected static string $resource = EmploeeResource::class;

    protected function getActions(): array
    {
        return [
            ComponentProvider::getEmailVeificationPageAction($this->getRecord()),
            Actions\EditAction::make(),
        ];
    }


    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['profile'] = $this->getRecord()->profile;
        return $data;
    }
}
