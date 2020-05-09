<?php

namespace App\Exports\Penjualan;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class BarangExport implements FromView, ShouldAutoSize
{
    protected $transaksi;
    public function __construct($transaksi)
    {
        $this->transaksi = $transaksi;
    }
    public function view(): View
    {
        return view("exports.penjualan.barang", [
            'transaksi' => $this->transaksi
        ]);
    }
}
