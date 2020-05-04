<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';
    public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'suplier_id', 'id');
    }
    public function detail_pembelian()
    {
        return $this->hasMany(Detail_pembelian::class, 'pembelian_id', 'id');
    }
    public function return_pembelian()
    {
        return $this->hasOne(Return_pembelian::class, 'pembelian_id', 'id');
    }
    public static function kodeFaktur()
    {
        $cek = Pembelian::all();
        if ($cek->count() > 0) {
            $pembelian = Pembelian::orderBy('id', 'DESC')->first();
            $nourut = (int) substr($pembelian->faktur, -8, 8);
            $nourut++;
            $char = "PMB";
            $number = $char  .  sprintf("%08s", $nourut);
        } else {
            $number = "PMB"  . "00000001";
        }
        return $number;
    }
}
