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
            $this->getCard(User::role(Roles::ENTREPRENEUR->value), "Total Companies"),
            $this->getCard(User::role(Roles::EMPLOEE->value), "Total Emploees"),
            $this->getCard(Job::query(), "Total Jobs"),
            $this->getCard(Application::query(), "Total Applications"),
        ];
    }

    protected function getCard(Model|Builder $model, $label)
    {
        $companyStat =  new Stats($model);

        return Card::make($label, $companyStat->total())

            ->description($companyStat->improvement() . ($companyStat->wasIncreased() ? " increase" : "decrease"))

            ->descriptionIcon($companyStat->wasIncreased() ? "heroicon-o-trending-up" : "heroicon-o-trending-down")

            ->descriptionColor($companyStat->wasIncreased() ? "success" : "danger")

            ->chart([
                0,
                ...$companyStat->thisYearByMonth(),
            ])

            ->chartColor($companyStat->wasIncreased() ? "success" : "danger");
    }

    protected function getPollingInterval(): ?string
    {
        return "50s";
    }
}
