<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Toko_setting;

class CreateTokoSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toko_settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('value')->nullable();
            $table->timestamps();
        });
        $data = [
            [
                'nama'=>'logo',
                'value'=>'favicon.png'
            ],
            [
                'nama' => 'nama_toko',
                'value'=>'CV. Multisolusindo'
            ],
            [
                'nama' => 'alamat',
                'value'=>' Jl. Kelet Ploso No. 10 Desa Kelet RT 02/RW 01 Kecamatan Keling Kabupaten Jepara.'
            ],
            [
                'nama' => 'email',
                'value'=>'Multisolusindo85@gmail.com'
            ],
            [
                'nama' => 'no_hp',
                'value'=>'082327104448'
            ],
            [
                'nama' => 'nama_bank',
                'value'=>'BRI'
            ],
            [
                'nama' => 'nama_rekening',
                'value'=>'CV MULTI SOLUSINDO'
            ],
            [
                'nama' => 'no_rekening',
                'value'=>'0022-01-001022-56-8'
            ],
            [
                'nama' => 'struk_salam_hormat',
                'value'=>' A. Mukhlisin Kholiful A.'
            ],
            [
                'nama' => 'website',
                'value'=>'http://multisolusindo.co.id'
            ],          
        ];
        Toko_setting::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('toko_settings');
    }
}
