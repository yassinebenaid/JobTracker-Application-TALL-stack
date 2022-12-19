<?php

namespace App\Traits;

use App\Enums\Roles;

trait dealWithRoles
{
    public function isEmploees()
    {
        if (is_null(session("profile.role"))) return false;

        if (session("profile.role") !== Roles::EMPLOEE->value) return false;

        return true;
    }

    public function isEntrepreneurs()
    {
        if (is_null(session("profile.role"))) return false;

        if (session("profile.role") !== Roles::ENTREPRENEUR->value) return false;

        return true;
    }
}
