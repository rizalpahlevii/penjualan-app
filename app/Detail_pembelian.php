<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_pembelian extends Model
{
    protected $table = 'detail_pembelian';
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
}
