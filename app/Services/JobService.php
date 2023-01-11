<?php

namespace App\Services;

use App\Enums\ReportReasons;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class JobService
{
    protected static $attributes = [
        "id", "user_id", "title", "criteria", "type", "country", "description", "city", "salary", "created_at"
    ];


    public static function applyJobsList(array $filters = [])
    {
        $filters = filterEmptyValues($filters);

        return Job::with("skills:id,name")
            ->filter($filters)
            ->orderBy("id", "desc")
            ->paginate(6, self::$attributes);
    }

    public static function getCompanyJobsList(User $company)
    {
        return $company->jobs()
            ->with("skills:id,name")
            ->orderBy("id", "desc")
            ->get();
    }


    public static function allAboutJob(int $id)
    {
        return Job::with(["skills:id,name", "user:id,name"])
            ->whereId($id)
            ->first();
    }


    public static function inWishlist(Job $job)
    {
        return (bool) $job->wishlist()->whereUserId(auth()->id())->first();
    }


    public static function new(array|object $data)
    {
        DB::beginTransaction();

        $job = Job::create([
            "user_id" => auth()->id(),
            "title" => data_get($data, "title"),
            "country" => data_get($data, "country"),
            "city" => data_get($data, "city"),
            "salary" => (int) data_get($data, "salary"),
            "type" =>  data_get($data, "type"),
            "description" => data_get($data, "description"),
            "criteria" => data_get($data, "criteria"),
        ]);

        $job->skills()->sync(data_get($data, "required_skills"));

        Db::commit();

        return $job;
    }



    public static function report(Job $job, int $reporter_id, array $report)
    {
        $job->reports()->create([
            "reporter_id" => $reporter_id,
            "info" => $report['info'],
            "reason" => ReportReasons::getReasonDefiner($report['reason'])
        ]);
    }

    public static function toggleToWishlist(Job $job): bool
    {
        $result = auth()->user()->wishlist()->toggle($job);

        return in_array($job->id, $result['attached']);
    }

    public static function wishlist()
    {
        return auth()->user()->wishlist()->get();
    }
}
