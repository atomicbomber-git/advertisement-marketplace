<?php

namespace App;

use App\QueryBuilders\InvoiceItemBuilder;
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

    /** return \App\QueryBuilders\InvoiceItemBuilder */
    public function newEloquentBuilder($query)
    {
        return new InvoiceItemBuilder($query);
    }

    public static function query(): InvoiceItemBuilder
    {
        return parent::query();
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }
}
