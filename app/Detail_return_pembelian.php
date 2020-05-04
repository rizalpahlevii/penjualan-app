<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_return_pembelian extends Model
{
    protected $table = 'detail_return_pembelian';
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
}
