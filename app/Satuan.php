<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'satuan';
    public function barang()
    {
        return $this->hasMany(Barang::class, 'satuan_id', 'id');
    }
}
