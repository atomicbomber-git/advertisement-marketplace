<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceItem extends Model
{
    protected $table = "invoice_item";
    protected $guarded = [];

    protected $casts = [
        "waktu_mulai_sewa" => "datetime:Y-m-d",
        "waktu_selesai_sewa" => "datetime:Y-m-d",
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }
}
