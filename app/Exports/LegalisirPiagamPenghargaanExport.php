<?php

namespace App\Exports;

use App\Models\LegalisirPiagamPenghargaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LegalisirPiagamPenghargaanExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('legalisir_piagam_penghargaan.excel', [
            'legalisir_piagam_penghargaan' => LegalisirPiagamPenghargaan::all()
        ]);
    }
}
