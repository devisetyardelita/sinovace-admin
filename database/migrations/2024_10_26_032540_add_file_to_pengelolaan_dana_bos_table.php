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
        Schema::table('pengelolaan_dana_bos', function (Blueprint $table) {
            $table->after('no_hp', function($table){
                $table->string('dokumen_pertanggungjawaban_keuangan')->nullable();
                $table->string('surat_pengantar_kepala_sekolah')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengelolaan_dana_bos', function (Blueprint $table) {
            $table->dropColumn('dokumen_pertanggungjawaban_keuangan');
            $table->dropColumn('surat_pengantar_kepala_sekolah');
        });
    }
};
