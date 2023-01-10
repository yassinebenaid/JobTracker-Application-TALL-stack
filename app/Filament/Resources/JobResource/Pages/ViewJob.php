<?php

namespace App\Filament\Resources\JobResource\Pages;

use App\Filament\Resources\JobResource;
use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewJob extends ViewRecord
{
    protected static string $resource = JobResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
            Action::make("View Owner")->url(fn () => route("filament.resources.companies.view", $this->getRecord()->user->id))->outlined()
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['company'] = $this->getRecord()->user->load("profile");

        $data['skills'] = $this->getRecord()->skills->pluck('name');

        $data['criteria'] = collect($data['criteria'])->incrementKeys();

        return $data;
    }
}
