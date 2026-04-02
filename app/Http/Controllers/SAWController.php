<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kriteria;
use App\Models\Nilai;
use App\Models\HasilSAW;
use App\Models\Jurusan;

class SAWController extends Controller
{
    public function index()
    {
        // Ambil data siswa yang memiliki nilai lengkap
        $siswa = Siswa::with(['nilai.kriteria'])->get();

        // Ambil kriteria
        $kriteria = Kriteria::all();

        // Ambil jurusan
        $jurusan = Jurusan::all();

        // Hitung statistik
        $totalSiswa = $siswa->count();
        $totalKriteria = $kriteria->count();
        $totalJurusan = $jurusan->count();

        return view('saw.index', compact('siswa', 'kriteria', 'jurusan', 'totalSiswa', 'totalKriteria', 'totalJurusan'));
    }

    public function proses(Request $request)
    {
        // Validasi input
        $request->validate([
            'siswa_ids' => 'required|array|min:1',
            'siswa_ids.*' => 'exists:siswa,id_siswa'
        ]);

        $siswaIds = $request->siswa_ids;

        // Ambil data yang diperlukan
        $siswa = Siswa::whereIn('id_siswa', $siswaIds)->with(['nilai.kriteria'])->get();
        $kriteria = Kriteria::all();
        $jurusan = Jurusan::all();

        // Proses perhitungan SAW
        $hasil = $this->hitungSAW($siswa, $kriteria, $jurusan);

        // Simpan hasil ke database
        $this->simpanHasil($hasil);

        // Redirect ke halaman hasil rekomendasi dengan pesan sukses
        return redirect()->route('saw.hasil')->with('success', 'Perhitungan SAW berhasil dilakukan! Lihat hasil rekomendasi di bawah.');
    }

    private function hitungSAW($siswa, $kriteria, $jurusan)
    {
        $hasil = [];

        foreach ($siswa as $s) {
            $nilaiPreferensi = [];

            foreach ($jurusan as $j) {
                // Hitung nilai preferensi untuk setiap jurusan
                $preferensi = 0;

                foreach ($kriteria as $k) {
                    // Ambil nilai siswa untuk kriteria ini
                    $nilaiSiswa = $s->nilai->where('id_kriteria', $k->id_kriteria)->first();

                    if ($nilaiSiswa) {
                        // Normalisasi (untuk benefit criteria: nilai/max)
                        $maxNilai = $siswa->max(function($sis) use ($k) {
                            $nilai = $sis->nilai->where('id_kriteria', $k->id_kriteria)->first();
                            return $nilai ? $nilai->nilai : 0;
                        });

                        if ($maxNilai > 0) {
                            $nilaiNormalisasi = $nilaiSiswa->nilai / $maxNilai;
                        } else {
                            $nilaiNormalisasi = 0;
                        }

                        // Kalikan dengan bobot
                        $preferensi += $nilaiNormalisasi * $k->bobot;
                    }
                }

                $nilaiPreferensi[] = [
                    'id_jurusan' => $j->id_jurusan,
                    'nama_jurusan' => $j->nama_jurusan,
                    'nilai_preferensi' => round($preferensi, 4)
                ];
            }

            // Urutkan berdasarkan nilai preferensi tertinggi
            usort($nilaiPreferensi, function($a, $b) {
                return $b['nilai_preferensi'] <=> $a['nilai_preferensi'];
            });

            // Tambahkan ranking
            foreach ($nilaiPreferensi as $index => &$np) {
                $np['peringkat'] = $index + 1;
            }

            $hasil[] = [
                'siswa' => $s,
                'rekomendasi' => $nilaiPreferensi
            ];
        }

        return $hasil;
    }

