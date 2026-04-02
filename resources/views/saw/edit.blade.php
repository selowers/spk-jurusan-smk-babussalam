@extends('layouts.app')

@section('title', 'Edit Nilai SAW - SPK Jurusan SMK Babussalam')

@section('content')
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
                        <div class="col-md-8">
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
                        <div class="col-md-4">
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
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Peringkat</th>
                                    <th>Jurusan</th>
                                    <th>Nilai Preferensi</th>
                                    <th>Rekomendasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hasilSAW->sortBy('peringkat') as $hasil)
                                <tr class="{{ $hasil->peringkat == 1 ? 'table-success' : '' }}">
                                    <td>
                                        <span class="badge badge-{{ $hasil->peringkat == 1 ? 'success' : 'secondary' }}">
                                            #{{ $hasil->peringkat }}
                                        </span>
                                    </td>
                                    <td>{{ $hasil->jurusan->nama_jurusan }}</td>
                                    <td>{{ number_format($hasil->nilai_preferensi, 4) }}</td>
                                    <td>
                                        @if($hasil->peringkat == 1)
                                            <span class="badge badge-success">
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