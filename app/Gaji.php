<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    protected $table = 'gaji';
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }
    public static function kodeFaktur()
    {
        $cek = Gaji::all();
        if ($cek->count() > 0) {
            $gaji = Gaji::orderBy('id', 'DESC')->first();
            $nourut = (int) substr($gaji->faktur, -8, 8);
            $nourut++;
            $char = "PGJ";
            $number = $char  .  sprintf("%08s", $nourut);
        } else {
            $number = "PGJ"  . "00000001";
        }
        return $number;
    }
}
