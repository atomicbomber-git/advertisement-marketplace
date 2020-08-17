<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWaktuCheckoutAndWaktuPelunasanFieldsToInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice', function (Blueprint $table) {
            $table->timestamp('waktu_checkout')->nullable()->index();
            $table->timestamp('waktu_pelunasan')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice', function (Blueprint $table) {
            $table->dropColumn('waktu_checkout');
            $table->dropColumn('waktu_pelunasan');
        });
    }
}
