<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'pelanggan_id', 'id');
    }
    public function piutang()
    {
        return $this->hasMany(Piutang::class, 'pelanggan_id', 'id');
    }
}
