<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AdminSeeder::class);
         $this->call(PenjualSeeder::class);
         $this->call(KategoriProdukSeeder::class);
         $this->call(ProdukSeeder::class);
         $this->call(PelangganSeeder::class);
    }
}
