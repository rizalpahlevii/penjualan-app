<?php

namespace App\Http\Controllers;

use App\Gaji;
use App\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggajianController extends Controller
{
    public function index()
    {
        $years = Gaji::select(DB::raw('YEAR(tanggal_gaji) as year'))->distinct()->get();
        $penggajian = Gaji::with('pegawai')->get();
        return view("pages.transaksi.penggajian.index", compact('penggajian', 'years'));
    }
    public function create()
    {
        $pegawai = Pegawai::with('jabatan')->get();
        return view("pages.transaksi.penggajian.create", compact('pegawai'));
    }
    public function loadTable()
    {
        $penggajian = Gaji::with('pegawai');
        if (request()->get('lanjut') == "all") {
            $penggajian = $penggajian->whereMonth('tanggal_transaksi', request()->get('bulan'));
            $penggajian = $penggajian->whereYear('tanggal_transaksi', request()->get('tahun'));
        } else {
            if (request()->get('lanjut') == "tahun") {
                $penggajian->whereYear('tanggal_gaji', date('Y'));
            } elseif (request()->get('lanjut') == "bulan") {
                $penggajian->whereMonth('tanggal_gaji', date('m'));
                $penggajian->whereYear('tanggal_gaji', date('Y'));
            } else {
                $penggajian = $penggajian;
            }
        }
        $penggajian = $penggajian->get();
        return view("pages.transaksi.penggajian.table", compact('penggajian'));
    }
}
