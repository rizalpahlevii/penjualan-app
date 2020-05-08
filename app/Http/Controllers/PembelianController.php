<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Detail_pembelian;
use App\History_stok_barang_masuk;
use App\Hutang;
use App\Pembelian;
use App\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kas as KasHelper;
use Saldo;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelian = Pembelian::with('suplier')->get();
        $total = Saldo::getTotalPembelian();
        return view("pages.transaksi.pembelian.index", compact('pembelian', 'total'));
    }
    public function loadTable()
    {
        $pembelian = Pembelian::with('suplier');
        if (request()->get('tanggal_awal') != "all") {
            $pembelian = $pembelian->whereDate('tanggal_pembelian', ">=", request()->get('tanggal_awal'));
        }
        if (request()->get('tanggal_akhir') != "all") {
            $pembelian = $pembelian->whereDate('tanggal_pembelian', "<=", request()->get('tanggal_akhir'));
        }
        if (request()->get('pembelian') != "all") {
            $pembelian = $pembelian->where('status', request()->get('pembelian'));
        }
        $pembelian = $pembelian->get();
        return view("pages.transaksi.pembelian.table", compact('suplier', 'pembelian'));
    }
    public function loadKotakAtas()
    {
        $total = Saldo::getTotalPembelian();
        return view("pages.transaksi.pembelian.kotak_atas", compact('total'));
    }
    public function create()
    {
        $kodeFaktur = Pembelian::kodeFaktur();
        $suplier = Suplier::get();
        $barang = Barang::get();
        return view("pages.transaksi.pembelian.create", compact('barang', 'suplier', 'kodeFaktur'));
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $pembelian = new Pembelian();
            $pembelian->faktur = $request->faktur;
            $pembelian->suplier_id = $request->suplier_id;
            $pembelian->tanggal_pembelian = date('Y-m-d');
            $total = 0;
            foreach ($request->data as $row) {
                $total += $row['subtotal'];
            }
            $pembelian->total = $total;
            $pembelian->status = $request->status;
            $pembelian->save();
            foreach ($request->data as $row) {
                $detail = new Detail_pembelian();
                $detail->pembelian_id = $pembelian->id;
                $detail->barang_id = $row['kode_barang'];
                $detail->jumlah_beli = $row['jumlah'];
                $detail->subtotal = $row['subtotal'];
                $detail->save();
                self::insertDataToHistory($row['kode_barang'], $request->suplier_id, $row['jumlah']);
                self::updateStokbarang($row['kode_barang'], $row['jumlah']);
            }
            if ($request->status != "tunai") {
                $hutang = new Hutang();
                $hutang->faktur = Hutang::kodeFaktur();
                $hutang->tanggal_hutang = date('Y-m-d');
                $hutang->tanggal_tempo = $request->tempo;
                $hutang->suplier_id = $request->suplier_id;
                $hutang->pembelian_id = $pembelian->id;
                $hutang->total_hutang = $total;
                $hutang->pembayaran_hutang = 0;
                $hutang->sisa_hutang = $total;
                $hutang->save();
            } else {
                KasHelper::add($pembelian->faktur, 'pengeluaran', 'pembelian', 0, $pembelian->total);
            }
            DB::commit();
            return response()->json(["success", "Pembelian berhasil"]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(["error", "Pembelian gagal"]);
        }
    }
    public function loadModal($id)
    {
        $pembelian = Pembelian::with('suplier', 'detail_pembelian.barang')->find($id);
        return view("pages.transaksi.pembelian.modal", compact('pembelian'));
    }
    public static function updateStokbarang($barang_id, $qty)
    {
        $barang = Barang::find($barang_id);
        $barang->stok_masuk += $qty;
        $barang->stok_akhir += $qty;
        $barang->update();
    }
    public static function insertDataToHistory($barang_id, $suplier_id, $qty)
    {
        $history = new History_stok_barang_masuk();
        $history->barang_id = $barang_id;
        $history->qty = $qty;
        $history->suplier_id = $suplier_id;
        $history->keterangan = "Stok masuk dari suplier";
        $history->save();
    }
}
