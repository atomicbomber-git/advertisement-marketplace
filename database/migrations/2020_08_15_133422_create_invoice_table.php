<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('penjual_id')->index();
            $table->unsignedInteger('pelanggan_id')->index();
            $table->string('status')->index();
            $table->index(['penjual_id', 'pelanggan_id']);
            $table->foreign('penjual_id')->references('id')->on('penjual');
            $table->foreign('pelanggan_id')->references('id')->on('pelanggan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}
