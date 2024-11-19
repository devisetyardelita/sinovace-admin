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
        Schema::table('layanan_pengaduan', function (Blueprint $table) {
            $table->after('no_hp', function($table){
                $table->string('file_surat_permohonan_pengajuan')->nullable();
                $table->string('foto_ktp')->nullable();
                $table->string('foto_bukti_pengaduan')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('layanan_pengaduan', function (Blueprint $table) {
            $table->dropColumn('file_surat_permohonan_pengajuan');
            $table->dropColumn('foto_ktp');
            $table->dropColumn('foto_bukti_pengaduan');
        });
    }
};
