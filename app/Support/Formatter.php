<?php


namespace App\Support;


use Jenssegers\Date\Date;

class Formatter
{
    public static function humanDatetime($value): string
    {
        return Date::make($value)->diffForHumans();
    }

    public static function dayMonthYear($value): string
    {
        if (!$value) return "-";
        return Date::make($value)->format("Y-m-d");
    }

    public function currency($value): string
    {
        if ($value === null) {
            return "-";
        }

        return "Rp. " . number_format($value);
    }

    public function date($value): string
    {

    }
}
