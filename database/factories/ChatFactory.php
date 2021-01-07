<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Chat;
use Faker\Generator as Faker;

$factory->define(Chat::class, function (Faker $faker) {
    return [
        "read_at" => null,
        "pesan" => join(" ", $faker->sentences(rand(1, 5)))
    ];
});
