<?php

namespace App\Filament\Widgets;

use App\Enums\Roles;
use App\Helpers\Stats;
use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class StatsOverview extends BaseWidget
{

    protected function getCards(): array
    {
        return [
            $this->getCard(User::company(), "Total Companies", "companies"),
            $this->getCard(User::emploee(), "Total Emploees", "emploees"),
            $this->getCard(Job::query(), "Total Jobs", "jobs"),
            $this->getCard(Application::query(), "Total Applications", "applications"),
        ];
    }

    protected function getCard(Model|Builder $model, $label)
    {

        $stats =  Stats::make($model);


        $total = $stats->total();


        return Card::make($label, $total)

            ->description($stats->improvement() . ($stats->wasIncreased() ? " increase" : "decrease"))

            ->descriptionIcon($stats->wasIncreased() ? "heroicon-o-trending-up" : "heroicon-o-trending-down")

            ->descriptionColor($stats->wasIncreased() ? "success" : "danger")

            ->chart([$stats->lastMonth(), $stats->getNumber("total", false)])

            ->chartColor($stats->wasIncreased() ? "success" : "danger");
    }

    protected function getPollingInterval(): ?string
    {
        return "50s";
    }
}
