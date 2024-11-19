<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('izin_memimpin_smp', function (Blueprint $table) {
            $table->after('no_hp', function($table){
                $table->string('surat_usulan_izin_memimpin')->nullable();
                $table->string('surat_permohonan_yayasan')->nullable();
                $table->string('nuptk')->nullable();
                $table->string('sertifikat_pendidik')->nullable();
                $table->string('surat_kesediaan_kurikulum_mengajar')->nullable();
                $table->string('pakta_integritas')->nullable();
                $table->string('riwayat_pengalaman_mengajar')->nullable();
                $table->string('surat_pengangkatan_kepsek')->nullable();
                $table->string('fotokopi_ijazah_s1_akta_iv')->nullable();
                $table->string('fotokopi_izin_operasional')->nullable();
                $table->string('fotokopi_akreditasi')->nullable();
                $table->string('fotokopi_nss_npsn')->nullable();
                $table->string('fotokopi_izin_memimpin_lalu')->nullable();
                $table->string('pas_foto')->nullable();
                $table->string('skck')->nullable();
                $table->string('fotokopi_kk')->nullable();
                $table->string('surat_keterangan_sehat_napza')->nullable();
                $table->string('fotokopi_ktp')->nullable();
                $table->string('berita_acara_instrument_interview')->nullable();
                $table->string('profil_sekolah')->nullable();
                $table->string('struktur_organisasi_yayasan')->nullable();
                $table->string('proposal_permohonan')->nullable();
                $table->string('fotokopi_pkks')->nullable();                             
            });
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('izin_memimpin_smp', function (Blueprint $table) {
            $table->dropColumn('surat_usulan_izin_memimpin');
            $table->dropColumn('surat_permohonan_yayasan');
            $table->dropColumn('nuptk');
            $table->dropColumn('sertifikat_pendidik');
            $table->dropColumn('surat_kesediaan_kurikulum_mengajar');
            $table->dropColumn('pakta_integritas');
            $table->dropColumn('riwayat_pengalaman_mengajar');
            $table->dropColumn('surat_pengangkatan_kepsek');
            $table->dropColumn('fotokopi_ijazah_s1_akta_iv');
            $table->dropColumn('fotokopi_izin_operasional');
            $table->dropColumn('fotokopi_akreditasi');
            $table->dropColumn('fotokopi_nss_npsn');
            $table->dropColumn('fotokopi_izin_memimpin_lalu');
            $table->dropColumn('pas_foto');
            $table->dropColumn('skck');
            $table->dropColumn('fotokopi_kk');
            $table->dropColumn('surat_keterangan_sehat_napza');
            $table->dropColumn('fotokopi_ktp');
            $table->dropColumn('berita_acara_instrument_interview');
            $table->dropColumn('profil_sekolah');
            $table->dropColumn('struktur_organisasi_yayasan');
            $table->dropColumn('proposal_permohonan');
            $table->dropColumn('fotokopi_pkks');
        });
    }
};
