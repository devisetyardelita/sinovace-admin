<?php

namespace App\Exports;

use App\Models\SuratKeteranganRalatIjazahSTTB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SuratKeteranganRalatIjazahSTTBExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('surat_keterangan_ralat_ijazah_sttb.excel', [
            'surat_keterangan_ralat_ijazah_sttb' => SuratKeteranganRalatIjazahSTTB::all()
        ]);
    }
}
