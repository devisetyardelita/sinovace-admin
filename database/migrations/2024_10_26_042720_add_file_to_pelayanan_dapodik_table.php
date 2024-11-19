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
        Schema::table('pelayanan_dapodik', function (Blueprint $table) {
            $table->after('no_hp', function($table){
                $table->string('surat_pertanggungjawaban')->nullable();
                $table->string('gtk_persemester')->nullable();
                $table->string('usul_sktp')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelayanan_dapodik', function (Blueprint $table) {
            $table->dropColumn('surat_pertanggungjawaban');
            $table->dropColumn('gtk_persemester');
            $table->dropColumn('usul_sktp');
        });
    }
};
