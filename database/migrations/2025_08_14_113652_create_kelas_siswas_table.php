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
        Schema::create('kelas_guru', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('id_guru')->constrained('gurus')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('kelas_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('id_siswa')->constrained('siswas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas_siswas');
    }
};
