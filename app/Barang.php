<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use SoftDeletes;
    protected $table = 'barang';
    public $incrementing = false;
    public static function kodeBarang()
    {
        $cek = Barang::withTrashed()->get();
        if ($cek->count() > 0) {
            $peminjaman = Barang::orderBy('id', 'DESC')->withTrashed()->first();
            $nourut = (int) substr($peminjaman->id, -7, 7);
            $nourut++;
            $char = "BRG";
            $number = $char  .  sprintf("%07s", $nourut);
        } else {
            $number = "BRG"  . "0000001";
        }
        return $number;
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id');
    }
    public function detail_transaksi()
    {
        return $this->hasMany(Detail_transaksi::class, 'barang_id', 'id');
    }
}
