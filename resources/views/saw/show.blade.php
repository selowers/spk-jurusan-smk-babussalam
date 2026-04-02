@extends('layouts.app')

@section('title', 'Detail Hasil SAW - SPK Jurusan SMK Babussalam')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Detail Hasil SAW</h1>
            <p class="mb-0">Detail rekomendasi jurusan untuk siswa: <strong>{{ $siswa->nama_siswa }}</strong></p>
        </div>
        <div>
            <a href="{{ route('saw.edit', $siswa->id_siswa) }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i> Edit Nilai
            </a>
            <a href="{{ route('saw.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Siswa Information -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Siswa</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="150"><strong>Nama Siswa</strong></td>
                                    <td>: {{ $siswa->nama_siswa }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Kelas</strong></td>
                                    <td>: {{ $siswa->kelas }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jurusan Sekolah</strong></td>
                                    <td>: {{ $siswa->jurusan_sekolah }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tahun Ajaran</strong></td>
                                    <td>: {{ $siswa->tahun_ajaran }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <div class="avatar-circle mx-auto mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: bold;">
                                    {{ strtoupper(substr($siswa->nama_siswa, 0, 1)) }}
                                </div>
                                <p class="text-muted">Avatar Siswa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Nilai Siswa -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Nilai Siswa</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kriteria</th>
                                    <th>Bobot</th>
                                    <th>Tipe</th>
                                    <th>Nilai</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nilaiSiswa as $nilai)
                                <tr>
                                    <td>{{ $nilai->kriteria->nama_kriteria }}</td>
                                    <td>{{ $nilai->kriteria->bobot }}</td>
                                    <td>
                                        <span class="badge badge-{{ $nilai->kriteria->tipe == 'benefit' ? 'success' : 'warning' }}">
                                            {{ ucfirst($nilai->kriteria->tipe) }}
                                        </span>
                                    </td>
                                    <td><strong>{{ $nilai->nilai }}</strong></td>
                                    <td>
                                        @if($nilai->nilai >= 80)
                                            <span class="badge badge-success">Sangat Baik</span>
                                        @elseif($nilai->nilai >= 70)
                                            <span class="badge badge-info">Baik</span>
                                        @elseif($nilai->nilai >= 60)
                                            <span class="badge badge-warning">Cukup</span>
                                        @else
                                            <span class="badge badge-danger">Perlu Ditingkatkan</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hasil Rekomendasi SAW -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Hasil Rekomendasi SAW</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Peringkat</th>
                                    <th>Jurusan</th>
                                    <th>Fakultas</th>
                                    <th>Perguruan Tinggi</th>
                                    <th>Nilai Preferensi</th>
                                    <th>Rekomendasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hasilSAW->sortBy('peringkat') as $hasil)
                                <tr class="{{ $hasil->peringkat == 1 ? 'table-success' : '' }}">
                                    <td>
                                        <span class="badge badge-{{ $hasil->peringkat == 1 ? 'success' : 'secondary' }} badge-lg">
                                            #{{ $hasil->peringkat }}
                                        </span>
                                    </td>
                                    <td><strong>{{ $hasil->jurusan->nama_jurusan }}</strong></td>
                                    <td>{{ $hasil->jurusan->fakultas }}</td>
                                    <td>{{ $hasil->jurusan->perguruan_tinggi }}</td>
                                    <td><strong>{{ number_format($hasil->nilai_preferensi, 4) }}</strong></td>
                                    <td>
                                        @if($hasil->peringkat == 1)
                                            <span class="badge badge-success badge-lg">
                                                <i class="fas fa-star"></i> Rekomendasi Utama
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">
                                                Alternatif {{ $hasil->peringkat }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Rekomendasi Utama:</strong> {{ $hasilSAW->where('peringkat', 1)->first()->jurusan->nama_jurusan }}
                        (Nilai Preferensi: {{ number_format($hasilSAW->where('peringkat', 1)->first()->nilai_preferensi, 4) }})
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection