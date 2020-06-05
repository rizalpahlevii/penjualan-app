<?php

namespace App\Http\Controllers;

use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GrafikController extends Controller
{
    public function index()
    {
        $year = Transaksi::selectRaw("DATE_FORMAT(tanggal_transaksi,'%Y') AS year")->groupBy('tanggal_transaksi')->get();
        return view("pages.laporan.grafik.index", compact('year'));
    }
    public function getChartPenjualan()
    {
        $labels = [];
        $data = [];
        $transaksi = Transaksi::select('tanggal_transaksi')
            ->selectRaw("SUM(total) as ttl")
            ->whereMonth('tanggal_transaksi', request()->get('month'))
            ->whereYear('tanggal_transaksi', request()->get('year'))
            ->groupBy('tanggal_transaksi')
            ->orderBy('tanggal_transaksi')->get();
        foreach ($transaksi as $row) {
            $labels[] = Carbon::parse($row->tanggal_transaksi)->format('Y M d');
            $data[] = $row->ttl;
        }
        return response()->json([$labels, $data]);
    }
    public function getChartLaba()
    {
        $labels = [];
        $data = [];
        $transaksi = Transaksi::select('tanggal_transaksi')
            ->selectRaw("SUM(total) as ttl")
            ->whereMonth('tanggal_transaksi', request()->get('month'))
            ->whereYear('tanggal_transaksi', request()->get('year'))
            ->groupBy('tanggal_transaksi')
            ->orderBy('tanggal_transaksi')->get();
        foreach ($transaksi as $row) {
            $transactions = Transaksi::with('detail_transaksi.barang')->where('tanggal_transaksi', $row->tanggal_transaksi)->get();
            $hpp = 0;
            foreach ($transactions as $transaction) {
                foreach ($transaction->detail_transaksi as $detail) {
                    $hpp += $detail->jumlah_beli * $detail->barang->harga_beli;
                }
            }
            $labels[] = Carbon::parse($row->tanggal_transaksi)->format('Y M d');
            $data[] = $row->ttl - $hpp;
        }
        return response()->json([$labels, $data]);
    }
    public function getChartTerjual()
    {
        $labels = [];
        $data = [];
        $transaksi = Transaksi::select('tanggal_transaksi')
            ->whereMonth('tanggal_transaksi', request()->get('month'))
            ->whereYear('tanggal_transaksi', request()->get('year'))
            ->groupBy('tanggal_transaksi')
            ->orderBy('tanggal_transaksi')->get();
        foreach ($transaksi as $row) {
            $transactions = Transaksi::with('detail_transaksi')->where('tanggal_transaksi', $row->tanggal_transaksi)->get();
            $jumlah = 0;
            foreach ($transactions as $transaction) {
                foreach ($transaction->detail_transaksi as $detail) {
                    $jumlah += $detail->jumlah_beli;
                }
            }
            $labels[] = Carbon::parse($row->tanggal_transaksi)->format('Y M d');
            $data[] = $jumlah;
        }
        return response()->json([$labels, $data]);
    }
}
