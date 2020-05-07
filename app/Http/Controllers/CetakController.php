<?php

namespace App\Http\Controllers;

use App\Hutang;
use App\Kas;
use App\Pembelian;
use App\Piutang;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CetakController extends Controller
{
    protected $pages;
    public function __construct()
    {
        $this->pages = "pages.laporan.cetak.";
    }
    public function index()
    {
        return view($this->pages . 'index');
    }
    public function penjualan()
    {
        if (request()->get('start') && request()->get('end')) {
            $transaksiTunai = Transaksi::where('status', 'tunai')
                ->whereDate('tanggal_transaksi', ">=", request()->get('start'))
                ->whereDate('tanggal_transaksi', "<=", request()->get('end'))
                ->sum('total');
            $transaksiHutang = Transaksi::where('status', 'hutang')
                ->whereDate('tanggal_transaksi', ">=", request()->get('start'))
                ->whereDate('tanggal_transaksi', "<=", request()->get('end'))
                ->sum('total');
            $transaksi = Transaksi::with('pelanggan')
                ->whereDate('tanggal_transaksi', ">=", request()->get('start'))
                ->whereDate('tanggal_transaksi', "<=", request()->get('end'))
                ->get();
            return view($this->pages . 'penjualan', compact('transaksiTunai', 'transaksiHutang', 'transaksi'));
        }
    }
    public function penjualanTunai()
    {
        if (request()->get('start') && request()->get('end')) {
            $transaksiTunai = Transaksi::where('status', 'tunai')
                ->whereDate('tanggal_transaksi', ">=", request()->get('start'))
                ->whereDate('tanggal_transaksi', "<=", request()->get('end'))
                ->sum('total');

            $transaksi = Transaksi::with('pelanggan')
                ->where('status', 'tunai')
                ->whereDate('tanggal_transaksi', ">=", request()->get('start'))
                ->whereDate('tanggal_transaksi', "<=", request()->get('end'))
                ->get();
            return view($this->pages . 'penjualan_tunai', compact('transaksiTunai', 'transaksi'));
        }
    }
    public function penjualanKredit()
    {
        if (request()->get('start') && request()->get('end')) {
            $transaksiHutang = Transaksi::where('status', 'hutang')
                ->whereDate('tanggal_transaksi', ">=", request()->get('start'))
                ->whereDate('tanggal_transaksi', "<=", request()->get('end'))
                ->sum('total');

            $transaksi = Transaksi::with('pelanggan')
                ->where('status', 'hutang')
                ->whereDate('tanggal_transaksi', ">=", request()->get('start'))
                ->whereDate('tanggal_transaksi', "<=", request()->get('end'))
                ->get();
            return view($this->pages . 'penjualan_hutang', compact('transaksiHutang', 'transaksi'));
        }
    }
    public function pembelian()
    {
        if (request()->get('start') && request()->get('end')) {
            $pembelianTunai = Pembelian::where('status', 'tunai')
                ->whereDate('tanggal_pembelian', ">=", request()->get('start'))
                ->whereDate('tanggal_pembelian', "<=", request()->get('end'))
                ->sum('total');
            $pembelianHutang = Pembelian::where('status', 'hutang')
                ->whereDate('tanggal_pembelian', ">=", request()->get('start'))
                ->whereDate('tanggal_pembelian', "<=", request()->get('end'))
                ->sum('total');
            $pembelian = Pembelian::with('suplier')
                ->whereDate('tanggal_pembelian', ">=", request()->get('start'))
                ->whereDate('tanggal_pembelian', "<=", request()->get('end'))
                ->get();
            return view($this->pages . 'pembelian', compact('pembelianTunai', 'pembelianHutang', 'pembelian'));
        }
    }
    public function pembelianTunai()
    {
        if (request()->get('start') && request()->get('end')) {
            $pembelianTunai = Pembelian::where('status', 'tunai')
                ->whereDate('tanggal_pembelian', ">=", request()->get('start'))
                ->whereDate('tanggal_pembelian', "<=", request()->get('end'))
                ->sum('total');

            $pembelian = Pembelian::with('suplier')
                ->where('status', 'tunai')
                ->whereDate('tanggal_pembelian', ">=", request()->get('start'))
                ->whereDate('tanggal_pembelian', "<=", request()->get('end'))
                ->get();
            return view($this->pages . 'pembelian_tunai', compact('pembelianTunai', 'pembelian'));
        }
    }
    public function pembelianKredit()
    {
        if (request()->get('start') && request()->get('end')) {
            $pembelianHutang = Pembelian::where('status', 'hutang')
                ->whereDate('tanggal_pembelian', ">=", request()->get('start'))
                ->whereDate('tanggal_pembelian', "<=", request()->get('end'))
                ->sum('total');

            $pembelian = Pembelian::with('suplier')
                ->where('status', 'hutang')
                ->whereDate('tanggal_pembelian', ">=", request()->get('start'))
                ->whereDate('tanggal_pembelian', "<=", request()->get('end'))
                ->get();
            return view($this->pages . 'pembelian_hutang', compact('pembelianHutang', 'pembelian'));
        }
    }
    public function hutang()
    {
        if (request()->get('start') && request()->get('end')) {
            $totalHutang = Hutang::whereDate('tanggal_hutang', ">=", request()->get('start'))
                ->whereDate('tanggal_hutang', "<=", request()->get('end'))
                ->sum('total_hutang');
            $totalHutangTerbayar = Hutang::whereDate('tanggal_hutang', ">=", request()->get('start'))
                ->whereDate('tanggal_hutang', "<=", request()->get('end'))
                ->sum('pembayaran_hutang');
            $totalHutangSisa = Hutang::whereDate('tanggal_hutang', ">=", request()->get('start'))
                ->whereDate('tanggal_hutang', "<=", request()->get('end'))
                ->sum('sisa_hutang');

            $hutang = Hutang::with('pembelian', 'suplier')
                ->whereDate('tanggal_hutang', ">=", request()->get('start'))
                ->whereDate('tanggal_hutang', "<=", request()->get('end'))
                ->get();
            return view($this->pages . 'hutang', compact('totalHutang', 'hutang', 'totalHutangTerbayar', 'totalHutangSisa'));
        }
    }
    public function piutang()
    {
        if (request()->get('start') && request()->get('end')) {
            $totalPiutang = Piutang::whereDate('tanggal_piutang', ">=", request()->get('start'))
                ->whereDate('tanggal_piutang', "<=", request()->get('end'))
                ->sum('total_hutang');
            $totalPiutangTerbayar = Piutang::whereDate('tanggal_piutang', ">=", request()->get('start'))
                ->whereDate('tanggal_piutang', "<=", request()->get('end'))
                ->sum('piutang_terbayar');
            $totalPiutangSisa = Piutang::whereDate('tanggal_piutang', ">=", request()->get('start'))
                ->whereDate('tanggal_piutang', "<=", request()->get('end'))
                ->sum('sisa_piutang');

            $piutang = Piutang::with('transaksi', 'pelanggan')
                ->whereDate('tanggal_piutang', ">=", request()->get('start'))
                ->whereDate('tanggal_piutang', "<=", request()->get('end'))
                ->get();
            return view($this->pages . 'piutang', compact('totalPiutang', 'piutang', 'totalPiutangTerbayar', 'totalPiutangSisa'));
        }
    }
    public function kas()
    {
        if (request()->get('start') && request()->get('end')) {
            $pendapatan = Kas::whereDate('tanggal', ">=", request()->get('start'))
                ->whereDate('tanggal', "<=", request()->get('end'))->sum('pemasukan');
            $pengeluaran = Kas::whereDate('tanggal', ">=", request()->get('start'))
                ->whereDate('tanggal', "<=", request()->get('end'))->sum('pengeluaran');
            $kas = Kas::whereDate('tanggal', ">=", request()->get('start'))
                ->whereDate('tanggal', "<=", request()->get('end'))->get();
            return view($this->pages . 'kas', compact('kas', 'pendapatan', 'pengeluaran'));
        }
    }
    public function labaRugi()
    {
        if (request()->get('start') && request()->get('end')) {
            $transaksi = Transaksi::whereDate('tanggal_transaksi', ">=", request()->get('start'))
                ->whereDate('tanggal_transaksi', "<=", request()->get('end'))
                ->get();
            return view($this->pages . 'laba_rugi', compact('transaksi'));
        }
    }
}
