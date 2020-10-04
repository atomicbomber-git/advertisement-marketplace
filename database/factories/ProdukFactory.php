<?php

/** @var Factory $factory */

use App\KategoriProduk;
use App\Produk;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Produk::class, function (Faker $faker) {
    return [
        "kode" => $faker->unique()->bankAccountNumber,
        "nama" => ucwords(join(" ", $faker->words)),
        "deskripsi" => $faker->realText(),
        "harga" => rand(1, 10_000) * 1000,
        "lokasi" => $faker->streetAddress,
        "kategori_produk_id" => KategoriProduk::query()->inRandomOrder()->value("id"),
    ];
});
