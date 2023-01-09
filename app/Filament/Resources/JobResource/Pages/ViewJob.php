<?php

namespace App\Filament\Resources\JobResource\Pages;

use App\Filament\Resources\JobResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJob extends ViewRecord
{
    protected static string $resource = JobResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['company'] = $this->getRecord()->user->load("profile");

        return $data;
    }
}
