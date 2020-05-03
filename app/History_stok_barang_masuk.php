<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History_stok_barang_masuk extends Model
{
    protected $table = 'history_stok_barang_masuk';
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
    public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'suplier_id', 'id');
    }
}
