<?php

namespace App\Http\Controllers;

use App\Helpers\Rekap;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index()
    {
        $penjualan = Rekap::penjualan();
        $return_penjualan = Rekap::return_penjualan();
        $laba_rugi_penjualan = Rekap::laba_rugi_penjualan();
        $pembelian = Rekap::pembelian();
        $return_pembelian = Rekap::return_pembelian();
        return view("pages.report.rekap.index", compact('penjualan', 'return_penjualan', 'laba_rugi_penjualan', 'pembelian', 'return_pembelian'));
    }
}
