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
        Schema::table('skpi', function (Blueprint $table) {
            $table->string('kategori')->nullable();
            $table->string('kegiatan')->nullable();
            $table->string('tingkat')->nullable();
            $table->string('klasifikasi')->nullable();
            $table->date('periode_mulai')->nullable();
            $table->date('periode_selesai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skpi', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'kegiatan', 'tingkat', 'klasifikasi', 'periode_mulai', 'periode_selesai']);
        });
    }
};
