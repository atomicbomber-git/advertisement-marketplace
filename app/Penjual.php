<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penjual extends Model
{
    protected $table = "penjual";
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeTerverifikasi(Builder $builder)
    {
        $builder->where("terverifikasi", 1);
    }
}
