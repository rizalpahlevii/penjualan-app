<?php

namespace App\Exports\Pembelian;

use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class TunaiExport implements FromView, ShouldAutoSize
{

    protected $pembelian;
    public function __construct($pembelian)
    {
        $this->pembelian = $pembelian;
    }
    public function view(): View
    {
        return view("exports.pembelian.tunai", [
            'pembelian' => $this->pembelian
        ]);
    }
}
