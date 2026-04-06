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
        Schema::create('jurusan_kriteria', function (Blueprint $table) {
            $table->id('id_jurusan_kriteria');
            $table->unsignedInteger('id_jurusan');
            $table->unsignedBigInteger('id_kriteria');
            $table->float('nilai');
            $table->timestamps();

            $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusan')->onDelete('cascade');
            $table->foreign('id_kriteria')->references('id_kriteria')->on('kriteria')->onDelete('cascade');
            $table->unique(['id_jurusan', 'id_kriteria']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurusan_kriteria');
    }
};
