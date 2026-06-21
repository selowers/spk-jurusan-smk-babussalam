<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kriteria;
use App\Models\Nilai;
use App\Models\HasilSAW;
use App\Models\Jurusan;
use App\Models\JurusanKriteria;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

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
            // STEP 1: Ambil nilai siswa per kriteria
            $nilaiSiswa = [];
            foreach ($kriteria as $k) {
                $nilai = $s->nilai->where('id_kriteria', $k->id_kriteria)->first();
                $nilaiSiswa[$k->id_kriteria] = $nilai ? $nilai->nilai : 0;
            }

            // STEP 2: Matriks Keputusan X[i][j] = 5 - |profil_siswa - profil_jurusan|
            $matriksX = [];
            $maxPerKolom = array_fill_keys($kriteria->pluck('id_kriteria')->toArray(), 0);

            foreach ($jurusan as $j) {
                $matriksX[$j->id_jurusan] = [];
                foreach ($kriteria as $k) {
                    // Ambil profil nilai jurusan untuk kriteria ini
                    $profil = JurusanKriteria::where('id_jurusan', $j->id_jurusan)
                                            ->where('id_kriteria', $k->id_kriteria)
                                            ->first();
                    $nilaiProfil = $profil ? $profil->nilai : 0;

                    // Hitung X[i][j] menggunakan rumus Excel yang sama:
                    // 5 - ABS(nilai_siswa_skala_5 - profil_jurusan)
                    // Nilai siswa bisa sudah 0-5, atau masih 0-100 yang perlu dikonversi.
                    $nilaiMentah = $nilaiSiswa[$k->id_kriteria];
                    $nilaiSkala5 = $nilaiMentah > 5
                        ? ($nilaiMentah / 100) * 5
                        : $nilaiMentah;
                    $xij = 5 - abs($nilaiSkala5 - $nilaiProfil);
                    $matriksX[$j->id_jurusan][$k->id_kriteria] = $xij;

                    // Simpan max per kolom tanpa pembulatan sementara
                    if ($xij > $maxPerKolom[$k->id_kriteria]) {
                        $maxPerKolom[$k->id_kriteria] = $xij;
                    }
                }
            }

            // STEP 3: Normalisasi R[i][j] = X[i][j] / max(X[*][j])
            $matriksR = [];
            foreach ($jurusan as $j) {
                $matriksR[$j->id_jurusan] = [];
                foreach ($kriteria as $k) {
                    $maxKolom = $maxPerKolom[$k->id_kriteria];
                    $rij = $maxKolom > 0
                        ? $matriksX[$j->id_jurusan][$k->id_kriteria] / $maxKolom
                        : 0;
                    $matriksR[$j->id_jurusan][$k->id_kriteria] = $rij;
                }
            }

            // STEP 4: Nilai Preferensi V[i] = Σ(Wj × R[i][j])
            $nilaiPreferensi = [];
            foreach ($jurusan as $j) {
                $vi = 0;
                foreach ($kriteria as $k) {
                    $vi += $k->bobot * $matriksR[$j->id_jurusan][$k->id_kriteria];
                }
                $nilaiPreferensi[$j->id_jurusan] = $vi;
            }

            // STEP 5: Ranking berdasarkan V tertinggi
            arsort($nilaiPreferensi);
            $peringkat = 1;
            $rekomendasi = [];
            foreach ($nilaiPreferensi as $id_jurusan => $vi) {
                $jurusanData = $jurusan->where('id_jurusan', $id_jurusan)->first();
                $rekomendasi[] = [
                    'id_jurusan' => $id_jurusan,
                    'nama_jurusan' => $jurusanData->nama_jurusan,
                    'nilai_preferensi' => $vi,
                    'peringkat' => $peringkat
                ];
                $peringkat++;
            }

            $hasil[] = [
                'siswa' => $s,
                'nilai_siswa' => $nilaiSiswa,
                'matriks_keputusan' => $matriksX,
                'max_per_kolom' => $maxPerKolom,
                'matriks_normalisasi' => $matriksR,
                'nilai_preferensi' => $nilaiPreferensi,
                'rekomendasi' => $rekomendasi
            ];
        }

        return $hasil;
    }

    private function simpanHasil($hasil)
    {
        // Kumpulkan id siswa yang diproses
        $siswaIds = array_map(fn($h) => $h['siswa']->id_siswa, $hasil);

        // Hapus hasil lama untuk siswa-siswa tersebut
        HasilSAW::whereIn('id_siswa', $siswaIds)->delete();

        // Simpan hasil baru
        foreach ($hasil as $h) {
            foreach ($h['rekomendasi'] as $rek) {
                HasilSAW::create([
                    'id_siswa'         => $h['siswa']->id_siswa,
                    'id_jurusan'       => $rek['id_jurusan'],
                    'nilai_preferensi' => $rek['nilai_preferensi'],
                    'peringkat'        => $rek['peringkat']
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
        // Ambil data siswa
        $siswa = Siswa::where('id_siswa', $id)->with(['nilai.kriteria'])->first();
        if (!$siswa) {
            return redirect()->route('saw.index')->with('error', 'Data siswa tidak ditemukan!');
        }

        // Ambil data pendukung
        $kriteria = Kriteria::all();
        $jurusan = Jurusan::all();

        // Hitung SAW dengan detail langkah
        $hasilSAW = $this->hitungSAW(collect([$siswa]), $kriteria, $jurusan);
        $langkahPerhitungan = $hasilSAW[0];

        // Ambil hasil SAW dari database untuk perbandingan
        $hasilDatabase = HasilSAW::where('id_siswa', $id)->with('jurusan')->orderBy('peringkat')->get();

        return view('saw.show', compact('siswa', 'kriteria', 'jurusan', 'langkahPerhitungan', 'hasilDatabase'));
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

    public function simpanNilaiKuesioner(Request $request, $id_siswa)
    {
        $request->validate([
            'skor_c1' => 'required|numeric|min:0|max:60', // 12 soal × 5 = 60
            'skor_c2' => 'required|numeric|min:0|max:35', // 7 soal × 5 = 35
            'skor_c3' => 'required|numeric|min:0|max:45', // 9 soal × 5 = 45
        ]);

        // Konversi skor kuesioner ke nilai 0-100
        // Jangan pembulatan di sini agar hasil perhitungan SAW sesuai Excel.
        $nilai_c1 = ($request->skor_c1 / 60) * 100;
        $nilai_c2 = ($request->skor_c2 / 35) * 100;
        $nilai_c3 = ($request->skor_c3 / 45) * 100;

        // Simpan nilai ke database
        $kriteria = Kriteria::all();
        $nilaiData = [
            ['id_kriteria' => $kriteria->where('nama_kriteria', 'Pengetahuan Kognitif')->first()->id_kriteria, 'nilai' => $nilai_c1],
            ['id_kriteria' => $kriteria->where('nama_kriteria', 'Minat dan Bakat')->first()->id_kriteria, 'nilai' => $nilai_c2],
            ['id_kriteria' => $kriteria->where('nama_kriteria', 'Psikotes')->first()->id_kriteria, 'nilai' => $nilai_c3],
        ];

        foreach ($nilaiData as $data) {
            Nilai::updateOrCreate(
                ['id_siswa' => $id_siswa, 'id_kriteria' => $data['id_kriteria']],
                ['nilai' => $data['nilai']]
            );
        }

        return redirect()->route('nilai.index')->with('success', 'Nilai kuesioner berhasil disimpan!');
    }

    public function exportPDF()
    {
        $hasilSAW = HasilSAW::with(['siswa', 'jurusan'])
                           ->orderBy('id_siswa')
                           ->orderBy('peringkat')
                           ->get()
                           ->groupBy('id_siswa');

        $data = [
            'hasilSAW'     => $hasilSAW,
            'tanggalCetak' => now()
        ];

        /*
         * PENTING: margin diatur lewat padding di .halaman pada blade,
         * bukan lewat setOption. Semua margin di sini dibuat 0.
         */
        $pdf = Pdf::loadView('rekomendasi.pdf', $data)
                   ->setPaper('a4', 'landscape')
                   ->setOption('margin-top',    0)
                   ->setOption('margin-right',  0)
                   ->setOption('margin-bottom', 0)
                   ->setOption('margin-left',   0)
                   ->setOption('dpi', 96)
                   ->setOption('isHtml5ParserEnabled', true)
                   ->setOption('isRemoteEnabled', true);

        return $pdf->download('Hasil_Rekomendasi_SPK_Jurusan_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function exportPDFPerSiswa($id)
    {
        $hasilSAW = HasilSAW::with(['siswa', 'jurusan'])
                           ->where('id_siswa', $id)
                           ->orderBy('peringkat')
                           ->get();

        if ($hasilSAW->isEmpty()) {
            return redirect()->route('saw.hasil')->with('error', 'Data hasil SAW untuk siswa ini tidak ditemukan.');
        }

        $data = [
            'hasilSAW'     => $hasilSAW,
            'tanggalCetak' => now()
        ];

        $namaSiswa = Str::slug($hasilSAW->first()->siswa->nama_siswa ?? 'siswa');
        $filename = 'Hasil_Rekomendasi_' . $namaSiswa . '_' . date('Y-m-d_H-i-s') . '.pdf';

        $pdf = Pdf::loadView('rekomendasi.pdf_per_siswa', $data)
                   ->setPaper('a4', 'landscape')
                   ->setOption('margin-top',    0)
                   ->setOption('margin-right',  0)
                   ->setOption('margin-bottom', 0)
                   ->setOption('margin-left',   0)
                   ->setOption('dpi', 96)
                   ->setOption('isHtml5ParserEnabled', true)
                   ->setOption('isRemoteEnabled', true);

        return $pdf->download($filename);
    }
}
