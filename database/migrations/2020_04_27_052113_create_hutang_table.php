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
            $table->date('tanggal_hutang');
            $table->date('tanggal_tempo');
            $table->unsignedInteger('supplier_id');
            $table->unsignedInteger('pembelian_id');
            $table->decimal('total_hutang');
            $table->decimal('pembayaran_hutang');
            $table->decimal('sisa_hutang');
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
