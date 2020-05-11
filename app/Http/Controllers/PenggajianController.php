<?php

namespace App\Http\Controllers;

use App\Gaji;
use App\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kas;

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
        $faktur = Gaji::kodeFaktur();
        $pegawai = Pegawai::with('jabatan')->get();
        return view("pages.transaksi.penggajian.create", compact('pegawai', 'faktur'));
    }
    public function store(Request $request)
    {
        $cek = Gaji::where('pegawai_id', $request->id_pegawai)
            ->whereMonth('tanggal_gaji', date('m'))
            ->whereYear('tanggal_gaji', date('Y'))->first();
        if ($cek == null) {
            $pegawai = Pegawai::with('jabatan')->where('id', $request->id_pegawai)->first();
            $gaji = new Gaji();
            $gaji->faktur = Gaji::kodeFaktur();
            $gaji->pegawai_id = $request->id_pegawai;
            $gaji->tanggal_gaji = date('Y-m-d');
            $gaji->total_gaji = $pegawai->jabatan->gaji_pokok;
            $gaji->potongan = $request->potongan_gaji;
            $gaji->gaji_bersih = $pegawai->jabatan->gaji_pokok - $request->potongan_gaji;
            if ($gaji->save()) {
                Kas::add($gaji->faktur, 'pengeluaran', 'penggajian', 0, $gaji->gaji_bersih);
                return response()->json(['success', $gaji]);
            } else {
                return response()->json(['error', 'Gagal Menyimpan data']);
            }
        } else {
            return response()->json(['error', 'Gaji Bulan ini sudah dibayar']);
        }
    }
    public function loadTable()
    {
        $penggajian = Gaji::with('pegawai');
        if (request()->get('lanjut') == "all") {
            $penggajian = $penggajian->whereMonth('tanggal_gaji', request()->get('bulan'));
            $penggajian = $penggajian->whereYear('tanggal_gaji', request()->get('tahun'));
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
    public function get_detail($id)
    {
        $cek = Gaji::where('pegawai_id', $id)->orderBy('id', 'DESC')->first();
        if ($cek) {
            return response()->json(Carbon::parse($cek->tanggal_gaji)->format('M'));
        } else {
            return response()->json('Belum ada history gaji');
        }
    }
    public function slip($kode)
    {
        $penggajian = Gaji::where('faktur', $kode)->firstOrFail();
        return view("pages.transaksi.penggajian.slip", compact('penggajian'));
    }
}
