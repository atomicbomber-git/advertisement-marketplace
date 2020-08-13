<?php


namespace App\Support;


class Formatter
{
    public function currency(float $value): string
    {
        return number_format($value);
    }
}
