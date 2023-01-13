<?php

namespace App\Enums;

enum JobTypes: string
{
    case Remotly = "remotly";
    case Hybrid = 'hybrid';
    case Permanently = "permanently";
    case Full_Time = "fulltime";

    public static function getName($value)
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case->name();
            }
        }

        return null;
    }


    public static function getDefiner($name)
    {
        foreach (self::cases() as $case) {
            if ($case->prefix() === strtolower($name)) return $case->value;
        }

        return null;
    }



    protected function prefix()
    {
        return strtolower(str_replace(["_", " "], "", trim($this->name())));
    }


    public static function getDefiners(array $names)
    {
        $definers = [];

        foreach ($names as $name) {
            if ($definer = self::getDefiner($name)) $definers[] =  $definer;
        }

        return empty($definers) ? false : $definers;
    }


    public function name()
    {
        return ucwords(str_replace("_", " ", $this->name));
    }


    public static function getType($value)
    {

        foreach (self::cases() as $case) {
            if ($case->value === $value) return  $case;
        }

        return null;
    }


    public static function getTypes(): array
    {
        $cases = [];

        foreach (self::cases() as $case) {
            $cases[$case->value] = $case->name();
        }

        return $cases;
    }
}
