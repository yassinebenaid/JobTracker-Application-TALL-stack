<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class SkillService
{
    public static function applyListOfSkills()
    {
        return cache()->remember("skills:list", 3600, fn () => DB::table('skills')->select(['name', 'id'])->get());
    }
}
