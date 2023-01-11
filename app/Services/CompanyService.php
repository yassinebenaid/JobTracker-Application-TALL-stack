<?php

namespace App\Services;

use App\Enums\ReportReasons;
use App\Enums\Roles;
use App\Models\User;

class CompanyService
{
    public static function loadAllAboutCompany($company)
    {
        return $company->load(['profile:id,user_id,job,bio,country', "reviews.user:id,name,photo"])
            ->loadAvg("reviews", "rate");
    }


    public static function getCompaniesRandomList($search = '')
    {
        return User::select(['id', "name", "photo"])
            ->role(Roles::ENTREPRENEUR->value)
            ->filter($search)
            ->withAvg("reviews", "rate")
            ->take(30)
            ->get();
    }

    public static function newReview(User $company, $rate, $feedback)
    {
        $company->reviews()->updateOrCreate(["user_id" => auth()->id()], [
            "rate" => $rate,
            "feedback" => $feedback
        ]);
    }

    public static function report(User $company, int $reporter_id, array $report)
    {
        $company->reports()->create([
            "reporter_id" => $reporter_id,
            "info" => $report['info'],
            "reason" => ReportReasons::getReasonDefiner($report["reason"])
        ]);
    }
}
// inRandomOrder()->