    private function simpanHasil($hasil)
    {
        // Hapus hasil sebelumnya untuk siswa yang diproses
        $siswaIds = array_column($hasil, 'siswa');
        $siswaIds = array_map(function($s) {
            return $s['id_siswa'];
        }, $siswaIds);
        HasilSAW::whereIn('id_siswa', $siswaIds)->delete();

        // Simpan hasil baru
        foreach ($hasil as $h) {
            foreach ($h['rekomendasi'] as $rek) {
                HasilSAW::create([
                    'id_siswa' => $h['siswa']['id_siswa'],
                    'id_jurusan' => $rek['id_jurusan'],
                    'nilai_preferensi' => $rek['nilai_preferensi'],
                    'peringkat' => $rek['peringkat']
                ]);
            }
        }
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'hasil' => 'required|array'
        ]);

        // Hapus hasil sebelumnya
        HasilSAW::truncate();

        // Simpan hasil baru
        foreach ($request->hasil as $h) {
            HasilSAW::create([
                'id_siswa' => $h['id_siswa'],
                'id_jurusan' => $h['id_jurusan'],
                'nilai_preferensi' => $h['nilai_preferensi'],
                'peringkat' => $h['peringkat']
            ]);
        }

        return redirect()->route('saw.index')->with('success', 'Hasil perhitungan SAW berhasil disimpan!');
    }

    public function create()
    {
        // Ambil data siswa yang memiliki nilai lengkap
        $siswa = Siswa::with(['nilai.kriteria'])->get();

        // Ambil kriteria
        $kriteria = Kriteria::all();

        // Ambil jurusan
        $jurusan = Jurusan::all();

        // Hitung statistik
        $totalSiswa = $siswa->count();
        $totalKriteria = $kriteria->count();
        $totalJurusan = $jurusan->count();

        return view('saw.create', compact('siswa', 'kriteria', 'jurusan', 'totalSiswa', 'totalKriteria', 'totalJurusan'));
    }

    public function show($id)
    {
        // Cari hasil SAW berdasarkan id_siswa
        $hasilSAW = HasilSAW::where('id_siswa', $id)->with(['siswa', 'jurusan'])->get();

        if ($hasilSAW->isEmpty()) {
            return redirect()->route('saw.index')->with('error', 'Data hasil SAW tidak ditemukan!');
        }

        $siswa = $hasilSAW->first()->siswa;
        $kriteria = Kriteria::all();
        $nilaiSiswa = Nilai::where('id_siswa', $id)->with('kriteria')->get();

        return view('saw.show', compact('hasilSAW', 'siswa', 'kriteria', 'nilaiSiswa'));
    }

    public function edit($id)
    {
        // Cari hasil SAW berdasarkan id_siswa
        $hasilSAW = HasilSAW::where('id_siswa', $id)->with(['siswa', 'jurusan'])->get();

        if ($hasilSAW->isEmpty()) {
            return redirect()->route('saw.index')->with('error', 'Data hasil SAW tidak ditemukan!');
        }

        $siswa = $hasilSAW->first()->siswa;
        $kriteria = Kriteria::all();
        $jurusan = Jurusan::all();
        $nilaiSiswa = Nilai::where('id_siswa', $id)->with('kriteria')->get();

        return view('saw.edit', compact('hasilSAW', 'siswa', 'kriteria', 'jurusan', 'nilaiSiswa'));
    }

    public function hasil()
    {
        // Ambil semua hasil SAW yang sudah disimpan
        $hasilSAW = HasilSAW::with(['siswa', 'jurusan'])
                           ->orderBy('id_siswa')
                           ->orderBy('peringkat')
                           ->get()
                           ->groupBy('id_siswa');

        // Hitung statistik
        $totalSiswa = $hasilSAW->count();
        $totalRekomendasi = HasilSAW::count();

        return view('rekomendasi.index', compact('hasilSAW', 'totalSiswa', 'totalRekomendasi'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input nilai kriteria
        $request->validate([
            'nilai.*' => 'required|numeric|min:0|max:100'
        ]);

        // Update nilai siswa
        foreach ($request->nilai as $id_kriteria => $nilai) {
            Nilai::updateOrCreate(
                ['id_siswa' => $id, 'id_kriteria' => $id_kriteria],
                ['nilai' => $nilai]
            );
        }

        // Recalculate SAW untuk siswa ini
        $siswa = Siswa::where('id_siswa', $id)->with(['nilai.kriteria'])->first();
        $kriteria = Kriteria::all();
        $jurusan = Jurusan::all();

        if ($siswa) {
            // Hapus hasil SAW sebelumnya untuk siswa ini
            HasilSAW::where('id_siswa', $id)->delete();

            // Hitung ulang SAW
            $hasil = $this->hitungSAW(collect([$siswa]), $kriteria, $jurusan);

            // Simpan hasil baru
            foreach ($hasil[0]['rekomendasi'] as $rek) {
                HasilSAW::create([
                    'id_siswa' => $id,
                    'id_jurusan' => $rek['id_jurusan'],
                    'nilai_preferensi' => $rek['nilai_preferensi'],
                    'peringkat' => $rek['peringkat']
                ]);
            }
        }

        return redirect()->route('saw.show', $id)->with('success', 'Nilai siswa berhasil diperbarui dan SAW dihitung ulang!');
    }
}