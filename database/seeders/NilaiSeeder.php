<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Kriteria;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswa = Siswa::all();
        $kriteria = Kriteria::all();

        foreach ($siswa as $s) {
            foreach ($kriteria as $k) {
                // Generate nilai random berdasarkan kriteria
                $nilai = $this->generateNilai($k->nama_kriteria);

                Nilai::create([
                    'id_siswa' => $s->id_siswa,
                    'id_kriteria' => $k->id_kriteria,
                    'nilai' => $nilai
                ]);
            }
        }
    }

    private function generateNilai($namaKriteria)
    {
        switch ($namaKriteria) {
            case 'Nilai Kognitif':
                // Range 70-100
                return rand(70, 100);
            case 'Minat dan Bakat':
                // Range 1-10 (skala likert)
                return rand(1, 10);
            case 'Psikotes':
                // Range 60-100
                return rand(60, 100);
            default:
                return rand(1, 100);
        }
    }
}