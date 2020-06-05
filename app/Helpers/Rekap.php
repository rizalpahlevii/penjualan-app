<?php

namespace App\Helpers;

use App\Pembelian;
use App\Return_pembelian;
use App\Return_penjualan;
use App\Transaksi;

class Rekap
{
    public static function penjualan($start = null, $end = null)
    {
        if ($start & $end) {
            $data = Transaksi::whereDate('tanggal', ">=", $start)
                ->whereDate('tanggal', "<=", $end)->sum('total');
        } else {
            $data = Transaksi::sum('total');
        }
        return $data;
    }
    public static function return_penjualan($start = null, $end = null)
    {
        if ($start & $end) {
            $data = Return_penjualan::whereDate('tanggal_return_jual', ">=", $start)
                ->whereDate('tanggal_return_jual', "<=", $end)->sum('total');
        } else {
            $data = Return_penjualan::sum('total_bayar');
        }
        return $data;
    }
    public static function laba_rugi_penjualan($start = null, $end = null)
    {
        if ($start & $end) {
            $data = Transaksi::whereDate('tanggal', ">=", $start)
                ->whereDate('tanggal', "<=", $end)->get();
            $value = 0;
            foreach ($data as $row) {
                if ($row->status == "hutang") {
                    $value += $row->piutang->piutang_terbayar;
                } else {
                    $value += $row->total;
                }
            }
        } else {
            $data = Transaksi::get();
            $value = 0;
            foreach ($data as $row) {
                if ($row->status == "hutang") {
                    $value += $row->piutang->piutang_terbayar;
                } else {
                    $value += $row->total;
                }
            }
        }
        return $value;
    }
    public static function pembelian($start = null, $end = null)
    {
        if ($start & $end) {
            $data = Pembelian::whereDate('tanggal_pembelian', ">=", $start)
                ->whereDate('tanggal_pembelian', "<=", $end)->sum('total');
        } else {
            $data = Pembelian::sum('total');
        }
        return $data;
    }
    public static function return_pembelian($start = null, $end = null)
    {
        if ($start & $end) {
            $data = Return_pembelian::whereDate('tanggal_return_pembelian', ">=", $start)
                ->whereDate('tanggal_return_pembelian', "<=", $end)->sum('total');
        } else {
            $data = Return_pembelian::sum('total_bayar');
        }
        return $data;
    }
}
