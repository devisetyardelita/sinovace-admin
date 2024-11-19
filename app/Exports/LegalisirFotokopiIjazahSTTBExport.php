<?php

namespace App\Exports;

use App\Models\LegalisirFotokopiIjazahSTTB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LegalisirFotokopiIjazahSTTBExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('legalisir_fotokopi_ijazah_sttb.excel', [
            'legalisir_fotokopi_ijazah_sttb' => LegalisirFotokopiIjazahSTTB::all()
        ]);
    }
}

