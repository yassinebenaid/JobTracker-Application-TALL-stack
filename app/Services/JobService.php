<?php

namespace App\Services;

use App\Enums\ReportReasons;
use App\Models\Job;
use Illuminate\Support\Facades\DB;

class JobService
{
    protected static $attributes = [
        "id", "user_id", "title", "criteria", "type", "country", "city", "salary", "created_at"
    ];


    public static function applyJobsList(array $filters = [])
    {
        $filters = filterEmptyValues($filters);

        return Job::with("skills:id,name")
            ->filter($filters)
            ->orderBy("id", "desc")
            ->paginate(6, self::$attributes);
    }

    public static function allAboutJob(int $id)
    {
        return Job::select([...self::$attributes, "description"])
            ->with(["skills:id,name", "user:id,name"])
            ->whereId($id)
            ->first();
    }

    public static function inWishlist(Job $job)
    {
        return (bool) $job->wishlist()->whereUserId(auth()->id())->first();
    }


    public static function new(array|object $data)
    {
        try {
            DB::beginTransaction();

            $job = Job::create([
                "user_id" => auth()->id(),
                "title" => data_get($data, "title"),
                "country" => data_get($data, "country"),
                "city" => data_get($data, "city"),
                "salary" => (int) data_get($data, "salary"),
                "type" => (int) data_get($data, "type"),
                "description" => data_get($data, "description"),
                "criteria" => json_encode(data_get($data, "criteria")),
            ]);

            $job->skills()->sync(data_get($data, "required_skills"));

            Db::commit();

            return true;

            //
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function report(Job $job, int $reporter_id, array $report)
    {
        try {
            $job->reports()->create([
                "reporter_id" => $reporter_id,
                "info" => $report['info'],
                "reason" => ReportReasons::getReasonDefiner($report['reason'])
            ]);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
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
