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
        Schema::create('kriteria', function (Blueprint $table) {
            $table->id('id_kriteria'); // Primary Key, Auto Increment
            $table->string('nama_kriteria', 100); // Nama kriteria penilaian
            $table->float('bobot'); // Bobot kriteria dalam perhitungan SAW
            $table->enum('tipe', ['benefit', 'cost']); // Jenis kriteria (benefit/cost)
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria');
    }
};
