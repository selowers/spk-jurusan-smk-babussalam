@extends('layouts.app')

@section('title', 'Edit Kriteria - SMK Babussalam')

@section('content')
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">
            <i class="bi bi-pencil-square text-warning me-2"></i>Edit Kriteria
        </h1>
        <p class="text-muted">Edit data kriteria penilaian</p>
    </div>
    <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>

<!-- Form Card -->
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <h6 class="m-0 font-weight-bold">
                    <i class="bi bi-pencil-square me-2"></i>Form Edit Kriteria
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('kriteria.update', $kriteria) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nama Kriteria -->
                    <div class="mb-3">
                        <label for="nama_kriteria" class="form-label">
                            <i class="bi bi-tag me-2"></i>Nama Kriteria <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('nama_kriteria') is-invalid @enderror"
                               id="nama_kriteria" name="nama_kriteria"
                               value="{{ old('nama_kriteria', $kriteria->nama_kriteria) }}"
                               placeholder="Masukkan nama kriteria"
                               required>
                        @error('nama_kriteria')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Bobot -->
                    <div class="mb-3">
                        <label for="bobot" class="form-label">
                            <i class="bi bi-calculator me-2"></i>Bobot <span class="text-danger">*</span>
                        </label>
                        <input type="number" step="0.001" min="0" max="1" class="form-control @error('bobot') is-invalid @enderror"
                               id="bobot" name="bobot"
                               value="{{ old('bobot', $kriteria->bobot) }}"
                               placeholder="Masukkan bobot (0.0 - 1.0)"
                               required>
                        <div class="form-text">Bobot harus antara 0.000 sampai 1.000</div>
                        @error('bobot')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tipe -->
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-graph-up me-2"></i>Tipe Kriteria <span class="text-danger">*</span>
                        </label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input @error('tipe') is-invalid @enderror"
                                           type="radio" name="tipe" id="benefit" value="benefit"
                                           {{ old('tipe', $kriteria->tipe) == 'benefit' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="benefit">
                                        <span class="badge bg-success me-2">
                                            <i class="bi bi-graph-up-arrow"></i>
                                        </span>
                                        Benefit (Semakin tinggi semakin baik)
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input @error('tipe') is-invalid @enderror"
                                           type="radio" name="tipe" id="cost" value="cost"
                                           {{ old('tipe', $kriteria->tipe) == 'cost' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cost">
                                        <span class="badge bg-info me-2">
                                            <i class="bi bi-graph-down-arrow"></i>
                                        </span>
                                        Cost (Semakin rendah semakin baik)
                                    </label>
                                </div>
                            </div>
                        </div>
                        @error('tipe')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('kriteria.index') }}" class="btn btn-secondary me-2">
                            <i class="bi bi-x-circle me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-circle me-2"></i>Update Kriteria
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Info Panel -->
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-warning text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="bi bi-info-circle me-2"></i>Detail Kriteria
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>ID Kriteria:</strong><br>
                    <span class="badge bg-primary">{{ $kriteria->id_kriteria }}</span>
                </div>
                <div class="mb-3">
                    <strong>Dibuat:</strong><br>
                    <small>{{ $kriteria->created_at->format('d/m/Y H:i') }}</small>
                </div>
                <div class="mb-3">
                    <strong>Terakhir Update:</strong><br>
                    <small>{{ $kriteria->updated_at->format('d/m/Y H:i') }}</small>
                </div>
                <hr>
                <h6>Tentang Edit Kriteria:</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <small>• Pastikan nama kriteria unik</small>
                    </li>
                    <li class="mb-2">
                        <small>• Bobot dapat diubah sesuai kebutuhan</small>
                    </li>
                    <li class="mb-2">
                        <small>• Tipe kriteria mempengaruhi perhitungan SAW</small>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection