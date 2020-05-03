<?php

namespace App\Http\Controllers;

use App\Barang;
use App\History_stok_barang_masuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokMasukController extends Controller
{
    public function index()
    {
        $histories = History_stok_barang_masuk::with('suplier')->with('barang')->paginate(10);
        return view("pages.barang.stok_masuk.index", compact('histories'));
    }
    public function create()
    {
        $barang = Barang::get();
        return view("pages.barang.stok_masuk.create", compact('barang'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'barcode' => 'required',
            'nama_barang' => 'required',
            'stok_saat_ini' => 'required',
            'keterangan' => 'required',
            'qty' => 'required|integer|min:0',
        ]);
        try {
            DB::beginTransaction();
            $history = new History_stok_barang_masuk();
            $history->barang_id = $request->barcode;
            $history->qty = $request->qty;
            $history->keterangan = $request->keterangan;
            $history->save();

            $barang = Barang::findOrFail($request->barcode);
            $barang->stok_masuk += (int) $request->qty;
            $barang->stok_akhir += (int) $request->qty;
            $barang->save();
            DB::commit();
            session()->flash('message', 'Stok Berhasil ditambah!');
            return redirect()->route('barang.masuk.index')->with('status', 'success');
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('message', 'Stok gagal ditambah!');
            return redirect()->route('barang.masuk.index')->with('status', 'danger');
        }
    }
}
