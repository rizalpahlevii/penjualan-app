<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Detail_transaksi;
use App\Transaksi;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    protected $page = "pages.transaksi.penjualan.";
    public function periode()
    {
        $transaksi = Transaksi::with('pelanggan')->get();
        return view($this->page . "periode.index", compact('transaksi'));
    }
    public function periodeLoadTable()
    {
        $transaksi = Transaksi::with('pelanggan');
        if (request()->get('lanjut') == "all") {
            if (request()->get('transaksi') != "all") {
                $transaksi->where('status', request()->get('transaksi'));
            }
            $transaksi = $transaksi->whereDate('tanggal_transaksi', ">=", request()->get('start'));
            $transaksi = $transaksi->whereDate('tanggal_transaksi', "<=", request()->get('end'));
        } else {
            if (request()->get('lanjut') == "hari") {
                $transaksi->whereDay('tanggal_transaksi', date('d'));
            } elseif (request()->get('lanjut') == "bulan") {
                $transaksi->whereMonth('tanggal_transaksi', date('m'));
            } else {
                $transaksi->whereYear('tanggal_transaksi', date('Y'));
            }
        }
        $transaksi = $transaksi->get();
        return view($this->page . 'periode.table', compact('transaksi'));
    }
    public function barang()
    {
        $barang = Barang::get();
        $transaksi = Transaksi::where('status', 'asdasd')->get();
        return view($this->page . 'barang.index', compact('barang', 'transaksi'));
    }
    public function barangLoadTable()
    {
        $param = request()->get('barang');
        $transaksi = Transaksi::with(['detail_transaksi' => function ($query) use ($param) {
            $query->where('barang_id', $param);
        }]);
        $transaksi = $transaksi->whereDate('tanggal_transaksi', ">=", request()->get('start'));
        $transaksi = $transaksi->whereDate('tanggal_transaksi', "<=", request()->get('end'));
        $transaksi = $transaksi->get();
        return view($this->page . 'barang.table', compact('transaksi'));
    }
}
