<?php

namespace App\Enums;

enum JobTypes: int
{
    case Remotly = 1;
    case Hybrid = 2;
    case Permanently = 3;
    case Full_Time = 4;

    public static function getTypeName(int $id)
    {
        foreach (self::cases() as $case) {
            if ($case->value === $id) return $case->name();
        }

        return false;
    }

    public static function getTypeId(string $name)
    {
        foreach (self::cases() as $case) {
            if ($case->prefix() === strtolower($name)) return $case->value;
        }

        return false;
    }

    protected function prefix()
    {
        return strtolower(str_replace(["_", " "], "", trim($this->name())));
    }

    public static function getTypesIds(array $names)
    {
        $ids = [];

        foreach ($names as $name) {
            if ($id = self::getTypeId($name)) $ids[] =  $id;
        }

        return empty($ids) ? false : $ids;
    }


    protected function name()
    {
        return ucwords(str_replace("_", " ", $this->name));
    }
}
