<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matkul', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kodematkul')->unique();
            $table->integer('sks');
            $table->string('deskripsi')->nullable();

            $table->string('nama_dosen')->nullable();
            $table->string('nip_dosen')->nullable();
            $table->string('email_dosen')->nullable();

            $table->string('kodemsteam')->nullable();
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matkul');
    }
};
