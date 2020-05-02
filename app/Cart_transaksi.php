<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart_transaksi extends Model
{
    protected $table = 'cart_transaksi';
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
}
