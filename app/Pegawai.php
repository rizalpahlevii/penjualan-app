<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');
    }
    public function gaji()
    {
        return $this->hasMany(Gaji::class, 'pegawai_id', 'id');
    }
}
