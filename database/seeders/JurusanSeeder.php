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
                'perguruan_tinggi' => 'Universitas Indonesia'
            ],
            [
                'nama_jurusan' => 'Teknik Mesin',
                'fakultas' => 'Sains dan Teknologi',
                'perguruan_tinggi' => 'Universitas Gadjah Mada'
            ],
            [
                'nama_jurusan' => 'Teknik Elektro',
                'fakultas' => 'Sains dan Teknologi',
                'perguruan_tinggi' => 'Institut Teknologi Bandung'
            ],
            [
                'nama_jurusan' => 'Agroteknologi',
                'fakultas' => 'Sains dan Teknologi',
                'perguruan_tinggi' => 'Institut Pertanian Bogor'
            ],
            [
                'nama_jurusan' => 'Sistem Informasi',
                'fakultas' => 'Sains dan Teknologi',
                'perguruan_tinggi' => 'Universitas Indonesia'
            ],
        ];

        foreach ($jurusan as $data) {
            Jurusan::create($data);
        }
    }
}