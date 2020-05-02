<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('barang_id')->on('barang')->references('id')->onDelete('cascace');
            $table->integer('price');
            $table->integer('qty');
            $table->integer('subtotal');
            $table->unsignedInteger('user_id')->on('users')->references('id')->onDelete('cascace');
            $table->enum('status', ['checkout', 'cart']);
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
        Schema::dropIfExists('cart_transaksis');
    }
}
