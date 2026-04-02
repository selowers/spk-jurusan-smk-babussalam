@extends('layouts.app')

@section('title', 'Buat Proses SAW - SPK Jurusan SMK Babussalam')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Buat Proses Perhitungan SAW</h1>
            <p class="mb-0">Pilih siswa yang akan diproses perhitungan rekomendasi jurusan</p>
        </div>
        <a href="{{ route('saw.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <!-- Total Siswa -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Siswa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSiswa }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Kriteria -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Kriteria</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKriteria }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Jurusan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Jurusan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalJurusan }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Data -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Status Data</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <span class="badge badge-success">Siap</span>
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

    <!-- Kriteria Information -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Kriteria</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama Kriteria</th>
                                    <th>Bobot</th>
                                    <th>Tipe</th>
                                    <th>Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kriteria as $k)
                                <tr>
                                    <td>{{ $k->nama_kriteria }}</td>
                                    <td>{{ $k->bobot }}</td>
                                    <td>
                                        <span class="badge badge-{{ $k->tipe == 'benefit' ? 'success' : 'warning' }}">
                                            {{ ucfirst($k->tipe) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($k->tipe == 'benefit')
                                            Semakin tinggi nilai, semakin baik
                                        @else
                                            Semakin rendah nilai, semakin baik
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

    <!-- Form Pilih Siswa -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Pilih Siswa untuk Proses SAW</h6>
                    <div>
                        <button type="button" class="btn btn-sm btn-success" onclick="selectAll()">Pilih Semua</button>
                        <button type="button" class="btn btn-sm btn-warning" onclick="clearSelection()">Hapus Pilihan</button>
                    </div>
                </div>
                <form action="{{ route('saw.proses') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            @foreach($siswa as $s)
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input siswa-checkbox" type="checkbox"
                                                   name="siswa_ids[]" value="{{ $s->id_siswa }}"
                                                   id="siswa_{{ $s->id_siswa }}">
                                            <label class="form-check-label" for="siswa_{{ $s->id_siswa }}">
                                                <strong>{{ $s->nama_siswa }}</strong><br>
                                                <small class="text-muted">
                                                    Kelas: {{ $s->kelas }}<br>
                                                    Jurusan: {{ $s->jurusan_sekolah }}
                                                </small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-calculator"></i> Proses Perhitungan SAW
                        </button>
                        <a href="{{ route('saw.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function selectAll() {
    document.querySelectorAll('.siswa-checkbox').forEach(checkbox => {
        checkbox.checked = true;
    });
}

function clearSelection() {
    document.querySelectorAll('.siswa-checkbox').forEach(checkbox => {
        checkbox.checked = false;
    });
}
</script>
@endsection