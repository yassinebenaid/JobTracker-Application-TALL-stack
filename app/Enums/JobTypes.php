<?php

namespace App\Enums;

enum JobTypes: string
{
    case Remotly = "remotly";
    case Hybrid = 'hybrid';
    case Permanently = "permanently";
    case Full_Time = "fulltime";

    public static function getTypeName($value)
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case->name();
            }
        }

        return null;
    }

    public static function getTypeId($name)
    {
        foreach (self::cases() as $case) {
            if ($case->prefix() === strtolower($name)) return $case->value;
        }

        return self::Hybrid->value;
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


    public function name()
    {
        return ucwords(str_replace("_", " ", $this->name));
    }

    public static function getCase($value)
    {

        foreach (self::cases() as $case) {
            if ($case->value === $value) return  $case;
        }

        return null;
    }

    public static function getCases(): array
    {
        $cases = [];

        foreach (self::cases() as $case) {
            $cases[$case->value] = $case->name();
        }

        return $cases;
    }

    public static function getValues()
    {
        $cases = [];

        foreach (self::cases() as $case) {
            $cases[] = $case->value;
        }

        return $cases;
    }
}
