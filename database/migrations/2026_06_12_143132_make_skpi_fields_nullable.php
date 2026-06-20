<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('skpi', function (Blueprint $table) {
            $table->dropColumn(['nama_sertifikat', 'organisasi', 'tahun', 'deskripsi']);
        });
    }

    public function down(): void
    {
        Schema::table('skpi', function (Blueprint $table) {
            $table->string('nama_sertifikat')->nullable();
            $table->string('organisasi')->nullable();
            $table->integer('tahun')->nullable();
            $table->text('deskripsi')->nullable();
        });
    }
};