<?php

namespace App\Exports;

use App\Models\SuratPenggantiIjazahSTTBHilang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SuratPenggantiIjazahSTTBHilangExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('surat_pengganti_ijazah_sttb_hilang.excel', [
            'surat_pengganti_ijazah_sttb_hilang' => SuratPenggantiIjazahSTTBHilang::all()
        ]);
    }
}
