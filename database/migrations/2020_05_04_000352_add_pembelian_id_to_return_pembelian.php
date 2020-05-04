<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPembelianIdToReturnPembelian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('return_pembelian', function (Blueprint $table) {
            $table->unsignedInteger('pembelian_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('return_pembelian', function (Blueprint $table) {
            $table->dropColumn('pembelian_id');
        });
    }
}
