<?php

use App\Constants\UserLevel;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usernameOrPassword = "administrator";

        User::query()->create([
            "name" => "Admin Utama",
            "username" => $usernameOrPassword,
            "password" => Hash::make($usernameOrPassword),
            "level" => UserLevel::SUPER_ADMIN,
        ]);
    }
}
