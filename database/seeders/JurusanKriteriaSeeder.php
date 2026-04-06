<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Teknik Informatika
            ['nama_jurusan' => 'Teknik Informatika', 'nama_kriteria' => 'Pengetahuan Kognitif', 'nilai' => 90],
            ['nama_jurusan' => 'Teknik Informatika', 'nama_kriteria' => 'Minat dan Bakat', 'nilai' => 85],
            ['nama_jurusan' => 'Teknik Informatika', 'nama_kriteria' => 'Psikotes', 'nilai' => 80],

            // Teknik Mesin
            ['nama_jurusan' => 'Teknik Mesin', 'nama_kriteria' => 'Pengetahuan Kognitif', 'nilai' => 80],
            ['nama_jurusan' => 'Teknik Mesin', 'nama_kriteria' => 'Minat dan Bakat', 'nilai' => 75],
            ['nama_jurusan' => 'Teknik Mesin', 'nama_kriteria' => 'Psikotes', 'nilai' => 85],

            // Teknik Elektro
            ['nama_jurusan' => 'Teknik Elektro', 'nama_kriteria' => 'Pengetahuan Kognitif', 'nilai' => 85],
            ['nama_jurusan' => 'Teknik Elektro', 'nama_kriteria' => 'Minat dan Bakat', 'nilai' => 78],
            ['nama_jurusan' => 'Teknik Elektro', 'nama_kriteria' => 'Psikotes', 'nilai' => 82],

            // Sistem Informasi
            ['nama_jurusan' => 'Sistem Informasi', 'nama_kriteria' => 'Pengetahuan Kognitif', 'nilai' => 82],
            ['nama_jurusan' => 'Sistem Informasi', 'nama_kriteria' => 'Minat dan Bakat', 'nilai' => 88],
            ['nama_jurusan' => 'Sistem Informasi', 'nama_kriteria' => 'Psikotes', 'nilai' => 75],

            // Agroteknologi
            ['nama_jurusan' => 'Agroteknologi', 'nama_kriteria' => 'Pengetahuan Kognitif', 'nilai' => 70],
            ['nama_jurusan' => 'Agroteknologi', 'nama_kriteria' => 'Minat dan Bakat', 'nilai' => 72],
            ['nama_jurusan' => 'Agroteknologi', 'nama_kriteria' => 'Psikotes', 'nilai' => 78],
        ];

        foreach ($data as $item) {
            $jurusan = \App\Models\Jurusan::where('nama_jurusan', $item['nama_jurusan'])->first();
            $kriteria = \App\Models\Kriteria::where('nama_kriteria', $item['nama_kriteria'])->first();

            if ($jurusan && $kriteria) {
                \App\Models\JurusanKriteria::create([
                    'id_jurusan' => $jurusan->id_jurusan,
                    'id_kriteria' => $kriteria->id_kriteria,
                    'nilai' => $item['nilai'],
                ]);
            }
        }
    }
}
