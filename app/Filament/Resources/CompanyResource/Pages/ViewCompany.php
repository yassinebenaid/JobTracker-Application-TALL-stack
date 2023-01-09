<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\ComponentProvider;
use App\Filament\Resources\CompanyResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCompany extends ViewRecord
{
    protected static string $resource = CompanyResource::class;

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
