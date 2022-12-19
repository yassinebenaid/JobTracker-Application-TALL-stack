<?php

namespace App\Models;

use App\Enums\JobTypes;
use App\Models\Filters\JobFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Job extends Model
{
    use HasFactory;

    public function skills()
    {
        return $this->belongsToMany(Skill::class, "job_skill", "job_id", "skill_id");
    }

    public function company()
    {
        return $this->belongsTo(User::class, "id");
    }

    public function getTypeAttribute()
    {
        return JobTypes::getTypeName($this->attributes['type']);
    }

    public function getCriteriaAttribute()
    {
        return collect(json_decode($this->attributes['criteria']));
    }

    public function scopeFilter($query, array $filters)
    {
        $filter = new JobFilter;

        $filter->byKeywords($query, $filters['keywords'] ?? false);

        $filter->bySalary($query, $filters['salary'] ?? false);

        $filter->byType($query, $filters['types'] ?? false);

        $filter->byDate($query, $filters['date'] ?? false);

        $filter->bySkills($query, $filters['skills'] ?? false);

        $filter->byLocation($query, $filters['location'] ?? false);
    }
}
