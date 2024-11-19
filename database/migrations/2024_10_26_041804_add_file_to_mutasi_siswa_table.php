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
        Schema::table('mutasi_siswa', function (Blueprint $table) {
            $table->after('no_hp', function($table){
                $table->string('surat_rekomendasi_sekolah_asal')->nullable();
                $table->string('surat_rekomendasi_sekilah_tujuan')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mutasi_siswa', function (Blueprint $table) {
            $table->dropColumn('surat_rekomendasi_sekolah_asal');
            $table->dropColumn('surat_rekomendasi_sekolah_tujuan');
        });
    }
};
