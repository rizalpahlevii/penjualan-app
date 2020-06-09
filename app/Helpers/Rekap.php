<?php

namespace App\Helpers;

use App\Cashback;
use App\Gaji;
use App\Hutang;
use App\Kas;
use App\Pembelian;
use App\Piutang;
use App\Return_pembelian;
use App\Return_penjualan;
use App\Transaksi;

class Rekap
{
    protected $start;
    protected $end;
    public function __construct($start = null, $end = null)
    {
        $this->start = $start;
        $this->end = $end;
    }
    public function penjualan()
    {
        if ($this->start & $this->end) {
            $data['tunai'] = Transaksi::whereDate('tanggal_transaksi', ">=", $this->start)
                ->whereDate('tanggal_transaksi', "<=", $this->end)->where('status', 'tunai')->sum('total');
            $data['non_tunai'] = Transaksi::whereDate('tanggal_transaksi', ">=", $this->start)
                ->whereDate('tanggal_transaksi', "<=", $this->end)->where('status', 'hutang')->sum('total');
        } else {
            $data['tunai'] = Transaksi::where('status', 'tunai')->sum('total');
            $data['non_tunai'] = Transaksi::where('status', 'hutang')->sum('total');
        }
        return $data;
    }
    public function return_penjualan()
    {
        if ($this->start & $this->end) {
            $data = Return_penjualan::whereDate('tanggal_return_jual', ">=", $this->start)
                ->whereDate('tanggal_return_jual', "<=", $this->end)->sum('total_bayar');
        } else {
            $data = Return_penjualan::sum('total_bayar');
        }
        return $data;
    }
    public function laba_rugi_penjualan()
    {
        if ($this->start & $this->end) {
            $data = Transaksi::whereDate('tanggal_transaksi', ">=", $this->start)
                ->whereDate('tanggal_transaksi', "<=", $this->end)->get();
            $value_keuntungan = 0;
            foreach ($data as $row) {
                if ($row->status == "hutang") {
                    foreach ($row->detail_transaksi as $detail_transaksi) {
                        $ppn_pph = 11.5;
                        $keuntungan_persentase = $detail_transaksi->barang->persentase_pph_ppn_keuntungan - $ppn_pph;
                        $value_keuntungan += (($detail_transaksi->harga / 100) * $keuntungan_persentase) * $detail_transaksi->jumlah_beli;
                    }
                    $value_keuntungan -= $row->piutang->sisa_hutang;
                } else {
                    foreach ($row->detail_transaksi as $detail_transaksi) {
                        $ppn_pph = 11.5;
                        $keuntungan_persentase = $detail_transaksi->barang->persentase_pph_ppn_keuntungan - $ppn_pph;
                        $value_keuntungan += (($detail_transaksi->harga / 100) * $keuntungan_persentase) * $detail_transaksi->jumlah_beli;
                    }
                }
            }
        } else {
            $data = Transaksi::get();
            $value_keuntungan = 0;
            foreach ($data as $row) {
                if ($row->status == "hutang") {
                    foreach ($row->detail_transaksi as $detail_transaksi) {
                        $ppn_pph = 11.5;
                        $keuntungan_persentase = $detail_transaksi->barang->persentase_pph_ppn_keuntungan - $ppn_pph;
                        $value_keuntungan += (($detail_transaksi->harga / 100) * $keuntungan_persentase) * $detail_transaksi->jumlah_beli;
                    }
                    $value_keuntungan -= $row->piutang->sisa_hutang;
                } else {
                    foreach ($row->detail_transaksi as $detail_transaksi) {
                        $ppn_pph = 11.5;
                        $keuntungan_persentase = $detail_transaksi->barang->persentase_pph_ppn_keuntungan - $ppn_pph;
                        $value_keuntungan += (($detail_transaksi->harga / 100) * $keuntungan_persentase) * $detail_transaksi->jumlah_beli;
                    }
                }
            }
        }
        return $value_keuntungan - $this->return_penjualan() - $this->cashback();
    }

