<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        "company_id",
        "job_id",
        "cover_letter",
        "expected_salary"
    ];

    public function emploee()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(User::class);
    }


    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
