@extends('layouts.app')

@section('title', 'Detail Hasil SAW')

@section('content')
<div class="container-fluid">
    @php
        $topRekom = $langkahPerhitungan['rekomendasi'][0] ?? null;
    @endphp

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <div>
            <h3 class="mb-1">Detail Hasil SAW</h3>
            <p class="text-muted mb-0">Hasil perhitungan untuk {{ $siswa->nama_siswa }}</p>
        </div>
        <div>
            <a href="{{ route('saw.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
            <a href="{{ route('saw.edit', $siswa->id_siswa) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i> Edit Nilai
            </a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-primary h-100">
                <div class="card-body">
                    <h6 class="text-primary mb-1">Rekomendasi Utama</h6>
                    <h4 class="mb-1">{{ $topRekom['nama_jurusan'] ?? '-' }}</h4>
                    <small class="text-muted">Nilai preferensi: {{ number_format($topRekom['nilai_preferensi'] ?? 0, 4) }}</small>
                    @if(!empty($langkahPerhitungan['penjelasan_tie']))
                    <div class="mt-3 alert alert-info py-2">
                        <strong>Catatan Tie:</strong> {{ $langkahPerhitungan['penjelasan_tie'] }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-success h-100">
                <div class="card-body">
                    <h6 class="text-success mb-1">Jumlah Kriteria</h6>
                    <h4 class="mb-1">{{ count($kriteria) }}</h4>
                    <small class="text-muted">Kriteria yang dipakai dalam perhitungan</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-info h-100">
                <div class="card-body">
                    <h6 class="text-info mb-1">Jumlah Jurusan</h6>
                    <h4 class="mb-1">{{ count($jurusan) }}</h4>
                    <small class="text-muted">Alternatif yang dibandingkan</small>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Informasi Siswa</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <tr>
                        <th width="30%">Nama Siswa</th>
                        <td>{{ $siswa->nama_siswa }}</td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td>{{ $siswa->kelas }}</td>
                    </tr>
                    <tr>
                        <th>Jurusan Sekolah</th>
                        <td>{{ $siswa->jurusan_sekolah }}</td>
                    </tr>
                    <tr>
                        <th>Tahun Ajaran</th>
                        <td>{{ $siswa->tahun_ajaran }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Nilai Siswa per Kriteria</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @php
                    $labelMap = [
                        'Pengetahuan Kognitif' => 'C1',
                        'Minat dan Bakat' => 'C2',
                        'Psikotes' => 'C3',
                    ];
                @endphp
                <table class="table table-bordered table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            <th>Bobot</th>
                            <th>Nilai Siswa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kriteria as $k)
                        <tr>
                            <td>{{ $labelMap[$k->nama_kriteria] ?? $k->nama_kriteria }} - {{ $k->nama_kriteria }}</td>
                            <td>{{ $k->bobot }}</td>
                            <td>{{ number_format($langkahPerhitungan['nilai_siswa'][$k->id_kriteria] ?? 0, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Step 1 - Matriks Keputusan</h5>
        </div>
        <div class="card-body">
            <p class="text-muted mb-3">X[i][j] = 5 - ABS(nilai siswa - profil jurusan)</p>
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Jurusan</th>
                            @foreach($kriteria as $k)
                            <th>{{ $k->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jurusan as $j)
                        <tr>
                            <td>{{ $j->nama_jurusan }}</td>
                            @foreach($kriteria as $k)
                            <td>{{ number_format($langkahPerhitungan['matriks_keputusan'][$j->id_jurusan][$k->id_kriteria] ?? 0, 4) }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Step 2 - Nilai Maksimum per Kolom</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            <th>Max</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kriteria as $k)
                        <tr>
                            <td>{{ $k->nama_kriteria }}</td>
                            <td>{{ number_format($langkahPerhitungan['max_per_kolom'][$k->id_kriteria] ?? 0, 4) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">Step 3 - Matriks Normalisasi</h5>
        </div>
        <div class="card-body">
            <p class="text-muted mb-3">R[i][j] = nilai Matriks Keputusan/skor max matriks keputusan</p>
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Jurusan</th>
                            @foreach($kriteria as $k)
                            <th>{{ $k->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jurusan as $j)
                        <tr>
                            <td>{{ $j->nama_jurusan }}</td>
                            @foreach($kriteria as $k)
                            <td>{{ number_format($langkahPerhitungan['matriks_normalisasi'][$j->id_jurusan][$k->id_kriteria] ?? 0, 4) }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Step 4 - Nilai Preferensi</h5>
        </div>
        <div class="card-body">
            <p class="text-muted mb-3">V[i] = nilai normalisasi matriks*bobot kriteria</p>
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Jurusan</th>
                            <th>Nilai Preferensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jurusan as $j)
                        <tr>
                            <td>{{ $j->nama_jurusan }}</td>
                            <td>{{ number_format($langkahPerhitungan['nilai_preferensi'][$j->id_jurusan] ?? 0, 4) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Step 5 - Ranking Akhir</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th>Jurusan</th>
                            <th>Nilai Preferensi</th>
                            <th>Alasan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($langkahPerhitungan['rekomendasi'] as $rek)
                        <tr>
                            <td>{{ $rek['peringkat'] }}</td>
                            <td>{{ $rek['nama_jurusan'] }}</td>
                            <td>{{ number_format($rek['nilai_preferensi'], 4) }}</td>
                            <td>{{ $rek['alasan'] ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Kesimpulan & Alasan Rekomendasi -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Kesimpulan & Alasan Rekomendasi</h5>
        </div>
        <div class="card-body">
            @php
                $top = $langkahPerhitungan['rekomendasi'][0] ?? null;
            @endphp
            <p>
                <strong>Kesimpulan:</strong> Rekomendasi utama untuk <strong>{{ $siswa->nama_siswa }}</strong> adalah
                <strong>{{ $top['nama_jurusan'] ?? '-' }}</strong> dengan nilai preferensi
                <strong>{{ number_format($top['nilai_preferensi'] ?? 0, 4) }}</strong>.
                @if(!empty($top['alasan']))
                    Alasan singkat: {{ $top['alasan'] }}
                @endif
                @if(!empty($langkahPerhitungan['penjelasan_tie']))
                    <br><em>{{ $langkahPerhitungan['penjelasan_tie'] }}</em>
                @endif
            </p>

            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Alasan Rekomendasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($langkahPerhitungan['rekomendasi'] as $rek)
                        <tr>
                            <td>
                                <strong>{{ $rek['nama_jurusan'] }}</strong>: {{ $rek['alasan'] ?? '-' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection