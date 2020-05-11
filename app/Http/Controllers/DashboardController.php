<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Pelanggan;
use App\Suplier;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Saldo;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalBarang = Barang::count();
        $totalPelanggan = Pelanggan::count();
        $omsetBulanIni = Saldo::getOmsetBulanIni();
        $labaRugi = Saldo::getLabaBulanIni();
        return view('pages.dashboard', compact('totalBarang', 'totalPelanggan', 'omsetBulanIni', 'labaRugi'));
    }
    public function grafikLabaRugi()
    {
        $bulanRow = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $laba = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $lb = [];
        $rg = [];
        $transaksi = Transaksi::whereYear('tanggal_transaksi', date('Y'))->get();
        foreach ($transaksi as $key => $row) {
            $bulan = explode('-', $row->tanggal_transaksi);
            $bulan = $bulan[1];
            $hpp = 0;
            foreach ($row->detail_transaksi as $detail) {
                $hpp += $detail->jumlah_beli * $detail->barang->harga_beli;
            }
            $hitung = ($row->total - $row->pph - $row->ppn) - $hpp;

            $laba[$bulan - 1] += $hitung;
        }
        for ($i = 0; $i < 12; $i++) {
            if ($laba[$i] < 0) {
                $lb[$i] = 0;
                $rg[$i] = abs($laba[$i]);
            } else {
                $rg[$i] = 0;
                $lb[$i] = abs($laba[$i]);
            }
        }
        return response()->json([
            'bulan' => $bulanRow,
            'laba' => $lb,
            'rugi' => $rg
        ]);
    }
}
