<?php

use App\Penjual;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            factory(Penjual::class, 200)
                ->create();
        });
    }
}
