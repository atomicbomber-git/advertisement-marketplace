<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_item', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_id')->index();
            $table->unsignedInteger('produk_id')->index();
            $table->unsignedInteger('kuantitas');
            $table->unsignedDouble('harga')->nullable();
            $table->unsignedDouble('pajak')->nullable();

            $table->timestamps();
            $table->foreign('invoice_id')->references('id')->on('invoice');
            $table->foreign('produk_id')->references('id')->on('produk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
}
