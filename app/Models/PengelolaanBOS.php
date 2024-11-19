<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengelolaanBOS extends Model
{
    use HasFactory;
            // Menentukan nama tabel secara eksplisit
            protected $table = 'pengelolaan_dana_bos';

            // Menentukan field yang bisa diisi secara mass assignment
            protected $fillable = [
                'nama',
                'nik',
                'alamat',
                'no_hp',
                'dokumen_pertanggungjawaban_keuangan',
                'surat_pengantar_kepala_sekolah',
                'status',
            ];
    
}
