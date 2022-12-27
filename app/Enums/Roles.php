<?php

namespace App\Enums;

use Exception;

enum Roles: string
{
    case EMPLOEE = "emploee";
    case ENTREPRENEUR = "entrepreneur";

    public static function isEmploee($identifier): bool
    {
        return self::EMPLOEE->value === (string)$identifier;
    }

    public static function isEntrepreneur($identifier): bool
    {
        return self::ENTREPRENEUR->value === (string)$identifier;
    }
}
