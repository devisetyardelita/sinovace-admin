<?php

namespace App\Exports;

use App\Models\PengelolaanBOS;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PengelolaanBOSExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('pengelolaan_dana_bos.excel', [
            'pengelolaan_dana_bos' => PengelolaanBOS::all()
        ]);
    }
}
