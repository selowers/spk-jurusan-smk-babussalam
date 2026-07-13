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
                'bobot' => 5 / 12,
                'tipe' => 'benefit',
            ],
            [
                'nama_kriteria' => 'Minat dan Bakat',
                'bobot' => 4 / 12,
                'tipe' => 'benefit',
            ],
            [
                'nama_kriteria' => 'Psikotes',
                'bobot' => 3 / 12,
                'tipe' => 'benefit',
            ],
        ];

        foreach ($kriterias as $kriteria) {
            Kriteria::updateOrCreate(
                ['nama_kriteria' => $kriteria['nama_kriteria']],
                ['bobot' => $kriteria['bobot'], 'tipe' => $kriteria['tipe']]
            );
        }
    }
}