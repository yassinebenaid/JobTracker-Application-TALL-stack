<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        "reason", "info", "reporter_id"
    ];


    public function reportable()
    {
        return $this->morphTo();
    }

    public function reported_job()
    {
        return $this->belongsTo(Job::class, "reportable_id");
    }

    public function reported_company()
    {
        return $this->belongsTo(User::class, "reportable_id");
    }

    public function reporter()
    {
        return $this->BelongsTo(User::class, "reporter_id");
    }
}
