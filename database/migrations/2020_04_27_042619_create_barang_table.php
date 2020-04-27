<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('nama');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->integer('stok_awal');
            $table->integer('stok_masuk');
            $table->integer('stok_akhir');
            $table->integer('stok_keluar');
            $table->unsignedInteger('satuan_id');
            $table->unsignedInteger('kategori_id');
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
        Schema::dropIfExists('barang');
    }
}
