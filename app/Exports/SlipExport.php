<?php

namespace App\Exports;

use App\Models\Slip;
use App\Models\Praktikum;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SlipExport implements FromView, ShouldAutoSize
{
    private $praktikum;

    public function __construct(Praktikum $praktikum)
    {
        $this->praktikum = $praktikum;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.excel', [
            'daftarSlip' => $this->praktikum->slip
        ]);
    }
}
