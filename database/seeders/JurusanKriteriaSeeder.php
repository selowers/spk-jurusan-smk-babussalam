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
            ['nama_jurusan' => 'Teknik Informatika', 'nama_kriteria' => 'Pengetahuan Kognitif', 'nilai' => 5.00],
            ['nama_jurusan' => 'Teknik Informatika', 'nama_kriteria' => 'Minat dan Bakat', 'nilai' => 4.00],
            ['nama_jurusan' => 'Teknik Informatika', 'nama_kriteria' => 'Psikotes', 'nilai' => 4.00],

            // Teknik Mesin
            ['nama_jurusan' => 'Teknik Mesin', 'nama_kriteria' => 'Pengetahuan Kognitif', 'nilai' => 4.00],
            ['nama_jurusan' => 'Teknik Mesin', 'nama_kriteria' => 'Minat dan Bakat', 'nilai' => 2.50],
            ['nama_jurusan' => 'Teknik Mesin', 'nama_kriteria' => 'Psikotes', 'nilai' => 4.50],

            // Teknik Elektro
            ['nama_jurusan' => 'Teknik Elektro', 'nama_kriteria' => 'Pengetahuan Kognitif', 'nilai' => 4.00],
            ['nama_jurusan' => 'Teknik Elektro', 'nama_kriteria' => 'Minat dan Bakat', 'nilai' => 5.00],
            ['nama_jurusan' => 'Teknik Elektro', 'nama_kriteria' => 'Psikotes', 'nilai' => 4.00],

            // Sistem Informasi
            ['nama_jurusan' => 'Sistem Informasi', 'nama_kriteria' => 'Pengetahuan Kognitif', 'nilai' => 4.80],
            ['nama_jurusan' => 'Sistem Informasi', 'nama_kriteria' => 'Minat dan Bakat', 'nilai' => 4.50],
            ['nama_jurusan' => 'Sistem Informasi', 'nama_kriteria' => 'Psikotes', 'nilai' => 4.50],

            // Agroteknologi
            ['nama_jurusan' => 'Agroteknologi', 'nama_kriteria' => 'Pengetahuan Kognitif', 'nilai' => 4.00],
            ['nama_jurusan' => 'Agroteknologi', 'nama_kriteria' => 'Minat dan Bakat', 'nilai' => 4.00],
            ['nama_jurusan' => 'Agroteknologi', 'nama_kriteria' => 'Psikotes', 'nilai' => 3.00],
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
