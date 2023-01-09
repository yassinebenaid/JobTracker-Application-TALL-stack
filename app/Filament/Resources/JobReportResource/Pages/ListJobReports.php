<?php

namespace App\Filament\Resources\JobReportResource\Pages;

use App\Filament\Resources\JobReportResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJobReports extends ListRecords
{
    protected static string $resource = JobReportResource::class;

    protected function getActions(): array
    {
        return [];
    }
}
