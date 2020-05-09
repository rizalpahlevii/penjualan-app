<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KasExport implements FromView, ShouldAutoSize
{
    protected $kas;
    public function __construct($kas)
    {
        $this->kas = $kas;
    }
    public function view(): View
    {
        return view("exports.kas", [
            'kas' => $this->kas
        ]);
    }
}
