<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class HutangExport implements FromView, ShouldAutoSize
{
    protected $totalHutang;
    protected $totalHutangTerbayar;
    protected $totalHutangSisa;
    protected $hutang;
    public function __construct($totalHutang, $totalHutangTerbayar, $totalHutangSisa, $hutang)
    {
        $this->totalHutang = $totalHutang;
        $this->totalHutangTerbayar = $totalHutangTerbayar;
        $this->totalHutangSisa = $totalHutangSisa;
        $this->hutang = $hutang;
    }
    public function view(): View
    {
        return view("exports.hutang", [
            'totalHutang' => $this->totalHutang,
            'totalHutangTerbayar' => $this->totalHutangTerbayar,
            'totalHutangSisa' => $this->totalHutangSisa,
            'hutang' => $this->hutang
        ]);
    }
}
