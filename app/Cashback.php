<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashback extends Model
{
    public static function kodeFaktur()
    {
        $cek = Cashback::where('faktur', 'LIKE', 'CSB%')->get();
        if ($cek->count() > 0) {
            $cashback = Cashback::where('faktur', 'LIKE', 'CSB%')->orderBy('id', 'DESC')->first();
            $nourut = (int) substr($cashback->faktur, -8, 8);
            $nourut++;
            $char = "CSB";
            $number = $char  .  sprintf("%08s", $nourut);
        } else {
            $number = "CSB"  . "00000001";
        }
        return $number;
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }
    public function detail_cashback()
    {
        return $this->hasMany(Cashback_detail::class, 'cashback_id', 'id');
    }
}
