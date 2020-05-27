<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Detail_return_jual;
use App\Detail_transaksi;
use App\Pembelian;
use App\Piutang;
use App\Return_penjualan;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Saldo;
use Kas as KasHelper;

class ReturnPenjualanController extends Controller
{
    public function index()
    {
        $return = Return_penjualan::with('transaksi.pelanggan')->get();
        $total = Saldo::getReturnPenjualan();
        return view("pages.transaksi.return.penjualan.index", compact('return', 'total'));
    }
    public function loadTable()
    {
        $return = Return_penjualan::with('transaksi.pelanggan');
        if (request()->get('tanggal_awal') != "all") {
            $return = $return->whereDate('tanggal_return_jual', ">=", request()->get('tanggal_awal'));
        }
        if (request()->get('tanggal_akhir') != "all") {
            $return = $return->whereDate('tanggal_return_jual', "<=", request()->get('tanggal_akhir'));
        }
        $return->get();
        return view("pages.transaksi.return.penjualan.table", compact('return'));
    }
    public function create()
    {
        $pmb = Return_penjualan::select('transaksi_id')->where('status', 'finish')->get()->toArray();
        $transaksi_id = [];
        foreach ($pmb as $row) {
            $transaksi_id[] = $row['transaksi_id'];
        }
        $transaksi = Transaksi::with('pelanggan')->whereNotIn('id', $transaksi_id)->get();
        $faktur = Return_penjualan::kodeFaktur();
        $cart = Detail_return_jual::with('barang')->where('return_jual_id', $faktur)->first();
        return view("pages.transaksi.return.penjualan.create", compact('faktur', 'transaksi'));
    }
    public function loadModal($id)
    {
        $return = Return_penjualan::with('transaksi.pelanggan', 'detail_return_jual.barang')->find($id);
        return view('pages.transaksi.return.penjualan.loadModal', compact('return'));
    }
    public function getTransaksyById($id)
    {
        $transaksi = Transaksi::with('pelanggan', 'detail_transaksi.barang')->find($id);
        $html = '';
        foreach ($transaksi->detail_transaksi as $key => $row) {
            $html .= '<tr>';
            $html .= '<td>' . $row->barang->id . '</td>';
            $html .= '<td>' . $row->barang->nama . '</td>';
            $html .= '<td>' . $row->harga . '</td>';
            $html .= '<td>' . $row->jumlah_beli . '</td>';
            $html .= '<td>' . $row->subtotal . '</td>';

            $html .= '<td><button class="btn btn-sm btn-warning btn-pilih-barang" data-id="' . $row->id . '" data-kbarang="' . $row->barang->id . '" data-nbarang="' . $row->barang->nama . '" data-qty="' . $row->jumlah_beli . '"><i class="fa fa-check-square-o"></i></button></td>';
            $html .= '</tr>';
        }

        $cek = Return_penjualan::where('transaksi_id', $transaksi->id)->first();
        $html2 = '';
        if ($cek != null) {
            $return_penjualan = Return_penjualan::with('detail_return_jual')->where('transaksi_id', $transaksi->id)->first();
            foreach ($return_penjualan->detail_return_jual as $key => $row) {
                $data2 = Detail_transaksi::with('barang')->where('transaksi_id', $transaksi->id)->where('barang_id', $row->barang_id)->first();
                $html2 .= '<tr>';
                $html2 .= '<td id="kodeBarangck">' . $data2->barang->id . '</td>';
                $html2 .= '<td>' . $data2->barang->nama . '</td>';
                $html2 .= '<td>' . $data2->harga . '</td>';
                $html2 .= '<td>' . $row->jumlah_beli . '</td>';
                $html2 .= '<td id="total_text">' . $row->jumlah_beli *  $data2->harga . '</td>';
                $html2 .= '<td><button class="btn btn-danger btn-delete-return" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button></td>';
                $html2 .= '</tr>';
            }
        }
        if ($html2 != "") {
            $html2 = $html2;
        } else {
            $html2 = [];
        }
        return response()->json([$transaksi, $html, $html2]);
    }
    public function addCart(Request $request)
    {
        $transaksi = Transaksi::where('kode', $request->kode_transaksi)->first();
        $return_penjualan = Return_penjualan::where('transaksi_id', $transaksi->id)->first();
        $detail_transaksi = Detail_transaksi::where('barang_id', $request->kode_barang)->where('transaksi_id', $transaksi->id)->first();


        if ($return_penjualan) {
            $detail_return_penjualan = Detail_return_jual::where('barang_id', $request->kode_barang)->where('return_jual_id', $return_penjualan->id)->first();
            if ($detail_return_penjualan) {
                if ($detail_return_penjualan->jumlah_beli + $request->qty  > $detail_transaksi->jumlah_beli) {
                    return response()->json(["error", "Quantity return penjualan melebihi jumlah beli"]);
                } else {
                    $detail_return_penjualan->jumlah_beli += $request->qty;
                    if ($detail_return_penjualan->save()) {
                        $return_penjualan->total_bayar += $detail_transaksi->harga * $request->qty;
                        $return_penjualan->save();
                        return response()->json(["success", "Success menambah ke list return", $transaksi->id]);
                    }
                }
            } else {
                if ($request->qty  > $detail_transaksi->jumlah_beli) {
                    return response()->json(["error", "Quantity return penjualan melebihi jumlah beli"]);
                } else {
                    $insertDetail = new Detail_return_jual();
                    $insertDetail->barang_id = $request->kode_barang;
                    $insertDetail->return_jual_id = $return_penjualan->id;
                    $insertDetail->jumlah_beli = $request->qty;
                    $insertDetail->save();
                    if ($insertDetail->save()) {
                        $return_penjualan->total_bayar += $detail_transaksi->harga * $request->qty;
                        $return_penjualan->save();
                        return response()->json(["success", "Success menambah ke list return", $transaksi->id]);
                    }
                }
            }
        } else {
            $return = new Return_penjualan();
            $return->tanggal_return_jual = date('Y-m-d');
            $return->transaksi_id = $transaksi->id;
            $return->faktur = $request->faktur;
            $return->user_id = Auth::user()->id;
            $return->total_bayar = 0;
            if ($return->save()) {
                if ($request->qty  > $detail_transaksi->jumlah_beli) {
                    return response()->json(["error", "Quantity return penjualan melebihi jumlah beli"]);
                } else {
                    $insertDetail = new Detail_return_jual();
                    $insertDetail->barang_id = $request->kode_barang;
                    $insertDetail->return_jual_id = $return->id;
                    $insertDetail->jumlah_beli = $request->qty;
                    $insertDetail->save();
                    if ($insertDetail->save()) {
                        $update = Return_penjualan::find($return->id);
                        $update->total_bayar += $request->qty * $detail_transaksi->harga;
                        $update->save();
                        return response()->json(["success", "Success menambah ke list return", $transaksi->id]);
                    }
                }
            }
        }
    }
    public function loadDataReturn($id)
    {
        $return_penjualan = Return_penjualan::with('detail_return_jual')->where('transaksi_id', $id)->first();
        $html2 = '';
        foreach ($return_penjualan->detail_return_jual as $key => $row) {
            $data2 = Detail_transaksi::with('barang')->where('transaksi_id', $id)->where('barang_id', $row->barang_id)->first();
            $html2 .= '<tr>';
            $html2 .= '<td id="kodeBarangck">' . $data2->barang->id . '</td>';
            $html2 .= '<td>' . $data2->barang->nama . '</td>';
            $html2 .= '<td>' . $data2->harga . '</td>';
            $html2 .= '<td>' . $row->jumlah_beli . '</td>';
            $html2 .= '<td id="total_text">' . $row->jumlah_beli *  $data2->harga . '</td>';
            $html2 .= '<td><button class="btn btn-danger btn-delete-return" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button></td>';
            $html2 .= '</tr>';
        }
        return response()->json($html2);
    }
    public function deleteReturn(Request $request)
    {
        $detail = Detail_return_jual::find($request->id);
        $return = Return_penjualan::find($detail->return_jual_id);
        $transaksi = Transaksi::find($return->transaksi_id);
        $detail_transaksi = Detail_transaksi::where('transaksi_id', $transaksi->id)->where('barang_id', $detail->barang_id)->first();

        if ($detail->delete()) {
            $return->total_bayar -= $detail_transaksi->harga * $detail->jumlah_beli;
            $return->save();
            $cek = Return_penjualan::with('detail_return_jual')->find($return->id);
            if ($cek->detail_return_jual) {
                return response()->json(["oke", $transaksi->id]);
            } else {
                $cek->delete();
                return response()->json(["oke", $transaksi->id]);
            }
        } else {
            return response()->json("gagal");
        }
    }
    public function store(Request $request)
    {
        $transaksi = Transaksi::where('kode', $request->kode_transaksi)->first();
        $return = Return_penjualan::where('transaksi_id', $transaksi->id)->first();
        $return->status = 'finish';
        $return->tanggal_return_jual = $request->tanggal;
        $return->save();
        KasHelper::add($return->faktur, 'pengeluaran', 'return penjualan', 0, $return->total_bayar);
        self::updateDataTransaksiAfterReturn($transaksi->id);
        return response()->json(["success", "Success"]);
    }
    public static function updateDataTransaksiAfterReturn($transaksi_id)
    {
        $transaksi = Transaksi::with('detail_transaksi')->find($transaksi_id);
        $return = Return_penjualan::with('detail_return_jual')->where('transaksi_id', $transaksi->id)->first();
        $return_detail = Detail_return_jual::with('barang')->where('return_jual_id', $return->id)->get();
        $kurangi = 0;
        if ($transaksi->status == "tunai") {
            foreach ($return_detail as $key => $row) {
                $detail_transaksi = Detail_transaksi::where('transaksi_id', $transaksi->id)->where('barang_id', $row->barang_id)->first();
                $barang = Barang::find($detail_transaksi->barang_id);
                if ($detail_transaksi->jumlah_beli - $row->jumlah_beli == 0) {
                    $kurangi += $detail_transaksi->subtotal;
                    $detail_transaksi->delete();
                } else {
                    $detail_transaksi->jumlah_beli -= $row->jumlah_beli;
                    $detail_transaksi->subtotal -= $row->jumlah_beli * $detail_transaksi->harga;
                    $detail_transaksi->update();
                    $kurangi += $row->jumlah_beli * $detail_transaksi->harga;
                }
                $barang->stok_akhir += $row->jumlah_beli;
                $barang->stok_keluar -= $row->jumlah_beli;
                $barang->save();
            }
            $transaksi->total -= $kurangi;
            $transaksi->save();
        } else {
            $piutang = Piutang::where('transaksi_id', $transaksi->id)->first();
            foreach ($return_detail as $key => $row) {
                $detail_transaksi = Detail_transaksi::where('transaksi_id', $transaksi->id)->where('barang_id', $row->barang_id)->first();
                $barang = Barang::find($detail_transaksi->barang_id);
                if ($detail_transaksi->jumlah_beli - $row->jumlah_beli == 0) {
                    $kurangi += $detail_transaksi->subtotal;
                    $detail_transaksi->delete();
                } else {
                    $detail_transaksi->jumlah_beli -= $row->jumlah_beli;
                    $detail_transaksi->subtotal -= $row->jumlah_beli * $detail_transaksi->harga;
                    $detail_transaksi->update();
                    $kurangi += $row->jumlah_beli * $detail_transaksi->harga;
                }
                $barang->stok_akhir += $row->jumlah_beli;
                $barang->stok_keluar -= $row->jumlah_beli;
                $barang->save();
            }
            $sisa_piutang_akhir = $piutang->sisa_piutang;
            $piutang_terbayar = $piutang->piutang_terbayar;
            $piutang_total = $piutang->total_hutang;


            $piutang->total_hutang -= $kurangi;
            if ($sisa_piutang_akhir - $kurangi <= 0) {
                $piutang->sisa_piutang = 0;
                $piutang->piutang_terbayar = $piutang->total_hutang;
            } else {
                $tampung =  $piutang->total_hutang - $kurangi;
                $piutang->sisa_piutang = $tampung - $piutang->piutang_terbayar;
                if ($piutang->sisa_piutang == 0) {
                    $piutang->piutang_terbayar = $tampung;
                }
                if ($piutang->piutang_terbayar > $tampung) {
                    $piutang->piutang_terbayar = $tampung;
                }
            }
            $transaksi->total -= $kurangi;
            $piutang->save();
            $transaksi->save();
        }
        return response()->json(["success", "Return berhasil diproses"]);
    }
}
