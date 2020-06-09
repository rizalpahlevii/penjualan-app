<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToPiutang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('piutang', function (Blueprint $table) {
            $table->enum('status_piutang', ['belum bayar', 'belum lunas', 'lunas'])->default('belum bayar')->after('sisa_piutang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('piutang', function (Blueprint $table) {
            $table->dropColumn('status_piutang');
        });
    }
}
