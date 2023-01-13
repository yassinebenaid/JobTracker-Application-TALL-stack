<?php

namespace App\Filament\Resources\JobResource\Pages;

use App\Filament\Resources\JobResource;
use App\Filament\Resources\JobResource\Widgets\JobStatsOverview;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJobs extends ListRecords
{
    protected static string $resource = JobResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            JobStatsOverview::class
        ];
    }
}
