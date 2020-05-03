<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSuplierIdToHistoryStokBarangMasuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('history_stok_barang_masuk', function (Blueprint $table) {
            $table->unsignedInteger('suplier_id')->nullable()->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('history_stok_barang_masuk', function (Blueprint $table) {
            $table->dropColumn('suplier_id');
        });
    }
}
