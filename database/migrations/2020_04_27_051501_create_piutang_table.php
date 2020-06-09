<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiutangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piutang', function (Blueprint $table) {
            $table->id();
            $table->string('faktur')->unique();
            $table->date('tanggal_piutang');
            $table->integer('total_hutang');
            $table->integer('piutang_terbayar');
            $table->date('tanggal_tempo')->nullable();
            $table->integer('sisa_piutang');
            $table->unsignedInteger('pelanggan_id');
            $table->unsignedInteger('transaksi_id');
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
        Schema::dropIfExists('piutangs');
    }
}
