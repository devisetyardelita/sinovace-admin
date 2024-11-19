<?php

namespace App\Exports;

use App\Models\MutasiSiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class MutasiSiswaExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('mutasi_siswa.excel', [
            'mutasi_siswa' => MutasiSiswa::all()
        ]);
    }
}
