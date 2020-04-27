<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailReturnPembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_return_pembelian', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('barang_id');
            $table->unsignedInteger('return_beli_id');
            $table->decimal('jumlah_beli');
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
        Schema::dropIfExists('detail_return_pembelians');
    }
}
