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
        Schema::table('surat_pengganti_ijazah_sttb_hilang', function (Blueprint $table) {
            $table->after('no_hp', function($table){
                $table->string('fotokopi_ijazah_sttb_hilang')->nullable();
                $table->string('fotokopi_akta_kelahiran')->nullable();
                $table->string('surat_keterangan_kehilangan')->nullable();
                $table->string('surat_pernyataan_tanggungjawab')->nullable();
                $table->string('surat_keterangan_saksi')->nullable();
                $table->string('dokumen_kewenangan')->nullable();
                $table->string('lembar_cek_nisn_dapodik')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_pengganti_ijazah_sttb_hilang', function (Blueprint $table) {
            $table->dropColumn('fotokopi_ijazah_sttb_hilang');
            $table->dropColumn('fotokopi_akta_kelahiran');
            $table->dropColumn('surat_keterangan_kehilangan');
            $table->dropColumn('surat_pernyataan_tanggungjawab');
            $table->dropColumn('surat_keterangan_saksi');
            $table->dropColumn('dokumen_kewenangan');
            $table->dropColumn('lembar_cek_nisn_dapodik');
        });
    }
};
