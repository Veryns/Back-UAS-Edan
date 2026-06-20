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
        Schema::create('students', function (Blueprint $table) {
            $table->id();                                          // primary key yg auto increment (soon)
            $table->unsignedBigInteger('student_id')->unique();    // nim 9digit
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
 