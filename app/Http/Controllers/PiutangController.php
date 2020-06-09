<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use Illuminate\Http\Request;
use App\Piutang;
use Illuminate\Support\Facades\DB;
use Kas as KasHelper;
use Saldo;

class PiutangController extends Controller
{
    public function index()
    {
        $piutang = Piutang::with('transaksi', 'pelanggan')->get();
        $pelanggan = Pelanggan::has('piutang')->get();
        $total_piutang = Saldo::getTotalPiutang();
        $total_sisa_piutang = Saldo::getSisaPiutang();
        $total_piutang_terbayar = Saldo::getPiutangTerbayar();
        return view("pages.transaksi.piutang.index", compact('piutang', 'total_piutang', 'pelanggan', 'total_sisa_piutang', 'total_piutang_terbayar'));
    }
    public function loadTable()
    {
        if (request()->get('filter')) {
            $piutang = Piutang::with('transaksi', 'pelanggan');
            if (request()->get('filter') == "belum_dibayar") {
                $piutang->where("status_piutang", "belum bayar");
            } elseif (request()->get('filter') == "lunas") {
                $piutang->where("sisa_piutang", "lunas");
            } elseif (request()->get('filter') == "belum_lunas") {
                $piutang->where("sisa_piutang", "belum lunas");
            } else {
                $piutang = $piutang;
            }
        } else {
            $piutang = Piutang::with('transaksi', 'pelanggan');
            if (request()->get('tanggal_awal') != "all") {
                $piutang = $piutang->whereDate('tanggal_piutang', ">=", request()->get('tanggal_awal'));
            }
            if (request()->get('tanggal_akhir') != "all") {
                $piutang = $piutang->whereDate('tanggal_piutang', "<=", request()->get('tanggal_akhir'));
            }
            if (request()->get('pelanggan') != "all") {
                $piutang = $piutang->where('pelanggan_id', request()->get('pelanggan'));
            }
        }
        $piutang = $piutang->get();
        return view("pages.transaksi.piutang.table_piutang", compact('piutang'));
    }
    public function loadModal($id)
    {
        $piutang = Piutang::with('pelanggan', 'transaksi.detail_transaksi.barang')->where('id', $id)->first();
        return view("pages.transaksi.piutang.modal_piutang", compact('piutang'));
    }
    public function getPIutangById($id)
    {
        $piutang = Piutang::with('pelanggan', 'transaksi')->find($id);
        return response()->json($piutang);
    }
    public function updatePiutang(Request $request)
    {
        $piutang = Piutang::find($request->piutang_id);
        if ($request->bayar > $piutang->sisa_piutang) {
            $tampung = $piutang->sisa_piutang;
            $piutang->piutang_terbayar = $piutang->total_hutang;
            $piutang->sisa_piutang = 0;
            $piutang->status_piutang = "lunas";
            KasHelper::add($piutang->faktur, 'pendapatan', 'bayar piutang', $tampung, 0);
        } else {
            $piutang->piutang_terbayar += $request->bayar;
            $piutang->sisa_piutang -= $request->bayar;
            $piutang->status_piutang = "belum lunas";
            KasHelper::add($piutang->faktur, 'pendapatan', 'bayar piutang', $request->bayar, 0);
        }
        if ($piutang->save()) {
            return response()->json("berhasil");
        } else {
            return response()->json("gagal");
        }
    }
    public function loadKotakAtas()
    {
        $total_piutang = Saldo::getTotalPiutang();
        $total_sisa_piutang = Saldo::getSisaPiutang();
        $total_piutang_terbayar = Saldo::getPiutangTerbayar();
        return view("pages.transaksi.piutang.kotak_atas", compact('total_piutang', 'total_sisa_piutang', 'total_piutang_terbayar'));
    }
}
