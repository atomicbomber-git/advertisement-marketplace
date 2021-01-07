<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('penjual_id')->index();
            $table->unsignedInteger('pelanggan_id')->index();

            $table->longText('pesan');

            $table->foreign('penjual_id')->references('id')->on('penjual');
            $table->foreign('pelanggan_id')->references('id')->on('pelanggan');

            $table->timestamps();
            $table->timestamp("read_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat');
    }
}
