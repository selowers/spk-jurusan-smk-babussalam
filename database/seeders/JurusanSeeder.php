<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $jurusan = [
            [
                'nama_jurusan' => 'Teknik Informatika',
                'fakultas' => 'Sains dan Teknologi',
                'perguruan_tinggi' => 'Universitas Islam Raden Rahmat Malang'
            ],
            [
                'nama_jurusan' => 'Teknik Mesin',
                'fakultas' => 'Sains dan Teknologi',
                'perguruan_tinggi' => 'Universitas Islam Raden Rahmat Malang'
            ],
            [
                'nama_jurusan' => 'Teknik Elektro',
                'fakultas' => 'Sains dan Teknologi',
                'perguruan_tinggi' => 'Universitas Islam Raden Rahmat Malang'
            ],
            [
                'nama_jurusan' => 'Sistem Informasi',
                'fakultas' => 'Sains dan Teknologi',
                'perguruan_tinggi' => 'Universitas Islam Raden Rahmat Malang'
            ],
            [
                'nama_jurusan' => 'Agroteknologi',
                'fakultas' => 'Sains dan Teknologi',
                'perguruan_tinggi' => 'Universitas Islam Raden Rahmat Malang'
            ],
        ];

        foreach ($jurusan as $data) {
            Jurusan::create($data);
        }
    }
}