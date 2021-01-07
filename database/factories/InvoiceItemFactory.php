<?php

/** @var Factory $factory */

use App\Invoice;
use App\InvoiceItem;
use App\Produk;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(InvoiceItem::class, function (Faker $faker) {
    return [
        "invoice_id" => Invoice::query()->inRandomOrder()->value("id"),
        "produk_id" => Produk::query()->inRandomOrder()->value("id"),
        "kuantitas" => rand(1, 10),
        "harga" => rand(1, 20) * 10_000,
        "pajak" => 10 / 100,
    ];
});
