<?php

use App\Constants\UserLevel;
use App\Penjual;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenjualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            factory(Penjual::class, 5)
                ->make([
                    "terverifikasi" => 1,
                    "user_id" => null,
                ])
                ->each(function (Penjual $penjual, $index) {
                    $usernameOrPassword = "penjual_{$index}";

                    /** @var User $user */
                    $user = factory(User::class)
                        ->create([
                            "username" => $usernameOrPassword,
                            "password" => Hash::make($usernameOrPassword),
                            "level" => UserLevel::PENJUAL,
                        ]);

                    $user->penjual()->save($penjual);
                });

            factory(Penjual::class, 100)
                ->create([
                    "terverifikasi" => 0,
                ]);
        });
    }
}
