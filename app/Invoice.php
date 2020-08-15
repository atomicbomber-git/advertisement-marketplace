<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $table = "invoice";
    protected $guarded = [];

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
