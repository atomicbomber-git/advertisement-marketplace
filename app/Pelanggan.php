<?php

namespace App;

use App\Constants\InvoiceStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property Invoice draft_invoice
 */
class Pelanggan extends Model
{
    protected $table = "pelanggan";
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function draft_invoice(): HasOne
    {
        return $this->hasOne(Invoice::class)
            ->where("status", InvoiceStatus::DRAFT)
            ->orderByDesc("created_at");
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function draft_invoices(): HasMany
    {
        return $this->invoices()
            ->where("status", InvoiceStatus::DRAFT);
    }
}
