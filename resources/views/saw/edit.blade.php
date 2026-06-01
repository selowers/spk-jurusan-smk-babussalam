@extends('layouts.app')

@section('title', 'Edit Nilai SAW - SPK Jurusan SMK Babussalam')

@section('content')
<style>
    .saw-result-table {
        color: #1f2937;
        font-size: 0.95rem;
        border-collapse: collapse;
    }
    .saw-result-table th,
    .saw-result-table td {
        border: 1px solid #d1d5db;
        vertical-align: middle;
    }
    .saw-result-table thead {
        background: #e7f1ff;
        color: #0f172a;
    }
    .saw-result-table thead th {
        font-weight: 700;
        padding: 0.85rem 0.75rem;
    }
    .saw-result-table tbody tr {
        background: #ffffff;
    }
    .saw-result-table tbody tr:nth-child(even) {
        background: #f8fafc;
    }
    .saw-result-table .highlight-row {
        background: #dbeafe;
    }
    .saw-result-table .rank-badge {
        background: #0d6efd;
        color: #fff;
        font-size: 0.98rem;
        padding: 0.45rem 0.75rem;
    }
    .saw-result-table .recommendation-badge {
        font-size: 0.88rem;
        padding: 0.55rem 0.85rem;
    }
</style>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Nilai Siswa</h1>
            <p class="mb-0">Edit nilai kriteria untuk siswa: <strong>{{ $siswa->nama_siswa }}</strong></p>
        </div>
        <div>
            <a href="{{ route('saw.show', $siswa->id_siswa) }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i> Lihat Detail
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
                        <div class="col-md-12">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Edit Nilai -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Edit Nilai Kriteria</h6>
                </div>
                <form action="{{ route('saw.update', $siswa->id_siswa) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            <strong>Petunjuk:</strong> Masukkan nilai antara 0-100 untuk setiap kriteria. Nilai yang lebih tinggi menunjukkan kemampuan yang lebih baik.
                        </div>

                        <div class="row">
                            @foreach($kriteria as $k)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 border-left-{{ $k->tipe == 'benefit' ? 'success' : 'warning' }}">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">
                                            {{ $k->nama_kriteria }}
                                            <span class="badge badge-{{ $k->tipe == 'benefit' ? 'success' : 'warning' }} float-right">
                                                {{ ucfirst($k->tipe) }}
                                            </span>
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nilai_{{ $k->id_kriteria }}">Nilai (Bobot: {{ $k->bobot }})</label>
                                            <input type="number"
                                                   class="form-control"
                                                   id="nilai_{{ $k->id_kriteria }}"
                                                   name="nilai[{{ $k->id_kriteria }}]"
                                                   value="{{ $nilaiSiswa->where('id_kriteria', $k->id_kriteria)->first()->nilai ?? 0 }}"
                                                   min="0"
                                                   max="100"
                                                   required>
                                            <small class="form-text text-muted">
                                                @if($k->tipe == 'benefit')
                                                    Semakin tinggi nilai, semakin baik
                                                @else
                                                    Semakin rendah nilai, semakin baik
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('saw.show', $siswa->id_siswa) }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Preview Hasil SAW Saat Ini -->
    @if($hasilSAW->count() > 0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Hasil SAW Saat Ini</h6>
                </div>
                <div class="card-body">
                    <p class="text-dark small mb-3">Tabel di bawah menunjukkan hasil preferensi SAW yang saat ini tersimpan. Nilai peringkat dan rekomendasi ditampilkan secara jelas untuk membantu Anda memahami urutan jurusan terbaik.</p>
                    <div class="table-responsive">
                        <table class="table saw-result-table">
                            <thead>
                                <tr>
                                    <th class="text-center">Peringkat</th>
                                    <th>Jurusan</th>
                                    <th class="text-center">Nilai Preferensi</th>
                                    <th class="text-center">Rekomendasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hasilSAW->sortBy('peringkat') as $hasil)
                                <tr class="{{ $hasil->peringkat == 1 ? 'highlight-row' : '' }}">
                                    <td class="text-center align-middle">
                                        <span class="rank-badge">
                                            {{ $hasil->peringkat }}
                                        </span>
                                    </td>
                                    <td class="align-middle" style="font-weight: 700; color: #0f172a;">{{ $hasil->jurusan->nama_jurusan }}</td>
                                    <td class="text-center align-middle" style="font-weight: 700; color: #0d3b77;">{{ number_format($hasil->nilai_preferensi, 4) }}</td>
                                    <td class="text-center align-middle">
                                        @if($hasil->peringkat == 1)
                                            <span class="badge bg-primary text-white recommendation-badge">
                                                <i class="fas fa-star"></i> Rekomendasi Utama
                                            </span>
                                        @else
                                            <span class="badge bg-secondary text-white recommendation-badge">
                                                Alternatif {{ $hasil->peringkat }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Perhatian:</strong> Setelah menyimpan perubahan nilai, hasil SAW akan dihitung ulang secara otomatis.
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<script>
// Validasi input nilai
document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('input', function() {
        if (this.value < 0) this.value = 0;
        if (this.value > 100) this.value = 100;
    });
});
</script>
@endsection