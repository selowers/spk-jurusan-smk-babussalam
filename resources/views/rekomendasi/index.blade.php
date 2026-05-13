@extends('layouts.app')

@section('title', 'Hasil Rekomendasi SAW - SPK Jurusan SMK Babussalam')

@section('content')
<style>
    .hero-card {
        background: linear-gradient(135deg, #4f46e5 0%, #14b8a6 100%);
        color: #fff;
        border-radius: 1rem;
        overflow: hidden;
        position: relative;
    }
    .hero-card::after {
        content: '';
        position: absolute;
        right: -20%;
        top: -20%;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.12);
        border-radius: 50%;
    }
    .hero-card .badge {
        background: rgba(255,255,255,0.18);
        color: #fff;
        border: 1px solid rgba(255,255,255,0.24);
    }
    .table-custom thead {
        background: #0d6efd;
        color: #ffffff;
        border-bottom: 3px solid rgba(255,255,255,0.24);
    }
    .table-custom thead th {
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        border-right: 1px solid rgba(255,255,255,0.18);
    }
    .table-custom tbody tr.table-success td {
        background: rgba(25, 135, 84, 0.12);
        color: #0f5132;
    }
    .table-custom tbody tr.recommended td {
        background: rgba(13, 110, 253, 0.12);
        color: #0d6efd;
    }
    .table-custom tbody tr.standard td,
    .table-custom tbody tr:nth-of-type(even) td {
        background: #ffffff;
        color: #212529;
    }
    .table-custom td,
    .table-custom th {
        vertical-align: middle;
        border-color: rgba(0, 0, 0, 0.08);
        color: #212529;
    }
    .table-custom td strong {
        color: #1f2937;
    }
    .table-custom .badge {
        font-size: 0.75rem;
        font-weight: 700;
    }
    .accordion-button {
        background: #ffffff;
        color: #212529;
        border: 1px solid #dee2e6;
        border-radius: 0.75rem;
        padding: 1rem 1.25rem;
    }
    .accordion-button::after {
        filter: invert(0.4);
    }
    .accordion-button:not(.collapsed) {
        background: #e7f1ff;
        color: #0d6efd;
        box-shadow: none;
    }
    .accordion-button .student-summary {
        flex: 1;
    }
    .accordion-button .student-title {
        font-size: 1rem;
        font-weight: 700;
        color: #0d3b71;
    }
    .accordion-button .student-meta {
        color: #6c757d;
        font-size: 0.9rem;
    }
    .rekomendasi-title {
        color: #0d6efd;
        font-weight: 700;
    }
    .detail-label {
        display: block;
        font-size: 0.8rem;
        letter-spacing: 0.03em;
        text-transform: uppercase;
        color: #6c757d;
        margin-bottom: 0.15rem;
    }
    .detail-value {
        color: #212529;
        font-weight: 700;
        font-size: 1rem;
    }
    .info-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.3rem 0.75rem;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #0d6efd;
        background: rgba(13, 110, 253, 0.1);
        border: 1px solid rgba(13, 110, 253, 0.18);
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
    }
    .card-glow {
        border: 1px solid rgba(79, 70, 229, 0.18);
        box-shadow: 0 16px 35px rgba(79, 70, 229, 0.08);
    }
    .card-glow .card-header {
        background: rgba(255,255,255,0.82);
    }
