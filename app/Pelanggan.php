<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    public function piutang()
    {
        return $this->hasMany(Piutang::class, 'pelanggan_id', 'id');
    }
}
