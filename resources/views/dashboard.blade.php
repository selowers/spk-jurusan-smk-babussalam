@extends('layouts.app')

@section('title', 'Dashboard - SPK Jurusan SMK Babussalam')

@section('styles')
<style>
.bg-gradient-primary {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.border-left-primary {
  border-left: 0.25rem solid #4e73df !important;
}

.border-left-success {
  border-left: 0.25rem solid #1cc88a !important;
}

.border-left-info {
  border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
  border-left: 0.25rem solid #f6c23e !important;
}

.text-primary {
  color: #5a5c69 !important;
}

.text-gray-800 {
  color: #5a5c69 !important;
}

.card.shadow {
  box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
}

.card.shadow-sm {
  box-shadow: 0 0.125rem 0.25rem 0 rgba(58, 59, 69, 0.2) !important;
}

.avatar {
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
}

.avatar-sm {
  width: 2rem;
  height: 2rem;
  font-size: 0.75rem;
}

.avatar-md {
  width: 3rem;
  height: 3rem;
  font-size: 1rem;
}

.table-hover tbody tr:hover {
  background-color: rgba(0, 0, 0, 0.075);
}

.progress {
  background-color: #eaecf4;
}

.progress-bar {
  background-color: #4e73df;
}

.card-header {
  background: linear-gradient(135deg, #f8f9fc 0%, #e9ecef 100%);
  border-bottom: 1px solid #e3e6f0;
}

.btn-outline-primary:hover {
  background-color: #4e73df;
  border-color: #4e73df;
}

.font-weight-bold {
  font-weight: 700 !important;
}

.text-xs {
  font-size: 0.7rem;
}

.text-uppercase {
  text-transform: uppercase;
}

/* Timeline Styles */
.timeline {
  position: relative;
  padding-left: 30px;
}

.timeline::before {
  content: '';
  position: absolute;
  left: 15px;
  top: 0;
  bottom: 0;
  width: 2px;
  background: #e9ecef;
}

.timeline-item {
  position: relative;
  margin-bottom: 20px;
}

.timeline-marker {
  position: absolute;
  left: -22px;
  top: 5px;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  border: 2px solid #fff;
  box-shadow: 0 0 0 2px #e9ecef;
}

.timeline-content {
  background: #f8f9fa;
  padding: 10px 15px;
  border-radius: 8px;
  border-left: 3px solid #dee2e6;
}

/* Quick Actions Hover Effects */
.btn-outline-primary:hover, .btn-outline-success:hover, .btn-outline-info:hover, .btn-outline-warning:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  transition: all 0.3s ease;
}

/* Card hover effects */
.card:hover {
  transform: translateY(-2px);
  transition: all 0.3s ease;
}

/* Gradient backgrounds for headers */
.card-header.bg-info {
  background: linear-gradient(135deg, #36b9cc 0%, #2c9faf 100%) !important;
}

.card-header.bg-success {
  background: linear-gradient(135deg, #1cc88a 0%, #17a673 100%) !important;
}

.card-header.bg-warning {
  background: linear-gradient(135deg, #f6c23e 0%, #f4b619 100%) !important;
}
</style>
@endsection

@section('content')
<!-- Welcome Section -->
<div class="row mb-6">
  <div class="col-12">
    <div class="card bg-gradient-primary text-white border-0 shadow-lg">
      <div class="card-body p-5">
        <div class="row align-items-center">
          <div class="col-lg-8">
            <h1 class="h2 font-weight-bold">Selamat Datang di SPK Jurusan Perguruan Tinggi SMK Babussalam</h1>
            <p class="lead">Sistem Pendukung Keputusan untuk membantu memilih jurusan terbaik di SMK Babussalam.</p>
          </div>
          <div class="col-lg-4 text-center">
            <img src="{{ asset('assets/images/smk-babussalam-building.png') }}" alt="Gedung SMK Babussalam" style="width: 100%; max-width: 400px; height: auto; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-6">
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Total Siswa
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSiswa }}</div>
          </div>
          <div class="col-auto">
            <i class="ti ti-users text-primary" style="font-size: 2rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Total Kriteria
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKriteria }}</div>
          </div>
          <div class="col-auto">
            <i class="ti ti-settings text-success" style="font-size: 2rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
              Total Jurusan
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalJurusan }}</div>
          </div>
          <div class="col-auto">
            <i class="ti ti-building text-info" style="font-size: 2rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
              Hasil SPK
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalHasilSAW }}</div>
          </div>
          <div class="col-auto">
            <i class="ti ti-chart-bar text-warning" style="font-size: 2rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Charts Row -->
<div class="row mb-6">
  <!-- Siswa Per Kelas Chart -->
  <div class="col-xl-6 mb-4">
    <div class="card shadow">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
          <i class="ti ti-chart-pie me-2"></i>Distribusi Siswa Per Kelas
        </h6>
      </div>
      <div class="card-body">
        <canvas id="siswaPerKelasChart" width="100%" height="300"></canvas>
      </div>
    </div>
  </div>

  <!-- Siswa Per Tahun Ajaran Chart -->
  <div class="col-xl-6 mb-4">
    <div class="card shadow">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">
          <i class="ti ti-calendar me-2"></i>Siswa Per Tahun Ajaran
        </h6>
      </div>
      <div class="card-body">
        <canvas id="siswaPerTahunChart" width="100%" height="300"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Content Row -->
