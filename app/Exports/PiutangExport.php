<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PiutangExport implements FromView, ShouldAutoSize
{
    protected $totalPiutang;
    protected $totalPiutangTerbayar;
    protected $totalPiutangSisa;
    protected $piutang;
    public function __construct($totalPiutang, $totalPiutangTerbayar, $totalPiutangSisa, $piutang)
    {
        $this->totalPiutang = $totalPiutang;
        $this->totalPiutangTerbayar = $totalPiutangTerbayar;
        $this->totalPiutangSisa = $totalPiutangSisa;
        $this->piutang = $piutang;
    }
    public function view(): View
    {
        return view("exports.piutang", [
            'totalPiutang' => $this->totalPiutang,
            'totalPiutangTerbayar' => $this->totalPiutangTerbayar,
            'totalPiutangTerbayar' => $this->totalPiutangTerbayar,
            'piutang' => $this->piutang
        ]);
    }
}
