@extends('layouts.app')

@section('title', 'Hasil Rekomendasi SAW - SPK Jurusan SMK Babussalam')

@section('content')
<div class="container-fluid">
    <!-- Success Alert -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Hasil Rekomendasi SAW</h1>
            <p class="mb-0">Daftar rekomendasi jurusan untuk semua siswa</p>
        </div>
        <div>
            <a href="{{ route('saw.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                <i class="fas fa-calculator fa-sm text-white-50"></i> Proses Perhitungan SAW
            </a>
            <a href="{{ route('saw.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <!-- Total Siswa dengan Hasil -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Siswa dengan Hasil</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $hasilSAW->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Rekomendasi -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Rekomendasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $hasilSAW->sum(function($hasil) { return $hasil->count(); }) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jurusan Paling Populer -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Jurusan Terpopuler</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @php
                                    $jurusanCount = [];
                                    foreach($hasilSAW as $hasil) {
                                        foreach($hasil as $h) {
                                            if($h->peringkat == 1) {
                                                $jurusanCount[$h->jurusan->nama_jurusan] = ($jurusanCount[$h->jurusan->nama_jurusan] ?? 0) + 1;
                                            }
                                        }
                                    }
                                    arsort($jurusanCount);
                                    $topJurusan = key($jurusanCount) ?? 'Belum ada';
                                @endphp
                                {{ Str::limit($topJurusan, 15) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-trophy fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Sistem -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Status Sistem</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <span class="badge badge-success">Aktif</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hasil Rekomendasi -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Rekomendasi Jurusan per Siswa</h6>
                </div>
                <div class="card-body">
                    @if($hasilSAW->count() > 0)
                        <div class="accordion" id="hasilAccordion">
                            @foreach($hasilSAW as $idSiswa => $hasil)
                                @php
                                    $siswa = $hasil->first()->siswa;
                                    $rekomendasiUtama = $hasil->where('peringkat', 1)->first();
                                @endphp
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $idSiswa }}">
                                        <button class="accordion-button {{ !$loop->first ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $idSiswa }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse{{ $idSiswa }}">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 16px; font-weight: bold;">
                                                    {{ strtoupper(substr($siswa->nama_siswa, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <strong>{{ $siswa->nama_siswa }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $siswa->kelas }} - {{ $siswa->jurusan_sekolah }}</small>
                                                </div>
                                                <div class="ms-auto me-3">
                                                    <span class="badge badge-success">
                                                        <i class="fas fa-star"></i> {{ $rekomendasiUtama->jurusan->nama_jurusan }}
                                                    </span>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $idSiswa }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="heading{{ $idSiswa }}" data-bs-parent="#hasilAccordion">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h6>Rekomendasi Jurusan:</h6>
                                                    <div class="table-responsive">
                                                        <table class="table table-sm table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Peringkat</th>
                                                                    <th>Jurusan</th>
                                                                    <th>Fakultas</th>
                                                                    <th>Nilai Preferensi</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($hasil->sortBy('peringkat') as $h)
                                                                <tr class="{{ $h->peringkat == 1 ? 'table-success' : '' }}">
                                                                    <td>
                                                                        <span class="badge badge-{{ $h->peringkat == 1 ? 'success' : 'secondary' }}">
                                                                            #{{ $h->peringkat }}
                                                                        </span>
                                                                    </td>
                                                                    <td><strong>{{ $h->jurusan->nama_jurusan }}</strong></td>
                                                                    <td>{{ $h->jurusan->fakultas }}</td>
                                                                    <td>{{ number_format($h->nilai_preferensi, 4) }}</td>
                                                                    <td>
                                                                        @if($h->peringkat == 1)
                                                                            <span class="badge badge-success">
                                                                                <i class="fas fa-star"></i> Rekomendasi Utama
                                                                            </span>
                                                                        @else
                                                                            <span class="badge badge-secondary">
                                                                                Alternatif {{ $h->peringkat }}
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card border-success">
                                                        <div class="card-header bg-success text-white">
                                                            <h6 class="mb-0"><i class="fas fa-trophy"></i> Rekomendasi Utama</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $rekomendasiUtama->jurusan->nama_jurusan }}</h5>
                                                            <p class="card-text">
                                                                <strong>Fakultas:</strong> {{ $rekomendasiUtama->jurusan->fakultas }}<br>
                                                                <strong>Kampus:</strong> {{ $rekomendasiUtama->jurusan->perguruan_tinggi }}<br>
                                                                <strong>Nilai:</strong> {{ number_format($rekomendasiUtama->nilai_preferensi, 4) }}
                                                            </p>
                                                            <a href="{{ route('saw.show', $siswa->id_siswa) }}" class="btn btn-success btn-sm">
                                                                <i class="fas fa-eye"></i> Lihat Detail
                                                            </a>
                                                            <a href="{{ route('saw.edit', $siswa->id_siswa) }}" class="btn btn-warning btn-sm">
                                                                <i class="fas fa-edit"></i> Edit Nilai
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-gray-300 mb-3"></i>
                            <h5 class="text-gray-500">Belum ada hasil rekomendasi</h5>
                            <p class="text-gray-400">Silakan lakukan proses perhitungan SAW terlebih dahulu.</p>
                            <a href="{{ route('saw.index') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Proses SAW
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection