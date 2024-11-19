<?php

namespace App\Exports;

use App\Models\PelayananDAPODIK;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PelayananDAPODIKExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('pelayanan_dapodik.excel', [
            'pelayanan_dapodik' => PelayananDAPODIK::all()
        ]);
    }
}
