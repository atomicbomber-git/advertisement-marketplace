<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    protected $table = "chat";
    protected $guarded = [];

    protected $dates = [
        "read_at"
    ];

    public function penjual(): BelongsTo
    {
        return $this->belongsTo(Penjual::class);
    }

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
