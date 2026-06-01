@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Informasi Siswa -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Siswa</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama Siswa</th>
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
            </div>

            <!-- Ringkasan Hasil SAW -->
            <div class="card card-primary card-outline">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Ringkasan Hasil SAW</h3>
                </div>
                <div class="card-body">
                    @php $topRekom = $langkahPerhitungan['rekomendasi'][0] ?? null; @endphp
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="p-3 rounded bg-info text-white h-100">
                                <h5 class="mb-2">Rekomendasi Utama</h5>
                                <p class="h4 mb-1">{{ $topRekom['nama_jurusan'] ?? '-' }}</p>
                                <p class="mb-0">Nilai preferensi: <strong>{{ number_format($topRekom['nilai_preferensi'] ?? 0, 4) }}</strong></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 rounded bg-success text-white h-100">
                                <h5 class="mb-2">Jumlah Kriteria</h5>
                                <p class="h4 mb-1">{{ count($kriteria) }}</p>
                                <p class="mb-0">Setiap kriteria dinilai lalu dinormalisasi agar adil.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 rounded bg-warning text-dark h-100">
                                <h5 class="mb-2">Intisari Metode</h5>
                                <p class="mb-0">SAW mengubah skor ke nilai komparatif lalu menjumlahkan bobot untuk ranking akhir.</p>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-secondary">
                        <h6 class="mb-2">Mengapa hasil ini muncul?</h6>
                        <p class="mb-1">SAW menghitung nilai akhir berdasarkan tiga tahapan utama:</p>
                        <ul class="mb-0">
                            <li>Matriks keputusan menggabungkan nilai siswa dengan profil jurusan.</li>
                            <li>Normalisasi membuat semua nilai berada pada skala yang sama.</li>
                            <li>Bobot dikalikan dengan nilai normalisasi untuk memberi penilaian akhir.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Nilai Siswa per Kriteria -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Nilai Siswa per Kriteria</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                <th>Bobot</th>
                                <th>Nilai Siswa (0-100)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kriteria as $k)
                            <tr>
                                <td>{{ $k->nama_kriteria }}</td>
                                <td>{{ $k->bobot }}</td>
                                <td>{{ number_format($langkahPerhitungan['nilai_siswa'][$k->id_kriteria] ?? 0, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- STEP 1: Matriks Keputusan -->
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">STEP 1: Matriks Keputusan X[i][j]</h3>
                    <div class="card-tools">
                        <small>X[i][j] = (nilai_siswa[j] + profil_jurusan[i][j]) / 2</small>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted">Tahap pertama membangun dasar perbandingan. Setiap skor siswa digabung dengan profil jurusan agar nilai menjadi lebih objektif.</p>
                    <ul class="small text-muted mb-3">
                        <li>X[i][j] dihitung dengan rata-rata antara nilai siswa dan profil jurusan.</li>
                        <li>Formula: <strong>X[i][j] = (nilai_siswa[j] + profil_jurusan[i][j]) / 2</strong>.</li>
                        <li>Tujuannya adalah menyamakan skala awal sebelum normalisasi.</li>
                    </ul>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
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

            <!-- STEP 2: Max per Kolom -->
            <div class="card border-info">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">STEP 2: Nilai Maximum per Kolom</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">Tahap kedua mencari nilai terbaik untuk masing-masing kriteria. Nilai maksimum ini digunakan sebagai pembagi agar semua skor dapat dibandingkan secara adil.</p>
                    <ul class="small text-muted mb-3">
                        <li>Untuk setiap kolom kriteria, ambil nilai tertinggi dari semua jurusan.</li>
                        <li>Formula: <strong>max(X[*][j])</strong>.</li>
                        <li>Nilai maksimum ini bertindak sebagai normalizer agar semua kriteria menjadi skala 0-1.</li>
                    </ul>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                <th>Max Value</th>
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

            <!-- STEP 3: Matriks Normalisasi -->
            <div class="card border-warning">
                <div class="card-header bg-warning text-dark">
                    <h3 class="card-title">STEP 3: Matriks Normalisasi R[i][j]</h3>
                    <div class="card-tools">
                        <small>R[i][j] = X[i][j] / max(X[*][j])</small>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted">Normalisasi mengubah nilai keputusan menjadi skala 0 sampai 1. Ini menghilangkan pengaruh besar kecilnya satuan agar semua kriteria setara.</p>
                    <ul class="small text-muted mb-3">
                        <li>Setiap X[i][j] dibagi dengan nilai maksimum kolom yang sama.</li>
                        <li>Formula: <strong>R[i][j] = X[i][j] / max(X[*][j])</strong>.</li>
                        <li>Hasilnya adalah nilai komparatif antara jurusan untuk setiap kriteria.</li>
                    </ul>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
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

            <!-- STEP 4: Nilai Preferensi -->
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title">STEP 4: Nilai Preferensi V[i]</h3>
                    <div class="card-tools">
                        <small>V[i] = Σ(W[j] × R[i][j])</small>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted">Setiap nilai normalisasi dikalikan dengan bobot kriteria. Jurusan yang paling sesuai mendapat total preferensi tertinggi.</p>
                    <ul class="small text-muted mb-3">
                        <li>Setiap R[i][j] dikalikan dengan bobot kriteria W[j].</li>
                        <li>Formula: <strong>V[i] = Σ(W[j] × R[i][j])</strong>.</li>
                        <li>Bobot memastikan kriteria penting memiliki pengaruh lebih besar.</li>
                    </ul>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Jurusan</th>
                                    @foreach($kriteria as $k)
                                    <th>{{ $k->nama_kriteria }}<br><small>(W={{ $k->bobot }})</small></th>
                                    @endforeach
                                    <th>Nilai Preferensi V[i]</th>
                                    <th>Perhitungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jurusan as $j)
                                <tr>
                                    <td>{{ $j->nama_jurusan }}</td>
                                    @php
                                        $perhitungan = [];
                                    @endphp
                                    @foreach($kriteria as $k)
                                    <td>
                                        {{ number_format($langkahPerhitungan['matriks_normalisasi'][$j->id_jurusan][$k->id_kriteria] ?? 0, 4) }}
                                        @php
                                            $perhitungan[] = number_format($k->bobot, 2) . '×' . number_format($langkahPerhitungan['matriks_normalisasi'][$j->id_jurusan][$k->id_kriteria] ?? 0, 4) . '=' . number_format($k->bobot * ($langkahPerhitungan['matriks_normalisasi'][$j->id_jurusan][$k->id_kriteria] ?? 0), 4);
                                        @endphp
                                    </td>
                                    @endforeach
                                    <td><strong>{{ number_format($langkahPerhitungan['nilai_preferensi'][$j->id_jurusan] ?? 0, 4) }}</strong></td>
                                    <td><small>{{ implode(' + ', $perhitungan) }}</small></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- STEP 5: Ranking Akhir -->
            <div class="card border-dark">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">STEP 5: Ranking Akhir</h3>
                    <div class="card-tools">
                        <small>Urutkan berdasarkan V[i] tertinggi</small>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted">Langkah terakhir menampilkan urutan jurusan berdasarkan nilai preferensi. Jurusan pada peringkat pertama adalah rekomendasi utama.</p>
                    <ul class="small text-muted mb-3">
                        <li>Semakin tinggi nilai V[i], semakin cocok jurusan tersebut untuk siswa.</li>
                        <li>Ranking menentukan pilihan rekomendasi berdasarkan hasil akhir.</li>
                    </ul>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Peringkat</th>
                                    <th>Jurusan</th>
                                    <th>Nilai Preferensi</th>
                                    <th>Rekomendasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($langkahPerhitungan['rekomendasi'] as $rek)
                                <tr class="{{ $rek['peringkat'] == 1 ? 'table-success' : '' }}">
                                    <td>
                                        @if($rek['peringkat'] == 1)
                                            <span class="badge badge-success">🥇 #{{ $rek['peringkat'] }}</span>
                                        @else
                                            #{{ $rek['peringkat'] }}
                                        @endif
                                    </td>
                                    <td><strong>{{ $rek['nama_jurusan'] }}</strong></td>
                                    <td><strong>{{ number_format($rek['nilai_preferensi'], 4) }}</strong></td>
                                    <td>
                                        @if($rek['peringkat'] == 1)
                                            <span class="badge badge-success">REKOMENDASI UTAMA</span>
                                        @else
                                            Alternatif {{ $rek['peringkat'] }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('saw.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke SAW
                    </a>
                    <a href="{{ route('saw.edit', $siswa->id_siswa) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit Nilai Siswa
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection