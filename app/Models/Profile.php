<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        "job",
        "degree_year",
        "experience_years",
        "school",
        "birthday",
        "degree",
        "user_id"
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
