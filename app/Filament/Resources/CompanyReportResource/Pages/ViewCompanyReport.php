<?php

namespace App\Filament\Resources\CompanyReportResource\Pages;

use App\Enums\ReportReasons;
use App\Filament\Resources\CompanyReportResource;
use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewCompanyReport extends ViewRecord
{
    protected static string $resource = CompanyReportResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('View company')->url(fn () => route("filament.resources.companies.view", $this->getRecord()->reported_company->id))->outlined(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['reporter'] = $this->getRecord()->reporter->name;
        $data['reason'] = ReportReasons::getCase($data['reason'])->forCompany();
        $data["company"] = $this->getRecord()->reported_company;

        return $data;
    }
}
