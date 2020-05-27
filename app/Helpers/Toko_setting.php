<?php 
use App\Toko_setting as Setting;
    function logo(){
        $data = Setting::where('nama','logo')->first();
        return $data->value;
    }
    function namaToko(){
        $data = Setting::where('nama','nama_toko')->first();
        return $data->value;
    }
    function alamat(){
        $data = Setting::where('nama','alamat')->first();
        return $data->value;
    }
    function email(){
        $data = Setting::where('nama','email')->first();
        return $data->value;
    }
    function no_hp(){
        $data = Setting::where('nama','no_hp')->first();
        return $data->value;
    }
    function nama_bank(){
        $data = Setting::where('nama','nama_bank')->first();
        return $data->value;
    }
    function nama_rekening(){
        $data = Setting::where('nama','nama_rekening')->first();
        return $data->value;
    }

    function no_rekening(){
        $data = Setting::where('nama','no_rekening')->first();
        return $data->value;
    }    
    function struk_salam_hormat(){
        $data = Setting::where('nama','struk_salam_hormat')->first();
        return $data->value;
    }
    function website(){
        $data = Setting::where('nama','website')->first();
        return $data->value;
    }


