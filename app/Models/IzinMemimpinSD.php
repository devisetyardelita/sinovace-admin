<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IzinMemimpinSD extends Model
{
    use HasFactory;
    // Menentukan nama tabel secara eksplisit
    protected $table = 'izin_memimpin_sd';

    // Menentukan field yang bisa diisi secara mass assignment
    protected $fillable = [
        'nama',
        'nik',
        'alamat',
        'no_hp',
        'surat_permohonan_yayasan',
        'surat_pernyataan_bukan_pns',
        'nuptk',
        'sertifikat_pendidik',
        'sertifikat_diklat_kepsek',
        'surat_kesediaan_kurikulum_mengajar',
        'pakta_integritas',
        'riwayat_pengalaman_mengajar',
        'surat_pengangkatan_kepsek',
        'fotokopi_ijazah_s1_akta_iv',
        'fotokopi_izin_operasional',
        'fotokopi_akreditasi',
        'fotokopi_nss_npsn',
        'fotokopi_izin_memimpin_lalu',
        'pas_foto',
        'skck',
        'fotokopi_kk',
        'surat_keterangan_sehat_napza',
        'fotokopi_ktp',
        'berita_acara_instrument_interview',
        'profil_sekolah',
        'struktur_organisasi_yayasan',
        'proposal_permohonan',
        'fotokopi_pkks',
        'status',
    ];
}
