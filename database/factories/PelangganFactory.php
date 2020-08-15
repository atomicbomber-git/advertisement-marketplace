<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Constants\UserLevel;
use App\Pelanggan;
use App\User;
use Faker\Generator as Faker;

$factory->define(Pelanggan::class, function (Faker $faker) {
    return [
        "no_telepon" => $faker->phoneNumber,
        "alamat" => $faker->address,
        "terverifikasi" => rand(0, 1),
        "user_id" => factory(User::class)
            ->create([
                "level" => UserLevel::PELANGGAN,
            ])
    ];
});
