<?php

use App\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::beginTransaction();

        factory(Invoice::class, 100)
            ->create()
            ->each(function (Invoice $invoice) {
                $unique_product_count = rand(2, 10);

                $product_ids = $invoice->penjual->produks()->inRandomOrder()
                    ->take($unique_product_count)
                    ->pluck("id");

                foreach ($product_ids as $product_id) {
                    factory(\App\InvoiceItem::class)
                        ->create([
                            "produk_id" => $product_id
                        ]);
                }
            });

        \Illuminate\Support\Facades\DB::commit();
    }
}
