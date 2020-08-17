<?php


namespace App\Support;


class Formatter
{
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
