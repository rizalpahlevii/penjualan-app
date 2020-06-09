<?php

namespace App\Http\Controllers;

use App\Hutang;
use Illuminate\Http\Request;
use Saldo;
use Kas as KasHelper;

class HutangController extends Controller
{
    public function index()
    {
        $total_hutang = Saldo::getTotalHutang();
        $total_sisa_hutang = Saldo::getTotalSisaHutang();
        $total_hutang_terbayar = Saldo::getTotalHutangTerbayar();
        $hutang = Hutang::with('pembelian.suplier')->get();
        return view("pages.transaksi.hutang.index", compact('hutang', 'total_hutang', 'total_sisa_hutang', 'total_hutang_terbayar'));
    }
    public function loadTable()
    {
        if (request()->get('filter')) {
            $hutang = Hutang::with('pembelian.suplier');
            if (request()->get('status_hutang') == "belum bayar") {
                $hutang->where("pembayaran_hutang", "=", "0");
            } elseif (request()->get('status_hutang') == "lunas") {
                $hutang->where("sisa_hutang", "=", "0");
            } elseif (request()->get('status_hutang') == "belum lunas") {
                $hutang->where("sisa_hutang", ">", "0");
            } else {
                $hutang = $hutang;
            }
        } else {
            $hutang = Hutang::with('pembelian.suplier');
            if (request()->get('tanggal_awal') != "all") {
                $hutang = $hutang->whereDate('tanggal_hutang', ">=", request()->get('tanggal_awal'));
            }
            if (request()->get('tanggal_akhir') != "all") {
                $hutang = $hutang->whereDate('tanggal_hutang', "<=", request()->get('tanggal_akhir'));
            }
        }
        $hutang = $hutang->get();
        return view("pages.transaksi.hutang.table_hutang", compact('hutang'));
    }
    public function loadModal($id)
    {
        $hutang = Hutang::with('pembelian.suplier', 'pembelian.detail_pembelian.barang')->where('id', $id)->first();
        return view("pages.transaksi.hutang.modal_hutang", compact('hutang'));
    }
    public function getHutangById($id)
    {
        $hutang = Hutang::with('pembelian', 'suplier')->find($id);
        return response()->json($hutang);
    }
    public function updateHutang(Request $request)
    {
        $hutang = Hutang::find($request->hutang_id);
        if ($request->bayar > $hutang->sisa_hutang) {
            $tampung = $hutang->sisa_hutang;
            $hutang->pembayaran_hutang = $hutang->total_hutang;
            $hutang->sisa_hutang = 0;
            $hutang->status_hutang = "lunas";
            KasHelper::add($hutang->faktur, 'pengeluaran', 'bayar hutang', 0, $request->bayar, $tampung);
        } else {
            $hutang->pembayaran_hutang += $request->bayar;
            $hutang->sisa_hutang -= $request->bayar;
            $hutang->status_hutang = "belum lunas";
            KasHelper::add($hutang->faktur, 'pengeluaran', 'bayar hutang', 0, $request->bayar);
        }
        if ($hutang->save()) {
            return response()->json("berhasil");
        } else {
            return response()->json("gagal");
        }
    }
    public function loadKotakAtas()
    {
        $total_hutang = Saldo::getTotalHutang();
        $total_sisa_hutang = Saldo::getTotalSisaHutang();
        $total_hutang_terbayar = Saldo::getTotalHutangTerbayar();
        return view("pages.transaksi.hutang.kotak_atas", compact('total_hutang', 'total_sisa_hutang', 'total_hutang_terbayar'));
    }
}
