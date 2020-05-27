<?php

use App\Piutang;
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
    public static function getLabaBulanIni()
    {
        $transaksi = Transaksi::whereMonth('tanggal_transaksi', date('m'))->whereYear('tanggal_transaksi', date('Y'))->get();
        $total = 0;
        $hpp = 0;
        foreach ($transaksi as $row) {
            if ($row->status == "hutang") {
                if ($row->piutang != null) {
                    // if ($row->piutang->sisa_piutang == 0) {
                    // $total += $row->total - ($row->ppn + $row->pph);
                    foreach ($row->detail_transaksi as $detail) {
                        $hpp += $detail->jumlah_beli * $detail->barang->harga_beli;
                    }
                    // }
                    $total += $row->piutang->piutang_terbayar;
                }
            } else {
                $total += $row->total - ($row->ppn + $row->pph);
                foreach ($row->detail_transaksi as $detail) {
                    $hpp += $detail->jumlah_beli * $detail->barang->harga_beli;
                }
            }
        }
        return ['total_penjualan' => $total, 'hpp' => $hpp, 'laba_rugi' => $total - $hpp];
    }
}
