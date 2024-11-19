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
        Schema::table('legalisir_piagam_penghargaan', function (Blueprint $table) {
            $table->after('no_hp', function($table){
                $table->string('piagam_penghargaan')->nullable();
                $table->string('fotokopi_piagam_penghargaan')->nullable();
            });

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('legalisir_piagam_penghargaan', function (Blueprint $table) {
            $table->dropColumn('piagam_pengahargaan');
            $table->dropColumn('fotokopi_piagam_penghargaan');
        });
    }
};
