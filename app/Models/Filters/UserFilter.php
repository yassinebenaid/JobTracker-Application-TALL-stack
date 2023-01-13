<?php

namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

class UserFilter extends Filter
{
    /** @var \Illuminate\Contracts\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model  */
    protected Builder $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function byName($name): static
    {
        $name = $this->sanitizeString($name);

        $this->builder->when($name ?? false, function ($query, $name) {

            $query->whereExists(function ($query) use ($name) {

                $query->where("name", "like", "%" . $name . "%");

                foreach ($this->devidedWords($name) as $word) {
                    $query->orWhere('name', "like", "%" . $word . "%");
                }
            });
        });

        return $this;
    }


    public function orByJobSpecification($job_name): static
    {
        $job_name = $this->sanitizeString($job_name);

        $this->builder->when($job_name ?? false, function ($query, $job_name) {

            $query->orWhereHas("profile", function ($query) use ($job_name) {

                $query->where('profiles.job', "like", "%" . $job_name . "%");

                foreach ($this->devidedWords($job_name) as $word) {
                    $query->orWhere('profiles.job', "like", "%" . $word . "%");
                }
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
}
