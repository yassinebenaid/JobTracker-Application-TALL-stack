<?php

namespace App\Services;

use App\Jobs\sendNewApplicationEmail;
use App\Models\Application;
use App\Models\User;
use App\Models\Job;
use App\Notifications\NewApplication;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\DB;


class ApplicationService
{

    public static function applyApplicationsList()
    {
        return Application::with(["emploee", "emploee.profile", "emploee.skills:id,name"])
            ->whereCompanyId(auth()->id())
            ->get();
    }


    public static function new(array|object $data)
    {
        return auth()->user()->applications()->create([
            "job_id" => data_get($data, "job_id"),
            "company_id" => data_get($data, "company_id"),
            "expected_salary" => data_get($data, "expected_salary"),
            "cover_letter" => data_get($data, "cover")
        ]);
    }

    public static function notifyTheCompany(Application $application)
    {
        $application->company->notify(new NewApplication($application));
    }
}
