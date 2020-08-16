<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceItem extends Model
{
    protected $table = "invoice_item";
    protected $guarded = [];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }
}
