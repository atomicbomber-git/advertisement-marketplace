<?php

use App\Constants\UserLevel;
use App\Pelanggan;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        factory(Pelanggan::class, 5)
            ->make([
                "user_id" => null,
                "terverifikasi" => 1,
            ])
            ->each(function (Pelanggan $pelanggan, $index) {
                $usernameOrPassword = "pelanggan_{$index}";

                /** @var User $user */
                $user = factory(User::class)
                    ->create([
                        "username" => $usernameOrPassword,
                        "password" => Hash::make($usernameOrPassword),
                        "level" => UserLevel::PELANGGAN,
                    ]);

                $user->pelanggan()->save($pelanggan);
            });

        factory(Pelanggan::class, 100)
            ->create();

        DB::commit();
    }
}
