<?php

namespace App\Services;

use App\Enums\Roles;
use App\Models\User;

class CompanyService
{
    public static function loadAllAboutCompany($id)
    {
        return User::with(['profile:id,user_id,job,bio,country'])->whereId($id)->first();
    }


    public static function getCompaniesRandomList($search = '')
    {
        return User::inRandomOrder()->role(Roles::ENTREPRENEUR->value)->filter($search)->take(30)->get(['id', "name"]);
    }
}
