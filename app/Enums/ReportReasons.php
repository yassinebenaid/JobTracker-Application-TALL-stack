<?php

namespace App\Enums;

enum ReportReasons: string
{
    case FAKE = 'fake';
    case MISLEADING_CONTENT = 'misleading_content';
    case ILLEGAL = 'illegal';
    case REPEATED = 'repeated_jobs';
    case OTHER = 'other';

    public function forCompany()
    {
        return match ($this) {
            self::FAKE => "It seems like a fake company",
            self::MISLEADING_CONTENT => "It shared a misleading content",
            self::ILLEGAL => "It is doing something illegal or forbidden",
            self::REPEATED => "It posts repeated jobs",
            self::OTHER => "Other"
        };
    }

    public function forJob()
    {
        return match ($this) {
            self::FAKE => "It seems like a fake job",
            self::MISLEADING_CONTENT => "It looks like a misleading content",
            self::ILLEGAL => "It is  illegal or forbidden",
            self::REPEATED => "It is repeated multiple times",
            self::OTHER => "Other"
        };
    }

    public static function getReasonDefiner($definer)
    {
        foreach (self::cases() as $case) {
            if ($case->value === $definer) return $case->value;
        }

        return self::OTHER->value;
    }

    public static function getCase($definer)
    {
        foreach (self::cases() as $case) {
            if ($case->value === $definer) return $case;
        }

        return null;
    }
}
