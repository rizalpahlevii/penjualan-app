<?php

namespace App\Http\Controllers;

use App\Transaksi;
use Illuminate\Http\Request;

class LabarugiController extends Controller
{
    public function index()
    {
        $transaksiTunai = Transaksi::get();
        return view("pages.laporan.labarugi.index", compact('transaksiTunai'));
    }
    public function loadTable()
    {
        $transaksiTunai = Transaksi::whereDate('tanggal_transaksi', ">=", request()->get('tanggal_awal'))
            ->whereDate('tanggal_transaksi', "<=", request()->get('tanggal_akhir'))
            ->get();
        return view("pages.laporan.labarugi.table", compact('transaksiTunai'));
    }
}
