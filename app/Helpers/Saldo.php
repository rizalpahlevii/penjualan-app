<?php

use App\Piutang;
use Illuminate\Support\Facades\DB;

class Saldo
{
    public static function getTotalPiutang()
    {
        $total = DB::table('piutang')->sum('total_hutang');
        return $total;
    }
    public static function getPiutangTerbayar()
    {
        $total = DB::table('piutang')->sum('piutang_terbayar');
        return $total;
    }
    public static function getSisaPiutang()
    {
        $total_piutang = DB::table('piutang')->sum('sisa_piutang');
        return $total_piutang;
    }
    public static function getSaldoTransaksiTunai()
    {
        $total = DB::table('transaksi')->sum('transaksi')->where('status', 'tunai');
        return $total;
    }
    public static function getReturnPenjualan()
    {
        $total = DB::table('return_penjualan')->sum('total_bayar');
        return $total;
    }
}
