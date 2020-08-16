<?php


namespace App\Support;


class Formatter
{
    public function currency(float $value): string
    {
        return "Rp. " . number_format($value);
    }

    public function date($value): string
    {

    }
}
