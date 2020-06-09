<?php

use App\Cashback;
use App\Helpers\Rekap;
use App\Piutang;
use App\Return_penjualan;
use App\Transaksi;
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
    public static function getReturnPembelian()
    {
        return DB::table('return_pembelian')->sum('total_bayar');
    }
    public static function getOmsetBulanIni()
    {
        $transaksi = Transaksi::whereMonth('tanggal_transaksi', date('m'))->whereYear('tanggal_transaksi', date('Y'))->get();
        $ret = 0;
        foreach ($transaksi as $row) {
            $ret += $row->total - ($row->ppn + $row->pph);
        }
        return $ret;
    }
    public static function return_penjualan()
    {
        $data = Return_penjualan::whereMonth('tanggal_return_jual', date('m'))->whereYear('tanggal_return_jual', date('Y'))->sum('total_bayar');
        return $data;
    }
    public static function getLabaBulanIni()
    {
        $data = Transaksi::whereMonth('tanggal_transaksi', date('m'))->whereYear('tanggal_transaksi', date('Y'))->get();
        $value_keuntungan = 0;
        foreach ($data as $row) {
            if ($row->status == "hutang") {
                foreach ($row->detail_transaksi as $detail_transaksi) {
                    $ppn_pph = 11.5;
                    $keuntungan_persentase = $detail_transaksi->barang->persentase_pph_ppn_keuntungan - $ppn_pph;
                    $value_keuntungan += (($detail_transaksi->harga / 100) * $keuntungan_persentase) * $detail_transaksi->jumlah_beli;
                }
                $value_keuntungan -= $row->piutang->sisa_hutang;
            } else {
                foreach ($row->detail_transaksi as $detail_transaksi) {
                    $ppn_pph = 11.5;
                    $keuntungan_persentase = $detail_transaksi->barang->persentase_pph_ppn_keuntungan - $ppn_pph;
                    $value_keuntungan += (($detail_transaksi->harga / 100) * $keuntungan_persentase) * $detail_transaksi->jumlah_beli;
                }
            }
        }
        return $value_keuntungan - self::return_penjualan() - self::cashback();
    }
    public static function cashback()
    {
        $data = Cashback::whereMonth('tanggal', date('m'))->whereYear('tanggal', date('Y'))->sum('total');
        return $data;
    }
}
