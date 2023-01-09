<?php

namespace App\Filament\Resources\CompanyReportResource\Pages;

use App\Filament\Resources\CompanyReportResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompanyReports extends ListRecords
{
    protected static string $resource = CompanyReportResource::class;

    protected function getActions(): array
    {
        return [];
    }
}
