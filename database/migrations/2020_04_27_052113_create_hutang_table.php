<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHutangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hutang', function (Blueprint $table) {
            $table->id();
            $table->string('faktur')->unique();
            $table->date('tanggal_hutang');
            $table->date('tanggal_tempo');
            $table->unsignedInteger('suplier_id');
            $table->unsignedInteger('pembelian_id');
            $table->integer('total_hutang');
            $table->integer('pembayaran_hutang');
            $table->integer('sisa_hutang');
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
        Schema::dropIfExists('hutangs');
    }
}
