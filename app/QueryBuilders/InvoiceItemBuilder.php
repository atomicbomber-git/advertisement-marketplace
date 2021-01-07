<?php


namespace App\QueryBuilders;


use Illuminate\Database\Eloquent\Builder;

class InvoiceItemBuilder extends Builder
{
    public function withIsStillReserved(): self
    {
        return $this->selectRaw("((? >= waktu_mulai_sewa) AND (? <= waktu_selesai_sewa))   AS is_still_reserved", [
            now()->format("Y-m-d"),
            now()->format("Y-m-d"),
        ]);
    }
}