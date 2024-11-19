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
        Schema::table('surat_keterangan_ralat_ijazah_sttb', function (Blueprint $table) {
            $table->after('no_hp', function($table){
                $table->string('fotokopi_ijazah_sttb')->nullable();
                $table->string('fotokopi_akta_kelahiran')->nullable();
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
        Schema::table('surat_keterangan_ralat_ijazah_sttb', function (Blueprint $table) {
            $table->dropColumn('fotokopi_ijazah_sttb');
            $table->dropColumn('fotokopi_akta_kelahiran');
            $table->dropColumn('dokumen_kewenangan');
            $table->dropColumn('lembar_cek_nisn_dapodik');
        });
    }
};
