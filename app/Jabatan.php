<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'jabatan_id', 'id');
    }
}
