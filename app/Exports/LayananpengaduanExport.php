<?php

namespace App\Exports;

use App\Models\LayananPengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LayananpengaduanExport implements FromView
{
    public function view(): View
    {
        return view('layanan_pengaduan.export', [
            'layanan_pengaduan' => LayananPengaduan::all()
        ]);
    }
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     //
    // }
}
