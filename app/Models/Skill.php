<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    // public function skills()
    // {
    //     return $this->belongsToMany(User::class, "user_skill", "skill_id", "user_id");
    // }
}
