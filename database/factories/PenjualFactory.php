<?php

/** @var Factory $factory */

use App\Constants\UserLevel;
use App\Penjual;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Penjual::class, function (Faker $faker) {
    return [
        "nama" => $faker->company,
        "no_telepon" => $faker->phoneNumber,
        "alamat" => $faker->address,
        "terverifikasi" => rand(0, 1),
        "user_id" => factory(User::class)
            ->create([
                "level" => UserLevel::PENJUAL
            ])->id,
    ];
});
