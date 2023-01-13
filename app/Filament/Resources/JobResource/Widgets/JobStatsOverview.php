<?php

namespace App\Filament\Resources\JobResource\Widgets;

use App\Models\Job;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class JobStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make("Total jobs", shortenNumber(Job::count())),
            Card::make("Average of salaries", shortenNumber(Job::avg("salary")))
        ];
    }
}
