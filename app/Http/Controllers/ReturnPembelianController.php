<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Detail_pembelian;
use App\Detail_return_pembelian;
use App\Hutang;
use App\Pembelian;
use App\Return_pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kas as KasHelper;
use Saldo;

class ReturnPembelianController extends Controller
{
    public function index()
    {
        $total = Saldo::getReturnPembelian();
        $return = Return_pembelian::with('pembelian.suplier')->get();
        return view("pages.transaksi.return.pembelian.index", compact('return', 'total'));
    }
    public function create()
    {
        $faktur = Return_pembelian::kodeFaktur();
        $pembelian = Pembelian::with('suplier')->whereDoesntHave('return_pembelian')->get();
        return view("pages.transaksi.return.pembelian.create", compact('pembelian', 'faktur'));
    }
    public function loadBarang($id)
    {
        $pembelian = Pembelian::with('detail_pembelian.barang')->find($id);
        $html = '';
        foreach ($pembelian->detail_pembelian as $key => $row) {
            $html .= '<tr>';
            $html .= '<td>' . $row->barang->id . '</td>';
            $html .= '<td>' . $row->barang->nama . '</td>';
            $html .= '<td>' . $row->barang->harga_beli . '</td>';
            $html .= '<td>' . $row->jumlah_beli . '</td>';
            $html .= '<td>' . $row->subtotal . '</td>';
            $html .= '<td><button class="btn btn-sm btn-warning btn-pilih-barang" data-id="' . $row->id . '" data-kbarang="' . $row->barang->id . '" data-nbarang="' . $row->barang->nama . '" data-qty="' . $row->jumlah_beli . '" data-harga="' . $row->barang->harga_beli . '"><i class="fa fa-check-square-o"></i></button></td>';
            $html .= '</td>';
        }
        return response()->json([$pembelian, $html]);
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $pembelian = Pembelian::where('faktur', $request->faktur_pembelian)->first();
            $new = [];

            foreach ($request->data as $key => $row) {
                if ($request->faktur_pembelian == $row['faktur_pembelian']) {
                    $new[$key]['faktur_pembelian'] = $row['faktur_pembelian'];
                    $new[$key]['kode_barang'] = $row['kode_barang'];
                    $new[$key]['nama_barang'] = $row['nama_barang'];
                    $new[$key]['harga'] = $row['harga'];
                    $new[$key]['jumlah_dikembalikan'] = $row['jumlah_dikembalikan'];
                    $new[$key]['subtotal'] = $row['subtotal'];
                }
            }
            $total = 0;

            foreach ($new as $row) {
                $total += $row['subtotal'];
            }
            $return = new Return_pembelian();
            $return->faktur = $request->faktur;
            $return->pembelian_id = $pembelian->id;
            $return->tanggal_pembelian = $pembelian->tanggal_pembelian;
            $return->tanggal_return_pembelian = date('Y-m-d');
            $return->total_bayar = $total;
            $return->save();
            foreach ($new as $row) {
                $detail = new Detail_return_pembelian();
                $detail->barang_id = $row['kode_barang'];
                $detail->return_beli_id = $return->id;
                $detail->jumlah_beli = $row['jumlah_dikembalikan'];
                $detail->save();
            }
            KasHelper::add($return->faktur, 'pendapatan', 'return pembelian', $return->total_bayar, 0);
            self::updateDataAfterReturn($pembelian->id);
            DB::commit();
            return response()->json(['success', 'Return pembelian berhasil!']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error', 'Return pembelian gagal!']);
        }
    }
    public static function updateDataAfterReturn($pembelian_id)
    {
        $pembelian = Pembelian::with('detail_pembelian')->find($pembelian_id);
        $return = Return_pembelian::with('detail_return_pembelian.barang')->where('pembelian_id', $pembelian_id)->first();
        $kurangi = 0;
        if ($pembelian->status == "tunai") {
            foreach ($return->detail_return_pembelian as $key => $row) {
                $detail = Detail_pembelian::where('pembelian_id', $pembelian->id)->where('barang_id', $row->barang_id)->first();
                $detail->jumlah_beli -= $row->jumlah_beli;
                $detail->subtotal -= $row->jumlah_beli * $row->barang->harga_beli;
                $kurangi += $row->jumlah_beli * $row->barang->harga_beli;
                $detail->save();
                $barang = Barang::find($row->barang_id);
                $barang->stok_akhir -= $row->jumlah_beli;
                $barang->stok_masuk -= $row->jumlah_beli;
                $barang->save();
            }
        } else {
            foreach ($return->detail_return_pembelian as $key => $row) {
                $detail = Detail_pembelian::where('pembelian_id', $pembelian->id)->where('barang_id', $row->barang_id)->first();
                $detail->jumlah_beli -= $row->jumlah_beli;
                $detail->subtotal -= $row->jumlah_beli * $row->barang->harga_beli;
                $kurangi += $row->jumlah_beli * $row->barang->harga_beli;
                $detail->save();
                $barang = Barang::find($row->barang_id);
                $barang->stok_akhir -= $row->jumlah_beli;
                $barang->stok_masuk -= $row->jumlah_beli;
                $barang->save();
            }
            $hutang = Hutang::where('pembelian_id', $pembelian->id)->first();
            $th = $hutang->total_hutang;
            $hutang->total_hutang -= $kurangi;
            $hutang->sisa_hutang -= $th - $hutang->pembayaran_hutang;
            if ($hutang->sisa_hutang <= 0) {
                $hutang->sisa_hutang = 0;
                $hutang->status = "lunas";
            }
            $hutang->save();
        }
        $pembelian->total -= $kurangi;
        $pembelian->save();
    }
}
