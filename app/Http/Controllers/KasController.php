<?php

namespace App\Http\Controllers;

use App\Kas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasController extends Controller
{
    public function index()
    {
        $kas = Kas::all();
        $pendapatan = DB::table('kas')->sum('pemasukan');
        $pengeluaran = DB::table('kas')->sum('pengeluaran');
        return view("pages.laporan.kas.index", compact('kas', 'pendapatan', 'pengeluaran'));
    }
    public function create()
    {
        $faktur = Kas::kodeFaktur();
        return view("pages.laporan.kas.create", compact('faktur'));
    }
    public function store(Request $request)
    {
        $kas = new Kas();
        $kas->tanggal = $request->tanggal;
        $kas->faktur = $request->faktur;
        $kas->tipe = $request->tipe;
        if ($request->tipe == "pendapatan") {
            $kas->pemasukan = $request->pemasukan;
            $kas->pengeluaran = 0;
            $kas->jenis = $request->jenis_pemasukan;
        } else {
            $kas->pengeluaran = $request->pengeluaran;
            $kas->pemasukan = 0;
            $kas->jenis = $request->jenis_pengeluaran;
        }
        if ($request->keterangan) {
            $kas->keterangan = $request->keterangan;
        } else {
            $kas->keterangan = "Tambah Data Kas lewat user";
        }
        if ($kas->save()) {
            session()->flash('message', 'Data berhasil disimpan!');
            return redirect()->route('transaksi.kas.index')->with('status', 'success');
        } else {
            session()->flash('message', 'Data gagal disimpan!');
            return redirect()->route('transaksi.kas.index')->with('status', 'danger');
        }
    }
    public function loadTable()
    {
        if (request()->get('filter') == "all") {
            $kas = Kas::get();
        } else {
            $kas = Kas::whereDate('tanggal', ">=", request()->get('tanggal_awal'))->whereDate('tanggal', "<=", request()->get('tanggal_akhir'))->get();
        }
        return view("pages.laporan.kas.table", compact('kas'));
    }
    public function loadKotak()
    {
        if (request()->get('filter') == "all") {
            $pendapatan = DB::table('kas')->sum('pemasukan');
            $pengeluaran = DB::table('kas')->sum('pengeluaran');
        } else {
            $pendapatan = DB::table('kas')->whereDate('tanggal', ">=", request()->get('tanggal_awal'))->whereDate('tanggal', "<=", request()->get('tanggal_akhir'))->sum('pemasukan');
            $pengeluaran = DB::table('kas')->whereDate('tanggal', ">=", request()->get('tanggal_awal'))->whereDate('tanggal', "<=", request()->get('tanggal_akhir'))->sum('pengeluaran');
        }
        return view("pages.laporan.kas.kotak_total", compact('pendapatan', 'pengeluaran'));
    }
}
