<?php

namespace App\Models\Filters;

use App\Enums\JobTypes;

class JobFilter
{
    public function bySalary($query, array|false $salary)
    {
        $query->when($salary ?? false, function ($query, $salary) {

            $query->whereExists(function ($query) use ($salary) {

                $query->when($salary["min"] ?? false, function ($query, $min_salary) {
                    $query->where("salary", ">=", $min_salary);
                });

                $query->when($salary["max"] ?? false, function ($query, $max_salary) {
                    $query->where("salary", "<=", $max_salary);
                });
            });
        });
    }

    public function byType($query, $types)
    {
        $query->when($types ?? false, function ($query, $types) {

            $types = JobTypes::getTypesIds($types);

            $query->when($types, function ($query, $types) {
                $query->whereExists(fn ($query) =>  $query->whereIn("type", $types));
            });
        });
    }

    public function byDate($query, string $date)
    {
        $query->when($date ?? false, function ($query, $date) {

            $query->whereExists(function ($query) use ($date) {

                $date = $this->getdate($date);

                $query->whereDate("created_at", ">=", $date);
            });
        });
    }

    public function bySkills($query, array|false $skills)
    {
        $query->when($skills ?? false, function ($query, $skills) {

            $query->whereHas("skills", fn ($query) => $query->whereIn("id", $skills));
        });
    }

    public function byLocation($query, array|false $location)
    {
        $query->when($location, function ($query, $location) {

            $query->whereExists(function ($query) use ($location) {

                $query->when($location['country'] ?? false, fn ($query, $country) => $query->where("country", "like", "%" . $country . "%"));

                $query->when($location['city'] ?? false, fn ($query, $city) => $query->where("city", "like", "%" . $city . "%"));
            });
        });
    }

    public function byKeywords($query, string $keywords)
    {
        $query->when($keywords, function ($query, $keywords) {

            $query->whereExists(function ($query) use ($keywords) {

                $query->where("title", "like", "%" . $keywords . "%");

                foreach ($this->getKeywords($keywords) as $word) {
                    $query->orWhere("title", "like", "%" . $word . "%");
                }
            });
        });
    }

    protected function getKeywords($keywords)
    {
        return explode(" ", $keywords);
    }


    protected function getdate(string $date)
    {
        return match ($date) {
            "today" => now()->subDay()->format("Y-m-d H:i:s"),
            "week" => now()->subWeek()->format("Y-m-d H:i:s"),
            "month" => now()->subMonth()->format("Y-m-d H:i:s"),
            "year" => now()->subYear()->format("Y-m-d H:i:s"),
            default => 0
        };
    }
}
