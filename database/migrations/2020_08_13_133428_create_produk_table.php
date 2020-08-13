<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('penjual_id')->index();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->text('deskripsi');
            $table->unsignedDouble('harga', 19, 4);
            $table->timestamps();

            $table->foreign('penjual_id')->references('id')->on('penjual');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
