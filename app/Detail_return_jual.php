<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_return_jual extends Model
{
    protected $table = 'detail_return_jual';
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
}
