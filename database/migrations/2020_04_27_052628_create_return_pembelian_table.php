<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnPembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('faktur')->unique();
            $table->unsignedInteger('pembelian_id');
            $table->date('tanggal_pembelian');
            $table->date('tanggal_return_pembelian');
            $table->integer('total_bayar');
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
        Schema::dropIfExists('return_pembelians');
    }
}
