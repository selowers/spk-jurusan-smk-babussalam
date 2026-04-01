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
        Schema::create('jurusan', function (Blueprint $table) {
            $table->increments('id_jurusan'); // Primary Key, Auto Increment
            $table->string('nama_jurusan', 150); // Nama jurusan perguruan tinggi
            $table->string('fakultas', 150); // Nama fakultas
            $table->string('perguruan_tinggi', 150); // Nama perguruan tinggi
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurusan');
    }
};
