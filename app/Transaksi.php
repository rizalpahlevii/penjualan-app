<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    public static function kode()
    {
        $cek = Transaksi::all();
        if ($cek->count() > 0) {
            $transaksi = Transaksi::orderBy('id', 'DESC')->first();
            $nourut = (int) substr($transaksi->kode, -8, 8);
            $nourut++;
            $char = "TRK";
            $number = $char  .  sprintf("%08s", $nourut);
        } else {
            $number = "TRK"  . "00000001";
        }
        return $number;
    }
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function return_jual()
    {
        return $this->hasOne(Return_penjualan::class, 'transaksi_id', 'id');
    }
    public function detail_transaksi()
    {
        return $this->hasMany(Detail_transaksi::class, 'transaksi_id', 'id');
    }
    public function piutang()
    {
        return $this->hasOne(Piutang::class, 'transaksi_id', 'id');
    }
    public function cashback()
    {
        return $this->hasOne(Cashback::class, 'transaksi_id', 'id');
    }
}
