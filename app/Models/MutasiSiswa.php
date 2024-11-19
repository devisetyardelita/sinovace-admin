<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiSiswa extends Model
{
    use HasFactory;

            // Menentukan nama tabel secara eksplisit
            protected $table = 'mutasi_siswa';

            // Menentukan field yang bisa diisi secara mass assignment
            protected $fillable = [
                'nama',
                'nik',
                'alamat',
                'no_hp',
                'surat_rekomendasi_sekolah_asal',
                'surat_rekomendasi_sekilah_tujuan',
                'status',
            ];
}
