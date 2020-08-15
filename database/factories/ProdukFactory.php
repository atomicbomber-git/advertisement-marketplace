<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Produk;
use Faker\Generator as Faker;

$factory->define(Produk::class, function (Faker $faker) {
    return [
        "kode" => $faker->unique()->bankAccountNumber,
        "nama" => ucwords(join(" ", $faker->words)),
        "deskripsi" => $faker->realText(),
        "harga" => rand(1, 10_000) * 1000
    ];
});
