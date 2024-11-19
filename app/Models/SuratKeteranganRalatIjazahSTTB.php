<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganRalatIjazahSTTB extends Model
{
    use HasFactory;
                // Menentukan nama tabel secara eksplisit
                protected $table = 'surat_keterangan_ralat_ijazah_sttb';

                // Menentukan field yang bisa diisi secara mass assignment
                protected $fillable = [
                    'nama',
                    'nik',
                    'alamat',
                    'no_hp',
                    'fotokopi_ijazah_sttb_hilang',
                    'fotokopi_akta_kelahiran',
                    'dokumen_kewenangan',
                    'lembar_cek_nisn_dapodik',
                    'status',
                ];
}
