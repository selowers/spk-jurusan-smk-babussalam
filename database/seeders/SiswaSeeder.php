<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::create([
            'nama_siswa' => 'Ahmad Rahman',
            'kelas' => 'XII RPL',
            'jurusan_sekolah' => 'Rekayasa Perangkat Lunak',
            'tahun_ajaran' => '2023/2024',
            'id_user' => 1, // Admin
        ]);

        Siswa::create([
            'nama_siswa' => 'Siti Nurhaliza',
            'kelas' => 'XII TKJ',
            'jurusan_sekolah' => 'Teknik Komputer Jaringan',
            'tahun_ajaran' => '2023/2024',
            'id_user' => 2, // Guru
        ]);

        Siswa::create([
            'nama_siswa' => 'Budi Santoso',
            'kelas' => 'XII MM',
            'jurusan_sekolah' => 'Multimedia',
            'tahun_ajaran' => '2023/2024',
            'id_user' => 1, // Admin
        ]);
    }
}
