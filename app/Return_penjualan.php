<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Return_penjualan extends Model
{
    protected $table = 'return_penjualan';
    public static function kodeFaktur()
    {
        $cek = Return_penjualan::all();
        if ($cek->count() > 0) {
            $transaksi = Return_penjualan::orderBy('id', 'DESC')->first();
            $nourut = (int) substr($transaksi->faktur, -8, 8);
            $nourut++;
            $char = "RPJ";
            $number = $char  .  sprintf("%08s", $nourut);
        } else {
            $number = "RPJ"  . "00000001";
        }
        return $number;
    }
    public function detail_return_jual()
    {
        return $this->hasMany(Detail_return_jual::class, 'return_jual_id', 'id');
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }
}