    public function piutang()
    {
        if ($this->start & $this->end) {
            $total_piutang = Piutang::whereDate('tanggal_piutang', ">=", $this->start)
                ->whereDate('tanggal_piutang', "<=", $this->end)->sum('total_hutang');
            $piutang_terbayar = Piutang::whereDate('tanggal_piutang', ">=", $this->start)
                ->whereDate('tanggal_piutang', "<=", $this->end)->sum('piutang_terbayar');
            $sisa_piutang = Piutang::whereDate('tanggal_piutang', ">=", $this->start)
                ->whereDate('tanggal_piutang', "<=", $this->end)->sum('sisa_piutang');
        } else {
            $total_piutang = Piutang::sum('total_hutang');
            $piutang_terbayar = Piutang::sum('piutang_terbayar');
            $sisa_piutang = Piutang::sum('sisa_piutang');
        }
        $data = [
            'total_piutang' => $total_piutang,
            'piutang_terbayar' => $piutang_terbayar,
            'sisa_piutang' => $sisa_piutang,
        ];
        return $data;
    }
    public function pembelian()
    {
        if ($this->start & $this->end) {
            $data['tunai'] = Pembelian::whereDate('tanggal_pembelian', ">=", $this->start)
                ->whereDate('tanggal_pembelian', "<=", $this->end)->where('status', 'tunai')->sum('total');
            $data['non_tunai'] = Pembelian::whereDate('tanggal_pembelian', ">=", $this->start)
                ->whereDate('tanggal_pembelian', "<=", $this->end)->where('status', 'hutang')->sum('total');
        } else {
            $data['tunai'] = Pembelian::where('status', 'tunai')->sum('total');
            $data['non_tunai'] = Pembelian::where('status', 'hutang')->sum('total');
        }
        return $data;
    }
    public function return_pembelian()
    {
        if ($this->start & $this->end) {
            $data = Return_pembelian::whereDate('tanggal_return_pembelian', ">=", $this->start)
                ->whereDate('tanggal_return_pembelian', "<=", $this->end)->sum('total_bayar');
        } else {
            $data = Return_pembelian::sum('total_bayar');
        }
        return $data;
    }
    public function hutang()
    {
        if ($this->start & $this->end) {
            $total_hutang = Hutang::whereDate('tanggal_hutang', ">=", $this->start)
                ->whereDate('tanggal_hutang', "<=", $this->end)->sum('total_hutang');
            $hutang_terbayar = Hutang::whereDate('tanggal_hutang', ">=", $this->start)
                ->whereDate('tanggal_hutang', "<=", $this->end)->sum('pembayaran_hutang');
            $sisa_hutang = Hutang::whereDate('tanggal_hutang', ">=", $this->start)
                ->whereDate('tanggal_hutang', "<=", $this->end)->sum('sisa_hutang');
        } else {
            $total_hutang = Hutang::sum('total_hutang');
            $hutang_terbayar = Hutang::sum('pembayaran_hutang');
            $sisa_hutang = Hutang::sum('sisa_hutang');
        }
        $data = [
            'total_hutang' => $total_hutang,
            'hutang_terbayar' => $hutang_terbayar,
            'sisa_hutang' => $sisa_hutang,
        ];
        return $data;
    }
    public function penggajian()
    {
        if ($this->start & $this->end) {
            $data = Gaji::whereDate('tanggal_gaji', ">=", $this->start)
                ->whereDate('tanggal_gaji', "<=", $this->end)->sum('gaji_bersih');
        } else {
            $data = Gaji::sum('gaji_bersih');
        }
        return $data;
    }
    public function ppn_pph()
    {
        if ($this->start & $this->end) {
            $data = Transaksi::whereDate('tanggal_transaksi', ">=", $this->start)
                ->whereDate('tanggal_transaksi', "<=", $this->end)->get();
            $value_pph = 0;
            $value_ppn = 0;
            foreach ($data as $row) {
                foreach ($row->detail_transaksi as $detail_transaksi) {
                    $ppn = 10;
                    $pph = 1.5;
                    $value_ppn += (($detail_transaksi->harga / 100) * $ppn) * $detail_transaksi->jumlah_beli;
                    $value_pph += (($detail_transaksi->harga / 100) * $pph) * $detail_transaksi->jumlah_beli;
                }
            }
        } else {
            $data = Transaksi::get();
            $value_pph = 0;
            $value_ppn = 0;
            foreach ($data as $row) {
                foreach ($row->detail_transaksi as $detail_transaksi) {
                    $ppn = 10;
                    $pph = 1.5;
                    $value_ppn += (($detail_transaksi->harga / 100) * $ppn) * $detail_transaksi->jumlah_beli;
                    $value_pph += (($detail_transaksi->harga / 100) * $pph) * $detail_transaksi->jumlah_beli;
                }
            }
        }
        return [
            'pph' => $value_pph,
            'ppn' => $value_ppn
        ];
    }
    public function cashback()
    {
        if ($this->start & $this->end) {
            $data = Cashback::whereDate('tanggal', ">=", $this->start)
                ->whereDate('tanggal', "<=", $this->end)->sum('total');
        } else {
            $data = Cashback::sum('total');
        }
        return $data;
    }
    public function transport()
    {
        if ($this->start & $this->end) {
            $data = Kas::whereDate('tanggal', ">=", $this->start)
                ->whereDate('tanggal', "<=", $this->end)->where('jenis', 'transport')->sum('pengeluaran');
        } else {
            $data = Kas::where('jenis', 'transport')->sum('pengeluaran');
        }
        return $data;
    }
    public function pemasukan_lain()
    {
        if ($this->start & $this->end) {
            $data = Kas::whereDate('tanggal', ">=", $this->start)
                ->whereDate('tanggal', "<=", $this->end)->whereIn('jenis', ['kas awal', 'kas akhir', 'pemasukan awal'])->sum('pemasukan');
        } else {
            $data = Kas::whereIn('jenis', ['kas awal', 'kas akhir', 'pemasukan awal'])->sum('pemasukan');
        }
        return $data;
    }
    public function pengeluaran_lain()
    {
        if ($this->start & $this->end) {
            $data = Kas::whereDate('tanggal', ">=", $this->start)
                ->whereDate('tanggal', "<=", $this->end)->whereIn('jenis', ['kas awal', 'kas akhir', 'pemasukan awal'])->sum('pemasukan');
        } else {
            $data = Kas::whereIn('jenis', ['biaya', 'pengeluaran lain'])->sum('pemasukan');
        }
        return $data;
    }
    public function saldo_netto()
    {
    }
}
