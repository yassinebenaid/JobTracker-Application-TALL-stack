<?php

namespace App\Filament\Widgets;

use App\Enums\JobTypes;
use App\Models\Job;
use Filament\Widgets\DoughnutChartWidget;

class JobsTypesOverview extends DoughnutChartWidget
{
    protected static ?string $heading = 'Job Types';
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 2;
    protected static ?string $maxHeight = "450px";
    protected static ?string $pollingInterval = '60s';


    protected function getData(): array
    {
        $data = Job::selectRaw('type')
            ->selectRaw('count(*) as total')
            ->groupBy('type')
            ->get();

        $types = $data->pluck("type.value")->toArray();
        $counts = $data->pluck("total")->toArray();

        return [
            "datasets" => [
                [
                    "label" => 'My First Dataset',
                    "data" => $counts,

                    "backgroundColor" => [
                        '#ef476f',
                        '#ffd166',
                        '#06d6a0',
                        '#118ab2'
                    ]
                ],
            ],
            "labels" => $types
        ];
    }
}
