<?php

namespace App\Filament\Resources\JobReportResource\Pages;

use App\Enums\ReportReasons;
use App\Filament\Resources\JobReportResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJobReport extends ViewRecord
{
    protected static string $resource = JobReportResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['reporter'] = $this->getRecord()->reporter->name;
        $data['reason'] = ReportReasons::getCase($data['reason'])->forJob();
        $data["job"] = $this->getRecord()->reported_job;
        $data["job-owner"] = $this->getRecord()->reported_job->user;

        return $data;
    }
}
