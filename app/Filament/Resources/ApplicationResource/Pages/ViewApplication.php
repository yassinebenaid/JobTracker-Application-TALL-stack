<?php

namespace App\Filament\Resources\ApplicationResource\Pages;

use App\Filament\Resources\ApplicationResource;
use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Model;

class ViewApplication extends ViewRecord
{
    protected static string $resource = ApplicationResource::class;

    protected function getActions(): array
    {
        return [
            Action::make("Job")->url(fn () => route("filament.resources.jobs.view", $this->getRecord()->job_id))->outlined(),
            Action::make("Company")->url(fn () => route("filament.resources.companies.view", $this->getRecord()->company_id))->outlined(),
            Action::make("Emploee")->url(fn () => route("filament.resources.emloees.view", $this->getRecord()->emploee_id))->outlined()
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['company'] = $this->getRecord()->company->load('profile');
        $data['emploee'] = $this->getRecord()->emploee->load('profile');
        $data['job'] = $this->getRecord()->job;

        return $data;
    }
}
