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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id('id_siswa'); // Primary Key, Auto Increment
            $table->string('nama_siswa', 255); // Nama lengkap siswa
            $table->string('kelas', 50); // Kelas siswa
            $table->string('jurusan_sekolah', 100); // Jurusan siswa di SMK
            $table->string('tahun_ajaran', 20); // Tahun ajaran aktif
            $table->unsignedInteger('id_user'); // Foreign Key ke tabel users
            $table->timestamps(); // created_at & updated_at

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