<div class="row">
  <!-- Kriteria Overview -->
  <div class="col-xl-8 mb-4">
    <div class="card shadow">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">
          <i class="ti ti-settings me-2"></i>Overview Kriteria Penilaian
        </h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="table-light">
              <tr>
                <th>Nama Kriteria</th>
                <th>Bobot</th>
                <th>Tipe</th>
                <th>Persentase</th>
              </tr>
            </thead>
            <tbody>
              @foreach($kriteriaData as $kriteria)
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="avatar avatar-sm me-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                      {{ substr($kriteria->nama_kriteria, 0, 1) }}
                    </div>
                    {{ $kriteria->nama_kriteria }}
                  </div>
                </td>
                <td><span class="badge bg-primary">{{ $kriteria->bobot }}</span></td>
                <td>
                  @if($kriteria->tipe == 'benefit')
                    <span class="badge bg-success">Benefit</span>
                  @else
                    <span class="badge bg-warning">Cost</span>
                  @endif
                </td>
                <td>
                  <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ $kriteria->bobot * 100 }}%" aria-valuenow="{{ $kriteria->bobot * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <small class="text-muted">{{ number_format($kriteria->bobot * 100, 1) }}%</small>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Siswa Terbaru -->
  <div class="col-xl-4 mb-4">
    <div class="card shadow">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-warning">
          <i class="ti ti-users me-2"></i>Siswa Terbaru
        </h6>
      </div>
      <div class="card-body">
        @forelse($siswaTerbaru as $siswa)
        <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
          <div class="avatar avatar-md me-3" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border-radius: 50%; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; font-weight: bold;">
            {{ substr($siswa->nama_siswa, 0, 1) }}
          </div>
          <div class="flex-grow-1">
            <div class="font-weight-bold text-dark">{{ $siswa->nama_siswa }}</div>
            <div class="text-muted small">{{ $siswa->kelas }} • {{ $siswa->tahun_ajaran }}</div>
          </div>
        </div>
        @empty
        <div class="text-center py-4">
          <i class="ti ti-users text-muted" style="font-size: 3rem;"></i>
          <p class="text-muted mt-2">Belum ada data siswa</p>
        </div>
        @endforelse
        <div class="text-center mt-3">
          <a href="{{ route('siswa.index') }}" class="btn btn-outline-primary btn-sm">
            <i class="ti ti-eye me-1"></i>Lihat Semua Siswa
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Tips & Information -->
<div class="row mb-6">
  <div class="col-12">
    <div class="card shadow">
      <div class="card-header bg-light">
        <h6 class="m-0 font-weight-bold text-primary">
          <i class="ti ti-bulb me-2"></i>Tips & Informasi
        </h6>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4 mb-3">
            <div class="d-flex">
              <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; min-width: 40px;">
                <i class="ti ti-users"></i>
              </div>
              <div>
                <h6 class="font-weight-bold mb-1">Kelola Data Siswa</h6>
                <p class="text-muted small mb-0">Pastikan data siswa lengkap dengan nilai kriteria yang akurat untuk hasil SPK yang optimal.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="d-flex">
              <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; min-width: 40px;">
                <i class="ti ti-settings"></i>
              </div>
              <div>
                <h6 class="font-weight-bold mb-1">Konfigurasi Kriteria</h6>
                <p class="text-muted small mb-0">Sesuaikan bobot kriteria sesuai kebutuhan sekolah. Total bobot harus = 1.0.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="d-flex">
              <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; min-width: 40px;">
                <i class="ti ti-calculator"></i>
              </div>
              <div>
                <h6 class="font-weight-bold mb-1">Proses SPK</h6>
                <p class="text-muted small mb-0">Gunakan metode SAW untuk mendapatkan rekomendasi jurusan yang objektif dan akurat.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Siswa Per Kelas Chart
const siswaPerKelasCtx = document.getElementById('siswaPerKelasChart').getContext('2d');
const siswaPerKelasData = @json($siswaPerKelas);

new Chart(siswaPerKelasCtx, {
    type: 'doughnut',
    data: {
        labels: siswaPerKelasData.map(item => item.kelas),
        datasets: [{
            data: siswaPerKelasData.map(item => item.jumlah),
            backgroundColor: [
                '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#6f42c1'
            ],
            hoverBackgroundColor: [
                '#2e59d9', '#17a673', '#2c9faf', '#f4b619', '#e02d1b', '#5a32a3'
            ],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ': ' + context.parsed + ' siswa';
                    }
                }
            }
        }
    }
});

// Siswa Per Tahun Ajaran Chart
const siswaPerTahunCtx = document.getElementById('siswaPerTahunChart').getContext('2d');
const siswaPerTahunData = @json($siswaPerTahunAjaran);

new Chart(siswaPerTahunCtx, {
    type: 'bar',
    data: {
        labels: siswaPerTahunData.map(item => item.tahun_ajaran),
        datasets: [{
            label: 'Jumlah Siswa',
            data: siswaPerTahunData.map(item => item.jumlah),
            backgroundColor: 'rgba(28, 200, 138, 0.8)',
            borderColor: 'rgba(28, 200, 138, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>
@endsection