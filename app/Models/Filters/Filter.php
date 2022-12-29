<?php

namespace App\Models\Filters;

abstract class Filter
{
    public function sanitizeString($string): string
    {
        return trim(preg_replace("#([^A-zéàâêîûô]+)#", " ", $string ?? ''));
    }

    public function devidedWords($string)
    {
        $words = explode(" ", $string);

        return (sizeof($words) > 0)
            ? $words
            : null;
    }

    public function getFormatedDate($date)
    {
        return match ($date) {
            "today" => now()->subDay()->format("Y-m-d H:i:s"),
            "week" => now()->subWeek()->format("Y-m-d H:i:s"),
            "month" => now()->subMonth()->format("Y-m-d H:i:s"),
            "year" => now()->subYear()->format("Y-m-d H:i:s"),
            default => 0
        };
    }
}
