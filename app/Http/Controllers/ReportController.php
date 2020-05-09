<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Gaji;
use App\Hutang;
use App\Kas;
use App\Pembelian;
use App\Piutang;
use App\Return_pembelian;
use App\Return_penjualan;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Saldo;

class ReportController extends Controller
{
    protected $page = "pages.report.";
    public function penjualanPerBarang()
    {
        $barang = Barang::get();
        $transaksi = Transaksi::where('status', 'asdasd')->get();
        return view($this->page . 'penjualan.barang.index', compact('barang', 'transaksi'));
    }

    public function penjualanPerBarangLoadTable()
    {
        $param = request()->get('barang');
        $transaksi = Transaksi::with(['detail_transaksi' => function ($query) use ($param) {
            $query->where('barang_id', $param);
        }]);
        $transaksi = $transaksi->whereDate('tanggal_transaksi', ">=", request()->get('start'));
        $transaksi = $transaksi->whereDate('tanggal_transaksi', "<=", request()->get('end'));
        $transaksi = $transaksi->get();
        return view($this->page . 'penjualan.barang.table', compact('transaksi'));
    }
    public function penjualanPerBarangPrint()
    {
        $param = request()->get('barang');
        $transaksi = Transaksi::with(['detail_transaksi' => function ($query) use ($param) {
            $query->where('barang_id', $param);
        }]);
        $transaksi = $transaksi->whereDate('tanggal_transaksi', ">=", request()->get('start'));
        $transaksi = $transaksi->whereDate('tanggal_transaksi', "<=", request()->get('end'));
        $transaksi = $transaksi->get();
        return view($this->page . 'penjualan.barang.print', compact('transaksi'));
    }

