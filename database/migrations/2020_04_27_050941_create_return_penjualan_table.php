<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('faktur')->unique();
            $table->date('tanggal_return_jual');
            $table->unsignedInteger('transaksi_id');
            $table->integer('total_bayar');
            $table->unsignedInteger('user_id');
            $table->enum('status', ['cart', 'finish'])->default('cart');
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
        Schema::dropIfExists('return_penjualan');
    }
}
