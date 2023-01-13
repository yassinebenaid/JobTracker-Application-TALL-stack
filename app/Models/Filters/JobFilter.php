<?php

namespace App\Models\Filters;

use App\Enums\JobTypes;
use Illuminate\Contracts\Database\Eloquent\Builder;



class JobFilter extends Filter
{
    /** @var \Illuminate\Contracts\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model  */
    protected Builder $builder;


    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }


    public function bySalary(array|false $salary): static
    {
        $this->builder->when($salary ?? false, function ($query, $salary) {

            $query->whereExists(function ($query) use ($salary) {

                $query->when($salary["min"] ?? false, function ($query, $min_salary) {
                    $query->where("salary", ">=", $min_salary);
                });

                $query->when($salary["max"] ?? false, function ($query, $max_salary) {
                    $query->where("salary", "<=", $max_salary);
                });
            });
        });

        return $this;
    }


    public function byType($types): static
    {
        $this->builder->when($types ?? false, function ($query, $types) {

            $types = JobTypes::getDefiners($types);

            $query->when($types, function ($query, $types) {
                $query->whereExists(fn ($query) =>  $query->whereIn("type", $types));
            });
        });

        return $this;
    }


    public function byDate(string $date): static
    {
        $this->builder->when($date ?? false, function ($query, $date) {

            $query->whereExists(function ($query) use ($date) {

                $date = $this->getFormatedDate($date);

                $query->whereDate("created_at", ">=", $date);
            });
        });

        return $this;
    }


    public function bySkills(array|false $skills): static
    {
        $this->builder->when($skills ?? false, function ($query, $skills) {

            $query->whereHas("skills", fn ($query) => $query->whereIn("id", $skills));
        });

        return $this;
    }


    public function byLocation(array|false $location): static
    {
        $this->builder->when($location, function ($query, $location) {

            $query->whereExists(function ($query) use ($location) {

                $query->when($location['country'] ?? false, fn ($query, $country) => $query->where("country", "like", "%" . $country . "%"));

                $query->when($location['city'] ?? false, fn ($query, $city) => $query->where("city", "like", "%" . $city . "%"));
            });
        });

        return $this;
    }


    public function byKeywords(string $keywords): static
    {
        $keywords = $this->sanitizeString($keywords);

        $this->builder->when($keywords, function ($query, $keywords) {

            $query->whereExists(function ($query) use ($keywords) {

                $query->where("title", "like", "%" . $keywords . "%");

                foreach ($this->devidedWords($keywords) as $word) {
                    $query->orWhere("title", "like", "%" . $word . "%");
                }
            });
        });

        return $this;
    }
}
