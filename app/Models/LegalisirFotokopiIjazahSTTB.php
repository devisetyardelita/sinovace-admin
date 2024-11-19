<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalisirFotokopiIjazahSTTB extends Model
{
    use HasFactory;
            // Menentukan nama tabel secara eksplisit
            protected $table = 'legalisir_fotokopi_ijazah_sttb';

            // Menentukan field yang bisa diisi secara mass assignment
            protected $fillable = [
                'nama',
                'nik',
                'alamat',
                'no_hp',
                'ijazah_sttb_asli',
                'fotokopi_ijazah_sttb',
                'status',
            ];
    
}
