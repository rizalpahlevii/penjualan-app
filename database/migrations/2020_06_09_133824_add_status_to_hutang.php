<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToHutang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hutang', function (Blueprint $table) {
            $table->enum('status_hutang', ['belum bayar', 'belum lunas', 'lunas'])->default('belum bayar')->after('sisa_hutang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hutang', function (Blueprint $table) {
            $table->dropColumn('status_hutang');
        });
    }
}
