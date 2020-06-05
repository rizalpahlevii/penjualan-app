<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cascback_detail extends Model
{
    public function detail_transaksi()
    {
        return $this->belongsTo(Detail_transaksi::class, 'detail_transaksi_id', 'id');
    }
}
