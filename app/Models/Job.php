<?php

namespace App\Models;

use App\Enums\JobTypes;
use App\Models\Filters\JobFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class Job extends Model
{
    use HasFactory;

    protected $table = "thejobs";


    protected $fillable = [
        "user_id",
        "title",
        "country",
        "city",
        "salary",
        "type",
        "description",
        "criteria"
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class, "job_skill", "job_id", "skill_id");
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reports()
    {
        return $this->morphOne(Report::class, "reportable");
    }

    public function wishlist()
    {
        return $this->belongsToMany(User::class, "wishlist", "job_id", "user_id");
    }

    public function getTypeAttribute()
    {
        return JobTypes::getType($this->attributes['type']);
    }

    public function getConditionsAttribute()
    {
        $criteria = explode(",", $this->attributes['criteria']);

        return collect($criteria);
    }

    public function scopeFilter($query, array $filters)
    {
        $filter = new JobFilter($query);

        $filter->byKeywords($filters['keywords'] ?? false)
            ->bySalary($filters['salary'] ?? false)
            ->byType($filters['types'] ?? false)
            ->byDate($filters['date'] ?? false)
            ->bySkills($filters['skills'] ?? false)
            ->byLocation($filters['location'] ?? false);
    }
}
