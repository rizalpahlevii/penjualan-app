<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toko_setting extends Model
{
    protected $table ='toko_settings';
    public static function setWebsite($param){
        $data = Toko_setting::where('nama','website')->first();
        $data->value = $param;
        $data->update();
    }
    public static function setLogo($param){
        $data = Toko_setting::where('nama','logo')->first();
        $data->value = $param;
        $data->update();
    }
    public static function setNamaToko($param){
        $data = Toko_setting::where('nama','nama_toko')->first();
        $data->value = $param;
        $data->update();
    }
    public static function setAlamat($param){
        $data = Toko_setting::where('nama','alamat')->first();
        $data->value = $param;
        $data->update();
    }
    public static function setEmail($param){
        $data = Toko_setting::where('nama','email')->first();
        $data->value = $param;
        $data->update();
    }
    public static function setNoHP($param){
        $data = Toko_setting::where('nama','no_hp')->first();
        $data->value = $param;
        $data->update();
    }
    public static function setNamaBank($param){
        $data = Toko_setting::where('nama','nama_bank')->first();
        $data->value = $param;
        $data->update();
    }
    public static function setNoRekening($param){
        $data = Toko_setting::where('nama','no_rekening')->first();
        $data->value = $param;
        $data->update();
    }
    public static function setNamaRekening($param){
        $data = Toko_setting::where('nama','nama_rekening')->first();
        $data->value = $param;
        $data->update();
    }
    public static function setSalamHormat($param){
        $data = Toko_setting::where('nama','struk_salam_hormat')->first();
        $data->value = $param;
        $data->update();
    }

}