</style>
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
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card hero-card shadow-lg p-4 mb-4">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="badge mb-3">Ringkasan Rekomendasi</span>
                        
                        <h1 class="h3 fw-bold">Rekomendasi Jurusan Terbaik untuk Siswa SMK Babussalam</h1>
                        <p class="mb-0 text-white-75">Lihat hasil pilihan jurusan dengan informasi prioritas, rekomendasi utama, dan jurusan terpopuler secara instan.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white bg-opacity-10" style="width:100px;height:100px;">
                            <i class="fas fa-compass fa-3x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <!-- Total Siswa dengan Hasil -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-1">
                <div class="card-body py-2">
                    <div class="row gx-0 align-items-center">
                        <div class="col mr-2">
                            <div class="text-xxs font-weight-bold text-primary text-uppercase mb-1">
                                Siswa dengan Hasil</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">{{ $hasilSAW->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-lg text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Rekomendasi -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-1">
                <div class="card-body py-2">
                    <div class="row gx-0 align-items-center">
                        <div class="col mr-2">
                            <div class="text-xxs font-weight-bold text-success text-uppercase mb-1">
                                Total Rekomendasi</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">{{ $hasilSAW->sum(function($hasil) { return $hasil->count(); }) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-lg text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jurusan Paling Populer -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="me-3">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Jurusan Terpopuler</div>
                            <div class="h6 mb-1 font-weight-bold text-gray-800">
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
                                {{ $topJurusan }}
                            </div>
                            <div class="text-muted small">Jurusan dengan rekomendasi utama terbanyak</div>
                        </div>
                        <div class="text-end">
                            <i class="fas fa-trophy fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Sistem -->
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Status Sistem</div>
                            <div>
                                <span class="badge bg-success text-white">Aktif</span>
                            </div>
                        </div>
                        <div>
                            <i class="fas fa-check-circle fa-2x text-warning"></i>
                        </div>
                    </div>
                    <div class="text-muted small mt-2">Sistem berjalan normal</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hasil Rekomendasi -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow card-glow">
                <div class="card-header py-3 bg-transparent border-bottom-0">
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
                                            <div class="d-flex align-items-center w-100 gap-3">
                                                <div class="student-summary">
                                                    <div class="student-title">{{ $siswa->nama_siswa }}</div>
                                                    <div class="student-meta">{{ $siswa->kelas }} • {{ $siswa->jurusan_sekolah }}</div>
                                                </div>
                                                <div class="ms-auto text-end">
                                                    <div class="text-muted small">Rekomendasi Utama</div>
                                                    <span class="badge bg-primary">
                                                        <i class="fas fa-star me-1"></i> {{ $rekomendasiUtama->jurusan->nama_jurusan }}
                                                    </span>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $idSiswa }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="heading{{ $idSiswa }}" data-bs-parent="#hasilAccordion">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h6 class="rekomendasi-title mb-3">Rekomendasi Jurusan</h6>
                                                    <div class="table-responsive">
                                                        <table class="table table-sm table-bordered table-custom table-hover">
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
                                                                <tr class="{{ $h->peringkat == 1 ? 'recommended' : 'standard' }}">
                                                                    <td>
                                                                        <span class="badge bg-{{ $h->peringkat == 1 ? 'primary' : 'secondary' }}">
                                                                            #{{ $h->peringkat }}
                                                                        </span>
                                                                    </td>
                                                                    <td><strong>{{ $h->jurusan->nama_jurusan }}</strong></td>
                                                                    <td><span class="text-secondary">{{ $h->jurusan->fakultas }}</span></td>
                                                                    <td>{{ number_format($h->nilai_preferensi, 4) }}</td>
                                                                    <td>
                                                                        @if($h->peringkat == 1)
                                                                            <span class="badge bg-primary">
                                                                                <i class="fas fa-star me-1"></i> Rekomendasi Utama
                                                                            </span>
                                                                        @else
                                                                            <span class="badge bg-secondary">
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
                                                    <div class="card border-success card-glow h-100">
                                                        <div class="card-header bg-success text-white">
                                                            <h6 class="mb-0"><i class="fas fa-trophy"></i> Rekomendasi Utama</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="mb-3">
                                                                <span class="detail-label">Jurusan</span>
                                                                <div class="detail-value">{{ $rekomendasiUtama->jurusan->nama_jurusan }}</div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <span class="detail-label">Fakultas</span>
                                                                <div class="detail-value">{{ $rekomendasiUtama->jurusan->fakultas }}</div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <span class="detail-label">Kampus</span>
                                                                <div class="detail-value">{{ $rekomendasiUtama->jurusan->perguruan_tinggi }}</div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <span class="detail-label">Nilai Preferensi</span>
                                                                <div class="detail-value text-success">{{ number_format($rekomendasiUtama->nilai_preferensi, 4) }}</div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <span class="info-chip"><i class="fas fa-check-circle"></i> Rekomendasi Utama</span>
                                                            </div>
                                                            <a href="{{ route('saw.show', $siswa->id_siswa) }}" class="btn btn-success btn-sm me-2 mb-2">
                                                                <i class="fas fa-eye"></i> Lihat Detail
                                                            </a>
                                                            <a href="{{ route('saw.edit', $siswa->id_siswa) }}" class="btn btn-warning btn-sm mb-2">
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