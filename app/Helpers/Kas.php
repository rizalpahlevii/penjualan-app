<?php

use App\Kas as KasModel;

class Kas
{
    public static function add($faktur, $tipe, $jenis, $pemasukan, $pengeluaran)
    {
        $kas = new KasModel();
        $kas->faktur = $faktur;
        $kas->tipe = $tipe;
        $kas->tanggal = date('Y-m-d');
        $kas->jenis = $jenis;
        $kas->pemasukan = $pemasukan;
        $kas->pengeluaran = $pengeluaran;
        $kas->keterangan = ucwords($jenis) . ' ' . $faktur;
        $kas->save();
    }
}
