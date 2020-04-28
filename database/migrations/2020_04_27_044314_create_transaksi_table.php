<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->date('tanggal_transaksi');
            $table->decimal('total');
            $table->integer('diskon');
            $table->integer('ppn');
            $table->integer('pph');
            $table->enum('status', ['kredit', 'tunai']);
            $table->unsignedInteger('pelanggan_id');
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('transaksis');
    }
}