<?php

namespace App\Http\Controllers;

use App\Helpers\Rekap;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index()
    {
        $rekap = new Rekap();
        $penjualan = $rekap->penjualan();
        $return_penjualan = $rekap->return_penjualan();
        $laba_rugi_penjualan = $rekap->laba_rugi_penjualan();
        $pembelian = $rekap->pembelian();
        $return_pembelian = $rekap->return_pembelian();
        $piutang = $rekap->piutang();
        $hutang = $rekap->hutang();
        $penggajian = $rekap->penggajian();
        $ppn_pph = $rekap->ppn_pph();
        $cashback = $rekap->cashback();
        $transport = $rekap->transport();
        $pemasukan_lain = $rekap->pemasukan_lain();
        $pengeluaran_lain = $rekap->pengeluaran_lain();
        $saldo_netto = $rekap->saldo_netto();
        return view("pages.report.rekap.index", compact('penjualan', 'return_penjualan', 'laba_rugi_penjualan', 'pembelian', 'return_pembelian', 'piutang', 'hutang', 'penggajian', 'ppn_pph', 'cashback', 'transport', 'pemasukan_lain', 'pengeluaran_lain'));
    }
    public function loadTable()
    {
        if (request()->get('filter') == "all") {
            $rekap = new Rekap();
        } else {
            $rekap = new Rekap(request()->get('tanggal_awal'), request()->get('tanggal_akhir'));
        }
        $penjualan = $rekap->penjualan();
        $return_penjualan = $rekap->return_penjualan();
        $laba_rugi_penjualan = $rekap->laba_rugi_penjualan();
        $pembelian = $rekap->pembelian();
        $return_pembelian = $rekap->return_pembelian();
        $piutang = $rekap->piutang();
        $hutang = $rekap->hutang();
        $penggajian = $rekap->penggajian();
        $ppn_pph = $rekap->ppn_pph();
        $cashback = $rekap->cashback();
        $transport = $rekap->transport();
        $pemasukan_lain = $rekap->pemasukan_lain();
        $pengeluaran_lain = $rekap->pengeluaran_lain();
        $saldo_netto = $rekap->saldo_netto();
        return view("pages.report.rekap.table", compact('penjualan', 'return_penjualan', 'laba_rugi_penjualan', 'pembelian', 'return_pembelian', 'piutang', 'hutang', 'penggajian', 'ppn_pph', 'cashback', 'transport', 'pemasukan_lain', 'pengeluaran_lain'));
    }
    public function print()
    {
        $rekap = new Rekap(request()->get('tanggal_awal'), request()->get('tanggal_akhir'));
        $penjualan = $rekap->penjualan();
        $return_penjualan = $rekap->return_penjualan();
        $laba_rugi_penjualan = $rekap->laba_rugi_penjualan();
        $pembelian = $rekap->pembelian();
        $return_pembelian = $rekap->return_pembelian();
        $piutang = $rekap->piutang();
        $hutang = $rekap->hutang();
        $penggajian = $rekap->penggajian();
        $ppn_pph = $rekap->ppn_pph();
        $cashback = $rekap->cashback();
        $transport = $rekap->transport();
        $pemasukan_lain = $rekap->pemasukan_lain();
        $pengeluaran_lain = $rekap->pengeluaran_lain();
        $saldo_netto = $rekap->saldo_netto();
        return view("pages.report.rekap.print", compact('penjualan', 'return_penjualan', 'laba_rugi_penjualan', 'pembelian', 'return_pembelian', 'piutang', 'hutang', 'penggajian', 'ppn_pph', 'cashback', 'transport', 'pemasukan_lain', 'pengeluaran_lain'));
    }
}
