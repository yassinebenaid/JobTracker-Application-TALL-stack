<?php

namespace App\Services;

use App\Models\Job;

class JobService
{
    protected static $attributes = [
        "id", "title", "criteria", "type", "country", "city", "salary", "created_at"
    ];


    public static function applyJobsList(array $filters = [])
    {
        $filters = filterEmptyValues($filters);

        return Job::with("skills:id,name", "company:id,name")
            ->filter($filters)
            ->paginate(6, self::$attributes);
    }

    public static function allAboutJob(int $id)
    {
        return Job::whereId($id)->with("skills:id,name", "company:id,name")->first();
    }
}
