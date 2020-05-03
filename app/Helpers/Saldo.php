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


    public static function getTotalPembelian()
    {
        return DB::table('pembelian')->sum('total');
    }


    public static function getTotalHutang()
    {
        return DB::table('hutang')->sum('total_hutang');
    }
    public static function getTotalHutangTerbayar()
    {
        return DB::table('hutang')->sum('pembayaran_hutang');
    }
    public static function getTotalSisaHutang()
    {
        return DB::table('hutang')->sum('sisa_hutang');
    }
}
