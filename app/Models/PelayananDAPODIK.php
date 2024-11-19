<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelayananDAPODIK extends Model
{
    use HasFactory;
            // Menentukan nama tabel secara eksplisit
            protected $table = 'pelayanan_dapodik';

            // Menentukan field yang bisa diisi secara mass assignment
            protected $fillable = [
                'nama',
                'nik',
                'alamat',
                'no_hp',
                'surat_pertanggungjawaban',
               'foto_ktp',
                'foto_bukti_pengaduan',
                'usul_sktp',
            ];
    
}
