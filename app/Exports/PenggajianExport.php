<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PenggajianExport implements FromView, ShouldAutoSize
{
    protected $penggajian;
    public function __construct($penggajian)
    {
        $this->penggajian = $penggajian;
    }
    public function view(): View
    {
        return view("exports.penggajian", [
            'penggajian' => $this->penggajian
        ]);
    }
}
