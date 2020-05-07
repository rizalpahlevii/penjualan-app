<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Pelanggan;
use App\Suplier;
use App\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalBarang = Barang::count();
        $totalPelanggan = Pelanggan::count();
        $totalSuplier = Suplier::count();
        $totalTransaksi = Transaksi::count();
        return view('pages.dashboard', compact('totalBarang', 'totalPelanggan', 'totalSuplier', 'totalTransaksi'));
    }
}
