<?php

namespace App\Services;

use App\Models\Job;
use Illuminate\Support\Facades\DB;

class WorkService
{
    protected static $attributes = [
        "id", "user_id", "title", "criteria", "type", "country", "city", "salary", "created_at"
    ];


    public static function applyWorksList(array $filters = [])
    {
        $filters = filterEmptyValues($filters);

        return Job::with("skills:id,name")
            ->filter($filters)
            ->orderBy("id", "desc")
            ->paginate(6, self::$attributes);
    }

    public static function allAboutWork(int $id)
    {
        return Job::whereId($id)->with("skills:id,name", "user:id,name")->select(self::$attributes)->first();
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
}
