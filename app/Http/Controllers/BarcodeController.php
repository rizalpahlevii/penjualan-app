<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view("pages.barang.barcode.index", compact('barang'));
    }
}
