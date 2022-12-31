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
        try {
            $company->reviews()->updateOrCreate(["user_id" => auth()->id()], [
                "rate" => $rate,
                "feedback" => $feedback
            ]);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function report(User $company, array $report)
    {
        try {
            $company->reports()->create([
                "info" => $report['info'],
                "reason" => ReportReasons::getReasonDefiner($report["reason"])
            ]);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
// inRandomOrder()->