    public function penjualanPerPeriode()
    {
        $transaksi = Transaksi::with('pelanggan')->get();
        return view($this->page . "penjualan.periode.index", compact('transaksi'));
    }
    public function penjualanPerPeriodeLoadTable()
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
        return view($this->page . 'penjualan.periode.table', compact('transaksi'));
    }
    public function penjualanPerPeriodePrint()
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
        return view($this->page . 'penjualan.periode.print', compact('transaksi'));
    }


    public function kas()
    {
        $kas = Kas::all();
        $pendapatan = DB::table('kas')->sum('pemasukan');
        $pengeluaran = DB::table('kas')->sum('pengeluaran');
        $faktur = Kas::kodeFaktur();
        return view("pages.report.kas.index", compact('kas', 'pendapatan', 'pengeluaran'));
    }

    public function kasloadTable()
    {
        if (request()->get('filter') == "all") {
            $kas = Kas::get();
        } else {
            $kas = Kas::whereDate('tanggal', ">=", request()->get('tanggal_awal'))->whereDate('tanggal', "<=", request()->get('tanggal_akhir'))->get();
        }
        return view("pages.report.kas.table", compact('kas'));
    }
    public function kasloadKotak()
    {
        if (request()->get('filter') == "all") {
            $pendapatan = DB::table('kas')->sum('pemasukan');
            $pengeluaran = DB::table('kas')->sum('pengeluaran');
        } else {
            $pendapatan = DB::table('kas')->whereDate('tanggal', ">=", request()->get('tanggal_awal'))->whereDate('tanggal', "<=", request()->get('tanggal_akhir'))->sum('pemasukan');
            $pengeluaran = DB::table('kas')->whereDate('tanggal', ">=", request()->get('tanggal_awal'))->whereDate('tanggal', "<=", request()->get('tanggal_akhir'))->sum('pengeluaran');
        }
        return view("pages.report.kas.kotak_total", compact('pendapatan', 'pengeluaran'));
    }
    public function kasPrint()
    {
        if (request()->get('filter') == "all") {
            $kas = Kas::get();
        } else {
            $kas = Kas::whereDate('tanggal', ">=", request()->get('tanggal_awal'))->whereDate('tanggal', "<=", request()->get('tanggal_akhir'))->get();
        }
        return view("pages.report.kas.print", compact('kas'));
    }
    public function LabaRugiindex()
    {
        $transaksiTunai = Transaksi::get();
        return view("pages.report.labarugi.index", compact('transaksiTunai'));
    }
    public function LabaRugiloadTable()
    {
        $transaksiTunai = Transaksi::whereDate('tanggal_transaksi', ">=", request()->get('tanggal_awal'))
            ->whereDate('tanggal_transaksi', "<=", request()->get('tanggal_akhir'))
            ->get();
        return view("pages.report.labarugi.table", compact('transaksiTunai'));
    }
    public function LabaRugiPrint()
    {
        if (request()->get('tanggal_awal') && request()->get('tanggal_akhir')) {
            $transaksi = Transaksi::whereDate('tanggal_transaksi', ">=", request()->get('tanggal_awal'))
                ->whereDate('tanggal_transaksi', "<=", request()->get('tanggal_akhir'))
                ->get();
            return view("pages.report.labarugi.print", compact('transaksi'));
        }
    }
    public function pembelian()
    {
        $pembelian = Pembelian::with('suplier')->get();
        $total = Saldo::getTotalPembelian();
        return view("pages.report.pembelian.index", compact('pembelian', 'total'));
    }
    public function pembelianLoadTable()
    {
        $pembelian = Pembelian::with('suplier');
        if (request()->get('tanggal_awal') != "all") {
            $pembelian = $pembelian->whereDate('tanggal_pembelian', ">=", request()->get('tanggal_awal'));
        }
        if (request()->get('tanggal_akhir') != "all") {
            $pembelian = $pembelian->whereDate('tanggal_pembelian', "<=", request()->get('tanggal_akhir'));
        }
        if (request()->get('status') != "all") {
            $pembelian = $pembelian->where('status', request()->get('status'));
        }
        $pembelian = $pembelian->get();
        return view("pages.report.pembelian.table", compact('pembelian', 'suplier'));
    }
    public function pembelianloadKotakAtas()
    {
        $total = Saldo::getTotalPembelian();
        return view("pages.report.pembelian.kotak_atas", compact('total'));
    }




    public function pembelianPrint()
    {
        if (request()->get('status') == "all") {
            if (request()->get('tanggal_awal') && request()->get('tanggal_akhir')) {
                $pembelianTunai = Pembelian::where('status', 'tunai')
                    ->whereDate('tanggal_pembelian', ">=", request()->get('tanggal_awal'))
                    ->whereDate('tanggal_pembelian', "<=", request()->get('tanggal_akhir'))
                    ->sum('total');
                $pembelianHutang = Pembelian::where('status', 'hutang')
                    ->whereDate('tanggal_pembelian', ">=", request()->get('tanggal_awal'))
                    ->whereDate('tanggal_pembelian', "<=", request()->get('tanggal_akhir'))
                    ->sum('total');
                $pembelian = Pembelian::with('suplier')
                    ->whereDate('tanggal_pembelian', ">=", request()->get('tanggal_awal'))
                    ->whereDate('tanggal_pembelian', "<=", request()->get('tanggal_akhir'))
                    ->get();
                return view('pages.report.pembelian.print', compact('pembelianTunai', 'pembelianHutang', 'pembelian'));
            }
        } elseif (request()->get('status') == "tunai") {
            $pembelianTunai = Pembelian::where('status', 'tunai')
                ->whereDate('tanggal_pembelian', ">=", request()->get('tanggal_awal'))
                ->whereDate('tanggal_pembelian', "<=", request()->get('tanggal_akhir'))
                ->sum('total');

            $pembelian = Pembelian::with('suplier')
                ->where('status', 'tunai')
                ->whereDate('tanggal_pembelian', ">=", request()->get('tanggal_awal'))
                ->whereDate('tanggal_pembelian', "<=", request()->get('tanggal_akhir'))
                ->get();
            return view('pages.report.pembelian.print_tunai', compact('pembelianTunai', 'pembelian'));
        } else {
            $pembelianHutang = Pembelian::where('status', 'hutang')
                ->whereDate('tanggal_pembelian', ">=", request()->get('tanggal_awal'))
                ->whereDate('tanggal_pembelian', "<=", request()->get('tanggal_akhir'))
                ->sum('total');

            $pembelian = Pembelian::with('suplier')
                ->where('status', 'hutang')
                ->whereDate('tanggal_pembelian', ">=", request()->get('tanggal_awal'))
                ->whereDate('tanggal_pembelian', "<=", request()->get('tanggal_akhir'))
                ->get();
            return view('pages.report.pembelian.print_hutang', compact('pembelianHutang', 'pembelian'));
        }
    }
    public function hutang()
    {
        $total_hutang = Saldo::getTotalHutang();
        $total_sisa_hutang = Saldo::getTotalSisaHutang();
        $total_hutang_terbayar = Saldo::getTotalHutangTerbayar();
        $hutang = Hutang::with('pembelian.suplier')->get();
        return view("pages.report.hutang.index", compact('hutang', 'total_hutang', 'total_sisa_hutang', 'total_hutang_terbayar'));
    }
    public function hutangLoadTable()
    {

        if (request()->get('filter')) {
            $hutang = Hutang::with('pembelian.suplier');
            if (request()->get('filter') == "belum_dibayar") {
                $hutang->where("pembayaran_hutang", "=", "0");
            } elseif (request()->get('filter') == "lunas") {
                $hutang->where("sisa_hutang", "=", "0");
            } elseif (request()->get('filter') == "belum_lunas") {
                $hutang->where("sisa_hutang", ">", "0");
            } else {
                $hutang = $hutang;
            }
        } else {
            $hutang = Hutang::with('pembelian.suplier');
            if (request()->get('tanggal_awal') != "all") {
                $hutang = $hutang->whereDate('tanggal_hutang', ">=", request()->get('tanggal_awal'));
            }
            if (request()->get('tanggal_akhir') != "all") {
                $hutang = $hutang->whereDate('tanggal_hutang', "<=", request()->get('tanggal_akhir'));
            }
        }
        $hutang = $hutang->get();
        return view("pages.report.hutang.table", compact('hutang'));
    }
    public function hutangLoadKotak()
    {
        $total_hutang = Saldo::getTotalHutang();
        $total_sisa_hutang = Saldo::getTotalSisaHutang();
        $total_hutang_terbayar = Saldo::getTotalHutangTerbayar();
        return view("pages.report.hutang.kotak", compact('total_hutang', 'total_sisa_hutang', 'total_hutang_terbayar'));
    }
    public function hutangPrint()
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
            return view('pages.report.hutang.print', compact('totalHutang', 'hutang', 'totalHutangTerbayar', 'totalHutangSisa'));
        }
    }
    public function piutang()
    {
        $piutang = Piutang::with('transaksi', 'pelanggan')->get();
        $total_piutang = Saldo::getTotalPiutang();
        $total_sisa_piutang = Saldo::getSisaPiutang();
        $total_piutang_terbayar = Saldo::getPiutangTerbayar();
        return view("pages.report.piutang.index", compact('piutang', 'total_piutang', 'total_sisa_piutang', 'total_piutang_terbayar'));
    }
    public function piutangLoadTable()
    {
        if (request()->get('filter')) {
            $piutang = Piutang::with('transaksi', 'pelanggan');
            if (request()->get('filter') == "belum_dibayar") {
                $piutang->where("piutang_terbayar", "=", "0");
            } elseif (request()->get('filter') == "lunas") {
                $piutang->where("sisa_piutang", "=", "0");
            } elseif (request()->get('filter') == "belum_lunas") {
                $piutang->where("sisa_piutang", ">", "0");
            } else {
                $piutang = $piutang;
            }
        } else {
            $piutang = Piutang::with('transaksi', 'pelanggan');
            if (request()->get('tanggal_awal') != "all") {
                $piutang = $piutang->whereDate('tanggal_piutang', ">=", request()->get('tanggal_awal'));
            }
            if (request()->get('tanggal_akhir') != "all") {
                $piutang = $piutang->whereDate('tanggal_piutang', "<=", request()->get('tanggal_akhir'));
            }
        }
        $piutang = $piutang->get();
        return view("pages.report.piutang.table", compact('piutang'));
    }
    public function piutangLoadKotak()
    {
        $total_piutang = Saldo::getTotalPiutang();
        $total_sisa_piutang = Saldo::getSisaPiutang();
        $total_piutang_terbayar = Saldo::getPiutangTerbayar();
        return view("pages.report.piutang.kotak", compact('total_piutang', 'total_sisa_piutang', 'total_piutang_terbayar'));
    }
    public function piutangPrint()
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
            return view("pages.report.piutang.print", compact('totalPiutang', 'piutang', 'totalPiutangTerbayar', 'totalPiutangSisa'));
        }
    }
    public function penggajian()
    {
        $years = Gaji::select(DB::raw('YEAR(tanggal_gaji) as year'))->distinct()->get();
        $penggajian = Gaji::with('pegawai')->get();
        return view("pages.report.penggajian.index", compact('penggajian', 'years'));
    }
    public function penggajianLoadTable()
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
        return view("pages.report.penggajian.table", compact('penggajian'));
    }
    public function penggajianPrint()
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
        return view("pages.report.penggajian.print", compact('penggajian'));
    }
}
