<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Constants\InvoiceStatus;
use App\Invoice;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {
    $created_at = now()->subDays(rand(5, 365));
    return [
        "penjual_id" => \App\Penjual::query()->inRandomOrder()->value("id"),
        "pelanggan_id" => \App\Pelanggan::query()->inRandomOrder()->value("id"),
        "status" => $faker->randomElement([
            InvoiceStatus::UNPAID,
            InvoiceStatus::CANCELED,
            InvoiceStatus::DRAFT,
            InvoiceStatus::PAID,
        ]),
        "created_at" => $created_at,
        "updated_at" => $created_at,
        "waktu_checkout" => $created_at->addDays(1),
        "waktu_pelunasan" => $created_at->addDays(1)->addHours(rand(1, 7)),
    ];
});
