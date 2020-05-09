<?php

namespace App\Http\Controllers;


use App\Barang;
use App\Exports\HutangExport as ExportsHutangExport;
use App\Exports\KasExport;
use App\Exports\LabaRugiExport;
use App\Exports\Pembelian\AllExport;
use App\Exports\Pembelian\HutangExport;
use App\Exports\Pembelian\TunaiExport;
use App\Exports\PenggajianExport;
use App\Hutang;
use App\Kas;
use App\Pembelian;
use App\Piutang;
use App\Return_pembelian;
use App\Return_penjualan;
use App\Transaksi;
use App\Exports\Penjualan\BarangExport;
use App\Exports\Penjualan\PeriodeExport;
use App\Exports\PiutangExport;
use App\Gaji;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelController extends Controller
{
    public function penjualanBarangExport()
    {
        $param = request()->get('barang');
        $transaksi = Transaksi::with(['detail_transaksi' => function ($query) use ($param) {
            $query->where('barang_id', $param);
        }]);
        $transaksi = $transaksi->whereDate('tanggal_transaksi', ">=", request()->get('start'));
        $transaksi = $transaksi->whereDate('tanggal_transaksi', "<=", request()->get('end'));
        $transaksi = $transaksi->get();
        return Excel::download(new BarangExport($transaksi), 'Report_penjualan_per_barang.xlsx');
    }
    public function penjualanPeriodeExport()
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
        return Excel::download(new PeriodeExport($transaksi), 'Report_penjualan_per_periode.xlsx');
    }
    public function pembelianExcel()
    {
        if (request()->get('status') == "all") {
            if (request()->get('tanggal_awal') && request()->get('tanggal_akhir')) {
                $pembelian = Pembelian::with('suplier')
                    ->whereDate('tanggal_pembelian', ">=", request()->get('tanggal_awal'))
                    ->whereDate('tanggal_pembelian', "<=", request()->get('tanggal_akhir'))
                    ->get();
                return Excel::download(new AllExport($pembelian), 'Pembelian_tunai-' . request()->get('tanggal_awal') . 'sd' . request()->get('tanggal_akhir') . '.xlsx');
            }
        } elseif (request()->get('status') == "tunai") {

            $pembelian = Pembelian::with('suplier')
                ->where('status', 'tunai')
                ->whereDate('tanggal_pembelian', ">=", request()->get('tanggal_awal'))
                ->whereDate('tanggal_pembelian', "<=", request()->get('tanggal_akhir'))
                ->get();
            return Excel::download(new TunaiExport($pembelian), 'Pembelian_tunai-' . request()->get('tanggal_awal') . 'sd' . request()->get('tanggal_akhir') . '.xlsx');
        } else {
            $pembelian = Pembelian::with('suplier')
                ->where('status', 'hutang')
                ->whereDate('tanggal_pembelian', ">=", request()->get('tanggal_awal'))
                ->whereDate('tanggal_pembelian', "<=", request()->get('tanggal_akhir'))
                ->get();
            return Excel::download(new HutangExport($pembelian), 'Pembelian_hutang-' . request()->get('tanggal_awal') . 'sd' . request()->get('tanggal_akhir') . '.xlsx');
        }
    }
    public function hutangExcel()
    {
        if (request()->get('tanggal_awal') && request()->get('tanggal_akhir')) {
            $totalHutang = Hutang::whereDate('tanggal_hutang', ">=", request()->get('tanggal_awal'))
                ->whereDate('tanggal_hutang', "<=", request()->get('tanggal_akhir'))
                ->sum('total_hutang');
            $totalHutangTerbayar = Hutang::whereDate('tanggal_hutang', ">=", request()->get('tanggal_awal'))
                ->whereDate('tanggal_hutang', "<=", request()->get('tanggal_akhir'))
                ->sum('pembayaran_hutang');
            $totalHutangSisa = Hutang::whereDate('tanggal_hutang', ">=", request()->get('tanggal_awal'))
                ->whereDate('tanggal_hutang', "<=", request()->get('tanggal_akhir'))
                ->sum('sisa_hutang');

            $hutang = Hutang::with('pembelian', 'suplier')
                ->whereDate('tanggal_hutang', ">=", request()->get('tanggal_awal'))
                ->whereDate('tanggal_hutang', "<=", request()->get('tanggal_akhir'))
                ->get();
            return Excel::download(new ExportsHutangExport($totalHutang, $totalHutangTerbayar, $totalHutangSisa, $hutang), 'Hutang-' . request()->get('tanggal_awal') . 'sd' . request()->get('tanggal_akhir') . '.xlsx');
        }
    }
    public function piutangExcel()
    {
        if (request()->get('tanggal_awal') && request()->get('tanggal_akhir')) {
            $totalPiutang = Piutang::whereDate('tanggal_piutang', ">=", request()->get('tanggal_awal'))
                ->whereDate('tanggal_piutang', "<=", request()->get('tanggal_akhir'))
                ->sum('total_hutang');
            $totalPiutangTerbayar = Piutang::whereDate('tanggal_piutang', ">=", request()->get('tanggal_awal'))
                ->whereDate('tanggal_piutang', "<=", request()->get('tanggal_akhir'))
                ->sum('piutang_terbayar');
            $totalPiutangSisa = Piutang::whereDate('tanggal_piutang', ">=", request()->get('tanggal_awal'))
                ->whereDate('tanggal_piutang', "<=", request()->get('tanggal_akhir'))
                ->sum('sisa_piutang');

            $piutang = Piutang::with('transaksi', 'pelanggan')
                ->whereDate('tanggal_piutang', ">=", request()->get('tanggal_awal'))
                ->whereDate('tanggal_piutang', "<=", request()->get('tanggal_akhir'))
                ->get();
            return Excel::download(new PiutangExport($totalPiutang, $totalPiutangTerbayar, $totalPiutangSisa, $piutang), 'Piutang-' . request()->get('tanggal_awal') . 'sd' . request()->get('tanggal_akhir') . '.xlsx');
        }
    }
    public function kasExcel()
    {
        if (request()->get('filter') == "all") {
            $kas = Kas::get();
        } else {
            $kas = Kas::whereDate('tanggal', ">=", request()->get('tanggal_awal'))->whereDate('tanggal', "<=", request()->get('tanggal_akhir'))->get();
        }
        return Excel::download(new KasExport($kas), 'kas-' . request()->get('tanggal_awal') . 'sd' . request()->get('tanggal_akhir') . '.xlsx');
    }
    public function labarugiExcel()
    {
        if (request()->get('tanggal_awal') && request()->get('tanggal_akhir')) {
            $transaksi = Transaksi::whereDate('tanggal_transaksi', ">=", request()->get('tanggal_awal'))
                ->whereDate('tanggal_transaksi', "<=", request()->get('tanggal_akhir'))
                ->get();
            return Excel::download(new LabaRugiExport($transaksi), 'labarugi-' . request()->get('tanggal_awal') . 'sd' . request()->get('tanggal_akhir') . '.xlsx');
        }
    }
    public function penggajianExcel()
    {
        $penggajian = Gaji::with('pegawai');
        if (request()->get('lanjut') == "all") {
            $penggajian = $penggajian->whereMonth('tanggal_gaji', request()->get('bulan'));
            $penggajian = $penggajian->whereYear('tanggal_gaji', request()->get('tahun'));
        } else {
            if (request()->get('lanjut') == "tahun") {
                $penggajian->whereYear('tanggal_gaji', date('Y'));
            } elseif (request()->get('lanjut') == "bulan") {
                $penggajian->whereMonth('tanggal_gaji', date('m'));
                $penggajian->whereYear('tanggal_gaji', date('Y'));
            } else {
                $penggajian = $penggajian;
            }
        }
        $penggajian = $penggajian->get();
        return Excel::download(new PenggajianExport($penggajian), 'penggajin-' . request()->get('bulan') . '-' . request()->get('tahun') . '.xlsx');
    }
}
