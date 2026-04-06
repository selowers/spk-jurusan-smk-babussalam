<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kriteria;
use App\Models\Jurusan;
use App\Models\HasilSAW;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalSiswa = Siswa::count();
        $totalKriteria = Kriteria::count();
        $totalJurusan = Jurusan::count();
        $totalHasilSAW = HasilSAW::count();

        // Data untuk chart
        $siswaPerKelas = Siswa::selectRaw('kelas, COUNT(*) as jumlah')
            ->groupBy('kelas')
            ->get();

        $siswaPerTahunAjaran = Siswa::selectRaw('tahun_ajaran, COUNT(*) as jumlah')
            ->groupBy('tahun_ajaran')
            ->get();

        // Data jurusan rekomendasi terbanyak
        $jurusanRekomendasi = HasilSAW::selectRaw('id_jurusan, COUNT(*) as jumlah_rekomendasi')
            ->where('peringkat', 1)
            ->with('jurusan')
            ->groupBy('id_jurusan')
            ->orderBy('jumlah_rekomendasi', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'nama_jurusan' => $item->jurusan->nama_jurusan,
                    'fakultas' => $item->jurusan->fakultas,
                    'jumlah' => $item->jumlah_rekomendasi
                ];
            });

        // Data siswa terbaru (5 terakhir)
        $siswaTerbaru = Siswa::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Data kriteria dengan bobot
        $kriteriaData = Kriteria::all();

        return view('dashboard', compact(
            'totalSiswa',
            'totalKriteria',
            'totalJurusan',
            'totalHasilSAW',
            'siswaPerKelas',
            'siswaPerTahunAjaran',
            'jurusanRekomendasi',
            'siswaTerbaru',
            'kriteriaData'
        ));
    }
}