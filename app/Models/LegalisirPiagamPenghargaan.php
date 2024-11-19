<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalisirPiagamPenghargaan extends Model
{
    use HasFactory;
    
    // Menentukan nama tabel secara eksplisit
    protected $table = 'legalisir_piagam_penghargaan';

    // Menentukan field yang bisa diisi secara mass assignment
    protected $fillable = [
        'nama',
        'nik',
        'alamat',
        'no_hp',
        'piagam_penghargaan',
        'fotokopi_piagam_penghargaan',
        'status',
    ];
}
