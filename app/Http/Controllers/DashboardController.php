<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Pelanggan;
use App\Suplier;
use App\Transaksi;
use Illuminate\Http\Request;
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
}
