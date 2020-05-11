<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Cart_transaksi;
use App\Detail_transaksi;
use App\Pelanggan;
use App\Piutang;
use App\Transaksi;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Kas as KasHelper;

class KasirController extends Controller
{
    public function index()
    {
        $cart = Cart_transaksi::with('barang')->where('status', 'cart')->where('user_id', Auth::user()->id)->get();
        $kode = Transaksi::kode();
        $pelanggan = Pelanggan::get();
        return view("pages.kasir.index", compact('kode', 'pelanggan', 'cart'));
    }
    public function getBarangById($id)
    {
        $barang = Barang::with('kategori', 'satuan')->find($id);
        if ($barang) {
            return response()->json($barang);
        } else {
            return response()->json("no result");
        }
    }
    public function addToCart(Request $request)
    {
        $cart = Cart_transaksi::where('barang_id', $request->barcode)->where('status', 'cart')->where('user_id', 1)->first();
        if ($cart) {
            $cart = Cart_transaksi::where('barang_id', $request->barcode)->first();
            $cart->qty += $request->qty;
            $cart->subtotal += $request->qty * $request->harga;
        } else {
            $cart = new Cart_transaksi();
            $cart->barang_id = $request->barcode;
            $cart->price =  $request->harga;
            $cart->qty = (int) $request->qty;
            $cart->subtotal = ($request->harga * $request->qty);
            $cart->user_id =  Auth::user()->id;
            $cart->status = 'cart';
        }
        if ($cart->save()) {
            return response()->json("berhasil");
        } else {
            return response()->json("gagal");
        }
    }
    public function loadtable()
    {
        $cart = Cart_transaksi::with('barang')->where('status', 'cart')->where('user_id',  Auth::user()->id)->get();
        return view("pages.transaksi.partials.table_cart", compact('cart'));
    }
    public function cancel(Request $request)
    {
        $cart = Cart_transaksi::where('status', 'cart')->where('user_id',  Auth::user()->id);
        if ($cart->delete()) {
            return response()->json("cancel");
        } else {
            return response()->json("failed");
        }
    }
    public function deleteCart(Request $request)
    {
        $cart = Cart_transaksi::find($request->id);
        if ($cart->delete()) {
            return response()->json("Berhasil");
        } else {
            return response()->json("gagal");
        }
    }
    public function changeQty(Request $request)
    {
        $cart = Cart_transaksi::find($request->id);
        if ($request->type == "increment") {
            $cart->qty += 1;
            $cart->subtotal += $cart->price;
            $cart->save();
        } else {
            if ($cart->qty == 1) {
                $cart->delete();
            } else {
                $cart->qty -= 1;
                $cart->subtotal -= $cart->price;
                $cart->save();
            }
        }
        return response()->json("Berhasil");
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $transaksi = new Transaksi();
            $transaksi->kode = $request->kode;
            $transaksi->tanggal_transaksi = Carbon::now()->format('Y-m-d');
            $transaksi->total = $request->grandtotal;
            $transaksi->diskon = $request->diskon_value;
            $transaksi->ppn = $request->ppn_value;
            $transaksi->pph = $request->pph_value;
            $transaksi->status = $request->pembayaran;
            $transaksi->pelanggan_id = (int) $request->id_pelanggan;
            $transaksi->user_id = Auth::user()->id;
            $transaksi->save();

            $carts = Cart_transaksi::where('user_id',  Auth::user()->id)->where('status', 'cart');
            foreach ($carts->get() as $key => $cart) {
                $detail = new Detail_transaksi();
                $detail->transaksi_id = $transaksi->id;
                $detail->barang_id = $cart->barang_id;
                $detail->jumlah_beli = $cart->qty;
                $detail->harga = $cart->price;
                $detail->subtotal = $cart->subtotal;
                $detail->save();

                $delete = Barang::find($cart->barang_id);
                if (!$delete->stok_akhir < $cart->qty) {
                    $delete->stok_keluar += $cart->qty;
                    $delete->stok_akhir -= $cart->qty;
                    $delete->save();
                } else {
                    DB::rollback();
                    return response()->json("Stok tidak cukup");
                    return;
                }
            }
            $carts->delete();

            if ($request->pembayaran == "hutang") {
                $piutang = new Piutang();
                $piutang->faktur = Piutang::kodeFaktur();
                $piutang->tanggal_piutang = Carbon::now()->format('Y-m-d');
                $piutang->total_hutang = $request->grandtotal;
                $piutang->piutang_terbayar = 0;
                $piutang->tanggal_tempo = $request->tgl_jatuh_tempo;
                $piutang->sisa_piutang = $request->grandtotal;
                $piutang->pelanggan_id = $request->id_pelanggan;
                $piutang->transaksi_id = $transaksi->id;
                $piutang->save();
            } else {
                KasHelper::add($transaksi->kode, 'pendapatan', 'penjualan', $transaksi->total, 0);
            }
            DB::commit();
            $response = Transaksi::with('pelanggan', 'detail_transaksi.barang')->find($transaksi->id);
            if ($request->pembayaran == "tunai") {
                $response2 = [
                    'bayar' => $request->bayar,
                    'kembali' => $request->kembali,
                ];
                return response()->json(["Transaksi Berhasil", $response, $response2]);
            } else {
                return response()->json(["Transaksi Berhasil", $response]);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json("gagal");
        }
    }
    public function struk($invoice)
    {
        $transaksi = Transaksi::where('kode', $invoice)->first();
        return view("pages.kasir.struk", compact('transaksi'));
        // $pdf = PDF::loadView('pages.kasir.struk', compact('transaksi'))->setPaper('a4', 'portrait');
        // return $pdf->stream('Struk-penjualan-' . $invoice . '.pdf');
    }
}
