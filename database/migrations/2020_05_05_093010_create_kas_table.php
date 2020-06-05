<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('faktur');
            $table->enum('tipe', ['pendapatan', 'pengeluaran']);
            $table->enum('jenis', ['penjualan', 'return penjualan', 'pembelian', 'return pembelian', 'bayar piutang', 'bayar hutang', 'kas awal', 'kas akhir', 'pengeluaran lain', 'biaya', 'pemasukan awal', 'penggajian', 'cashback', 'transport']);
            $table->integer('pemasukan');
            $table->integer('pengeluaran');
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('kas');
    }
}
