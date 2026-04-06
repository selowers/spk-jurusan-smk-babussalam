@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Perhitungan SAW</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('saw.index') }}">SAW</a></li>
                        <li class="breadcrumb-item active">Detail Perhitungan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">STEP 1: Matriks Keputusan X[i][j]</h3>
                    <div class="card-tools">
                        <small class="text-muted">X[i][j] = (nilai_siswa[j] + profil_jurusan[i][j]) / 2</small>
                    </div>
                </div>
                <div class="card-body">
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">STEP 2: Nilai Maximum per Kolom</h3>
                </div>
                <div class="card-body">
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">STEP 3: Matriks Normalisasi R[i][j]</h3>
                    <div class="card-tools">
                        <small class="text-muted">R[i][j] = X[i][j] / max(X[*][j])</small>
                    </div>
                </div>
                <div class="card-body">
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">STEP 4: Nilai Preferensi V[i]</h3>
                    <div class="card-tools">
                        <small class="text-muted">V[i] = Σ(W[j] × R[i][j])</small>
                    </div>
                </div>
                <div class="card-body">
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">STEP 5: Ranking Akhir</h3>
                    <div class="card-tools">
                        <small class="text-muted">Urutkan berdasarkan V[i] tertinggi</small>
                    </div>
                </div>
                <div class="card-body">
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
                    <button onclick="window.print()" class="btn btn-info">
                        <i class="fas fa-print"></i> Print
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection