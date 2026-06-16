<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriterias = [
            [
                'nama_kriteria' => 'Pengetahuan Kognitif',
                'bobot' => 0.417,
                'tipe' => 'benefit',
            ],
            [
                'nama_kriteria' => 'Minat dan Bakat',
                'bobot' => 0.333,
                'tipe' => 'benefit',
            ],
            [
                'nama_kriteria' => 'Psikotes',
                'bobot' => 0.250,
                'tipe' => 'benefit',
            ],
        ];

        foreach ($kriterias as $kriteria) {
            Kriteria::create($kriteria);
        }
    }
}