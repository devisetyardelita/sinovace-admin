<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananPengaduan extends Model
{
    use HasFactory;
        // Menentukan nama tabel secara eksplisit
        protected $table = 'layanan_pengaduan';

        // Menentukan field yang bisa diisi secara mass assignment
        protected $fillable = [
            'nama',
            'nik',
            'alamat',
            'no_hp',
            'file_surat_permohonan_pengajuan',
            'foto_ktp',
            'foto_bukti_pengaduan',
            'status',
        ];
}
