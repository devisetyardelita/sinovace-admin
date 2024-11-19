<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananPengaduan;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $layanan_pengaduan = LayananPengaduan::get();
        $data = [
            'title' => 'Daftar Data Layanan Pengaduan',
            'date' => date('d/m/Y'),
            'layanan_pengaduan' => $layanan_pengaduan
        ];

        $pdf = PDF::loadView('layanan_pengaduan.generate_layanan_pengaduan_pdf', $data);
        return $pdf->download('data.pdf');
    }
}
