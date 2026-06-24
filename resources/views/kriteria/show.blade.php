@extends('layouts.app')

@section('title', 'Detail Kriteria - SMK Babussalam')

@section('content')
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">
            <i class="bi bi-eye text-info me-2"></i>Detail Kriteria
        </h1>
        <p class="text-muted">Informasi lengkap kriteria penilaian</p>
    </div>
    <div>
        <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<!-- Detail Cards -->
<div class="row">
    <!-- Main Info -->
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <h6 class="m-0 font-weight-bold">
                    <i class="bi bi-info-circle me-2"></i>Informasi Kriteria
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">ID Kriteria</label>
                            <div class="form-control-plaintext fw-bold">{{ $kriteria->id_kriteria }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Nama Kriteria</label>
                            <div class="form-control-plaintext fw-bold">{{ $kriteria->nama_kriteria }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Bobot</label>
                            <div class="form-control-plaintext">
                                <span class="badge bg-warning text-dark fs-6">{{ number_format($kriteria->bobot, 3) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Tipe Kriteria</label>
                            <div class="form-control-plaintext">
                                @if($kriteria->tipe == 'benefit')
                                    <span class="badge bg-success fs-6">
                                        <i class="bi bi-graph-up-arrow me-1"></i>Benefit
                                    </span>
                                @else
                                    <span class="badge bg-info fs-6">
                                        <i class="bi bi-graph-down-arrow me-1"></i>Cost
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Dibuat Pada</label>
                            <div class="form-control-plaintext">
                                <i class="bi bi-calendar me-2"></i>{{ $kriteria->created_at->format('d/m/Y H:i:s') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Terakhir Update</label>
                            <div class="form-control-plaintext">
                                <i class="bi bi-calendar-check me-2"></i>{{ $kriteria->updated_at->format('d/m/Y H:i:s') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Data -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-success text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="bi bi-link-45deg me-2"></i>Data Terkait
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-center">
                            <div class="h1 text-success">{{ $kriteria->nilai()->count() }}</div>
                            <div class="text-muted">Data Nilai</div>
                            <small>Jumlah siswa yang memiliki nilai untuk kriteria ini</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center">
                            <div class="h1 text-info">{{ $kriteria->nilai()->distinct('id_siswa')->count() }}</div>
                            <div class="text-muted">Siswa</div>
                            <small>Jumlah siswa unik yang dinilai</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Panel -->
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-primary text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="bi bi-gear me-2"></i>Aksi
                </h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('kriteria.edit', $kriteria) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square me-2"></i>Edit Kriteria
                    </a>
                    <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">
                        <i class="bi bi-list me-2"></i>Lihat Semua Kriteria
                    </a>
                    <a href="{{ route('kriteria.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Kriteria Baru
                    </a>
                </div>

                <hr>
            </div>
        </div>

        <!-- Quick Info -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-info text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="bi bi-lightbulb me-2"></i>Tentang Tipe Kriteria
                </h6>
            </div>
            <div class="card-body">
                @if($kriteria->tipe == 'benefit')
                    <div class="alert alert-success">
                        <strong>Benefit:</strong><br>
                        Kriteria dimana nilai yang lebih tinggi dianggap lebih baik. Contoh: nilai akademik, prestasi, dll.
                    </div>
                @else
                    <div class="alert alert-info">
                        <strong>Cost:</strong><br>
                        Kriteria dimana nilai yang lebih rendah dianggap lebih baik. Contoh: biaya, jarak, waktu, dll.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection