@extends('layouts.app')

@section('title', 'Proses Perhitungan SAW - SPK Jurusan SMK Babussalam')

@section('styles')
<style>
/* Lines 6-383 omitted */
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px;">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="text-white mb-2">
                                <i class="bi bi-calculator me-2"></i>Proses Perhitungan SAW
                            </h2>
                            <p class="text-white-50 mb-0">Simple Additive Weighting untuk Rekomendasi Jurusan</p>
                        </div>
                        <div class="col-lg-4 text-end">
                            <div class="stats-badge">
                                <span class="badge bg-light text-primary fs-6 px-3 py-2">
                                    <i class="bi bi-graph-up me-1"></i>Metode SAW
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow-sm h-100 border-left-primary" style="border-radius: 15px; background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Siswa
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSiswa }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow-sm h-100 border-left-success" style="border-radius: 15px; background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Kriteria
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKriteria }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-list-check fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow-sm h-100 border-left-info" style="border-radius: 15px; background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Jurusan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalJurusan }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-building fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kriteria Information -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 15px;">
                <div class="card-header" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 15px 15px 0 0;">
                    <h5 class="mb-0">
                        <i class="bi bi-info-circle me-2"></i>Informasi Kriteria & Bobot
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kriteria</th>
                                    <th>Bobot</th>
                                    <th>Tipe</th>
                                    <th>Persentase</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kriteria as $index => $k)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $k->nama_kriteria }}</td>
                                    <td>{{ number_format($k->bobot, 3) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $k->tipe == 'benefit' ? 'success' : 'warning' }}">
                                            {{ ucfirst($k->tipe) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-primary" role="progressbar"
                                                 style="width: {{ ($k->bobot / $kriteria->sum('bobot')) * 100 }}%"
                                                 aria-valuenow="{{ ($k->bobot / $kriteria->sum('bobot')) * 100 }}"
                                                 aria-valuemin="0" aria-valuemax="100">
                                                {{ number_format(($k->bobot / $kriteria->sum('bobot')) * 100, 1) }}%
                                            </div>
                                        </div>
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
            <div class="card shadow-sm" style="border-radius: 15px;">
                <div class="card-header" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 15px 15px 0 0;">
                    <h5 class="mb-0">
                        <i class="bi bi-person-check me-2"></i>Pilih Siswa untuk Perhitungan
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('saw.proses') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Pilih Siswa yang akan diproses:</label>
                                    <div class="row">
                                        @foreach($siswa as $s)
                                        <div class="col-md-4 col-sm-6 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                       name="siswa_ids[]" value="{{ $s->id_siswa }}"
                                                       id="siswa_{{ $s->id_siswa }}">
                                                <label class="form-check-label" for="siswa_{{ $s->id_siswa }}">
                                                    {{ $s->nama_siswa }} ({{ $s->kelas }})
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-secondary me-2" onclick="selectAll()">
                                    <i class="bi bi-check-all me-1"></i>Pilih Semua
                                </button>
                                <button type="button" class="btn btn-outline-secondary me-2" onclick="clearAll()">
                                    <i class="bi bi-x-circle me-1"></i>Hapus Pilihan
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-calculator me-1"></i>Proses Perhitungan SAW
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function selectAll() {
    const checkboxes = document.querySelectorAll('input[name="siswa_ids[]"]');
    checkboxes.forEach(cb => cb.checked = true);
}

function clearAll() {
    const checkboxes = document.querySelectorAll('input[name="siswa_ids[]"]');
    checkboxes.forEach(cb => cb.checked = false);
}
</script>

@endsection