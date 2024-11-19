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
        Schema::table('legalisir_fotokopi_ijazah_sttb', function (Blueprint $table) {
            
            $table->after('no_hp', function($table){
                $table->string('ijazah_sttb_asli')->nullable();
                $table->string('fotokopi_ijazah_sttb')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('legalisir_fotokopi_ijazah_sttb', function (Blueprint $table) {
            $table->dropColumn('ijazah_sttb_asli');
            $table->dropColumn('fotokopi_ijazah_sttb');
        });
    }
};
