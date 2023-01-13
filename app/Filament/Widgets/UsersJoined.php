<?php

namespace App\Filament\Widgets;

use App\Enums\Roles;
use App\Helpers\Stats;
use App\Models\User;
use Filament\Widgets\LineChartWidget;

class UsersJoined extends LineChartWidget
{
    protected static ?string $heading = 'Users Joined this year';
    protected static ?string $pollingInterval = '60s';
    protected int|string|array $columnSpan = 2;
    protected static ?string $maxHeight = "450px";


    protected function getData(): array
    {
        $companyStats = Stats::make(User::company());
        $emploeeStats = Stats::make(User::emploee());

        return [
            'datasets' => [
                [
                    'label' => 'Companies',
                    'data' => $companyStats->thisYearByMonth(),
                    "fill" => false,
                    "borderColor" => 'rgb(75, 192, 192)',
                    "tension" => 0.1
                ],
                [
                    'label' => 'Emploees',
                    'data' => $emploeeStats->thisYearByMonth(),
                    "fill" => false,
                    "borderColor" => '#3F51B5',
                    "tension" => 0.1
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getPollingInterval(): ?string
    {
        return "60s";
    }
}
