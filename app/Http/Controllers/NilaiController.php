<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kriteria;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::with(['nilai.kriteria'])->get();
        $kriteria = Kriteria::all();

        // Hitung status lengkap untuk setiap siswa
        foreach ($siswa as $s) {
            $s->status_lengkap = $s->nilai->count() == $kriteria->count();
        }

        return view('nilai.index', compact('siswa', 'kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id_siswa)
    {
        $siswa = Siswa::findOrFail($id_siswa);
        $kriteria = Kriteria::all();

        // Cek apakah siswa sudah memiliki nilai lengkap
        $nilaiLengkap = $siswa->nilai->count() == $kriteria->count();

        if ($nilaiLengkap) {
            return redirect()->route('nilai.index')
                ->with('warning', 'Siswa ini sudah memiliki nilai lengkap. Gunakan menu edit untuk mengubah nilai.');
        }

        return view('nilai.create', compact('siswa', 'kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id_siswa)
    {
        $siswa = Siswa::findOrFail($id_siswa);
        $kriteria = Kriteria::all();

        // Validasi input
        $rules = [];
        foreach ($kriteria as $k) {
            $rules["skor_{$k->id_kriteria}"] = 'required|numeric|min:0';
            if ($k->nama_kriteria == 'Pengetahuan Kognitif') {
                $rules["skor_{$k->id_kriteria}"] .= '|max:60';
            } elseif ($k->nama_kriteria == 'Minat dan Bakat') {
                $rules["skor_{$k->id_kriteria}"] .= '|max:35';
            } elseif ($k->nama_kriteria == 'Psikotes') {
                $rules["skor_{$k->id_kriteria}"] .= '|max:45';
            }
        }

        $request->validate($rules, [
            'required' => 'Skor :attribute wajib diisi.',
            'numeric' => 'Skor :attribute harus berupa angka.',
            'min' => 'Skor :attribute minimal :min.',
            'max' => 'Skor :attribute maksimal :max.',
        ]);

        DB::beginTransaction();
        try {
            foreach ($kriteria as $k) {
                $skorMentah = $request->input("skor_{$k->id_kriteria}");

                // Konversi skor mentah ke nilai 0-100
                $nilaiKonversi = $this->konversiSkorKeNilai($k->nama_kriteria, $skorMentah);

                // Simpan atau update nilai
                Nilai::updateOrCreate(
                    [
                        'id_siswa' => $id_siswa,
                        'id_kriteria' => $k->id_kriteria
                    ],
                    [
                        'nilai' => $nilaiKonversi
                    ]
                );
            }

            DB::commit();
            return redirect()->route('nilai.index')
                ->with('success', 'Nilai kuesioner siswa berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan nilai: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_siswa)
    {
        $siswa = Siswa::with('nilai.kriteria')->findOrFail($id_siswa);
        $kriteria = Kriteria::all();

        return view('nilai.edit', compact('siswa', 'kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_siswa)
    {
        $siswa = Siswa::findOrFail($id_siswa);
        $kriteria = Kriteria::all();

        // Validasi input
        $rules = [];
        foreach ($kriteria as $k) {
            $rules["skor_{$k->id_kriteria}"] = 'required|numeric|min:0';
            if ($k->nama_kriteria == 'Pengetahuan Kognitif') {
                $rules["skor_{$k->id_kriteria}"] .= '|max:60';
            } elseif ($k->nama_kriteria == 'Minat dan Bakat') {
                $rules["skor_{$k->id_kriteria}"] .= '|max:35';
            } elseif ($k->nama_kriteria == 'Psikotes') {
                $rules["skor_{$k->id_kriteria}"] .= '|max:45';
            }
        }

        $request->validate($rules, [
            'required' => 'Skor :attribute wajib diisi.',
            'numeric' => 'Skor :attribute harus berupa angka.',
            'min' => 'Skor :attribute minimal :min.',
            'max' => 'Skor :attribute maksimal :max.',
        ]);

        DB::beginTransaction();
        try {
            foreach ($kriteria as $k) {
                $skorMentah = $request->input("skor_{$k->id_kriteria}");

                // Konversi skor mentah ke nilai 0-100
                $nilaiKonversi = $this->konversiSkorKeNilai($k->nama_kriteria, $skorMentah);

                // Simpan atau update nilai
                Nilai::updateOrCreate(
                    [
                        'id_siswa' => $id_siswa,
                        'id_kriteria' => $k->id_kriteria
                    ],
                    [
                        'nilai' => $nilaiKonversi
                    ]
                );
            }

            DB::commit();
            return redirect()->route('nilai.index')
                ->with('success', 'Nilai kuesioner siswa berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui nilai: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Konversi skor mentah kuesioner ke nilai 0-100
     */
    private function konversiSkorKeNilai($namaKriteria, $skorMentah)
    {
        switch ($namaKriteria) {
            case 'Pengetahuan Kognitif':
                // C1: 12 soal × 5 = 60 skor maksimal
                return ($skorMentah / 60) * 100;
            case 'Minat dan Bakat':
                // C2: 7 soal × 5 = 35 skor maksimal
                return ($skorMentah / 35) * 100;
            case 'Psikotes':
                // C3: 9 soal × 5 = 45 skor maksimal
                return ($skorMentah / 45) * 100;
            default:
                return 0;
        }
    }

    /**
     * Get konfigurasi kuesioner per kriteria
     */
    public function getKonfigKuesioner()
    {
        return [
            'Pengetahuan Kognitif' => ['item' => 12, 'skor_maks' => 60],
            'Minat dan Bakat' => ['item' => 7, 'skor_maks' => 35],
            'Psikotes' => ['item' => 9, 'skor_maks' => 45],
        ];
    }
}