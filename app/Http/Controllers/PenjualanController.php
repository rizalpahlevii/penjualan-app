<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Cashback;
use App\Cashback_detail;
use App\Detail_transaksi;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kas as KasHelper;

class PenjualanController extends Controller
{
    protected $page = "pages.transaksi.penjualan.";
    public function index()
    {
        $transaksi = Transaksi::with('pelanggan')->get();
        return view($this->page . "index", compact('transaksi'));
    }
    public function nota($kode)
    {
        $transaksi = Transaksi::where('kode', $kode)->firstOrFail();
        return view($this->page . "nota", compact('transaksi'));
    }
    public function loadTable()
    {
        $transaksi = Transaksi::with('pelanggan');
        if (request()->get('lanjut') == "all") {
            if (request()->get('transaksi') != "all") {
                $transaksi->where('status', request()->get('transaksi'));
            }
            $transaksi = $transaksi->whereDate('tanggal_transaksi', ">=", request()->get('start'));
            $transaksi = $transaksi->whereDate('tanggal_transaksi', "<=", request()->get('end'));
        } else {
            if (request()->get('lanjut') == "hari") {
                $transaksi->where('tanggal_transaksi', date('Y-m-d'));
            } elseif (request()->get('lanjut') == "bulan") {
                $transaksi->whereMonth('tanggal_transaksi', date('m'));
                $transaksi->whereYear('tanggal_transaksi', date('Y'));
            } else {
                $transaksi->whereYear('tanggal_transaksi', date('Y'));
            }
        }
        $transaksi = $transaksi->get();
        return view($this->page . 'table', compact('transaksi'));
    }
    public function periode()
    {
        $transaksi = Transaksi::with('pelanggan')->get();
        return view($this->page . "periode.index", compact('transaksi'));
    }
    public function periodeLoadTable()
    {
        $transaksi = Transaksi::with('pelanggan');
        if (request()->get('lanjut') == "all") {
            if (request()->get('transaksi') != "all") {
                $transaksi->where('status', request()->get('transaksi'));
            }
            $transaksi = $transaksi->whereDate('tanggal_transaksi', ">=", request()->get('start'));
            $transaksi = $transaksi->whereDate('tanggal_transaksi', "<=", request()->get('end'));
        } else {
            if (request()->get('lanjut') == "hari") {
                $transaksi->where('tanggal_transaksi', date('Y-m-d'));
            } elseif (request()->get('lanjut') == "bulan") {
                $transaksi->whereMonth('tanggal_transaksi', date('m'));
                $transaksi->whereYear('tanggal_transaksi', date('Y'));
            } else {
                $transaksi->whereYear('tanggal_transaksi', date('Y'));
            }
        }
        $transaksi = $transaksi->get();
        return view($this->page . 'periode.table', compact('transaksi'));
    }
    public function barang()
    {
        $barang = Barang::get();
        $transaksi = Transaksi::where('status', 'asdasd')->get();
        return view($this->page . 'barang.index', compact('barang', 'transaksi'));
    }
    public function barangLoadTable()
    {
        $param = request()->get('barang');
        $transaksi = Transaksi::with(['detail_transaksi' => function ($query) use ($param) {
            $query->where('barang_id', $param);
        }]);
        $transaksi = $transaksi->whereDate('tanggal_transaksi', ">=", request()->get('start'));
        $transaksi = $transaksi->whereDate('tanggal_transaksi', "<=", request()->get('end'));
        $transaksi = $transaksi->get();
        return view($this->page . 'barang.table', compact('transaksi'));
    }
    public function cashback($kode)
    {
        $transaksi = Transaksi::where('kode', $kode)->firstOrFail();
        if ($transaksi->cashback != null) {
            session()->flash('message', 'Cashback sudah dibayar!');
            return redirect()->route('transaksi.penjualan.all')->with('status', 'danger');
        }
        return view($this->page . 'cashback', compact('transaksi'));
    }
    public function cashbackPost(Request $request, $kode)
    {
        try {
            DB::beginTransaction();
            $params = $request->all();
            $transaksi = Transaksi::where('kode', $kode)->firstOrFail();
            $cashback = new Cashback();
            $cashback->faktur = Cashback::kodeFaktur();
            $cashback->tanggal = date('Y-m-d');
            $cashback->transaksi_id = $transaksi->id;
            $cashback->total = $params['total_cashback'];
            $cashback->save();
            for ($i = 1; $i <= $params['total_row']; $i++) {
                $cashback_detail = new Cashback_detail();
                $cashback_detail->cashback_id = $cashback->id;
                $cashback_detail->detail_transaksi_id = $params['detail_transaksi_id' . $i];
                $cashback_detail->cashback_per_item = $params['cashback_value' . $i];
                $cashback_detail->qty = $params['qty_hidden' . $i];
                $cashback_detail->subtotal = $params['subtotal_cashback' . $i];
                $cashback_detail->save();
            }
            KasHelper::add($cashback->faktur, 'pengeluaran', 'cashback', 0, $cashback->total);
            DB::commit();
            $response = [
                'status' => 'success',
                'data' => $transaksi
            ];
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
            ];
            DB::rollback();
        }
        return response()->json($response);
    }
    public function notaCashback($kode)
    {
        $transaksi = Transaksi::where('kode', $kode)->firstOrFail();
        return view($this->page . 'cashback_nota', compact('transaksi'));
    }
}
