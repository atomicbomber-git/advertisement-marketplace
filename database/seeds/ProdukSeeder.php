<?php

use App\Penjual;
use App\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Penjual[] $penjuals */
        $penjuals = Penjual::query()->get();

        DB::beginTransaction();

        foreach ($penjuals as $penjual) {
            $penjual->produks()->createMany(
                factory(Produk::class, 300)
                    ->make()
                    ->toArray()
            );
        }

        DB::commit();
    }
}
