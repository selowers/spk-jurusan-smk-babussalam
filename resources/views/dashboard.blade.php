@extends('layouts.app')

@section('title', 'Dashboard - SPK Jurusan SMK Babussalam')

@section('styles')
<style>
.bg-gradient-primary {
  background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
}

.dashboard-hero {
  background: radial-gradient(circle at top left, rgba(255,255,255,0.24), transparent 35%), linear-gradient(135deg, #3730a3 0%, #7c3aed 100%);
  color: #f8fafc;
}

.dashboard-hero .lead {
  color: rgba(248, 250, 252, 0.9);
}

.dashboard-card {
  border: none;
  border-radius: 1.75rem;
  background: linear-gradient(180deg, rgba(255,255,255,0.95) 0%, rgba(249,250,251,0.9) 100%);
  overflow: hidden;
}

.dashboard-card .card-body {
  padding: 1.6rem;
}

.dashboard-card .text-xs {
  letter-spacing: 0.08em;
}

.border-left-primary {
  border-left: 0.35rem solid #2563eb !important;
}

.border-left-success {
  border-left: 0.35rem solid #10b981 !important;
}

.border-left-info {
  border-left: 0.35rem solid #0ea5e9 !important;
}

.border-left-warning {
  border-left: 0.35rem solid #f59e0b !important;
}

.text-primary {
  color: #1d4ed8 !important;
}

.text-gray-800 {
  color: #1f2937 !important;
}

.card.shadow {
  box-shadow: 0 0.75rem 2rem rgba(15, 23, 42, 0.08) !important;
}

.card.shadow-sm {
  box-shadow: 0 0.4rem 0.9rem rgba(15, 23, 42, 0.08) !important;
}

.avatar {
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
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
  background-color: rgba(59, 130, 246, 0.08);
}

.progress {
  background-color: #e0f2fe;
}

.progress-bar {
  background: linear-gradient(135deg, #2563eb 0%, #06b6d4 100%);
}

.card-header {
  background: transparent;
  border-bottom: none;
}

.card-header.bg-success {
  background: linear-gradient(135deg, #14b8a6 0%, #0f766e 100%) !important;
  color: #fff;
}

.card-header.bg-warning {
  background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%) !important;
  color: #1f2937;
}

.btn-outline-primary:hover {
  background-color: #2563eb;
  border-color: #2563eb;
}

.font-weight-bold {
  font-weight: 700 !important;
}

.text-xs {
  font-size: 0.72rem;
}

.text-uppercase {
  text-transform: uppercase;
}

.stats-icon {
  width: 56px;
  height: 56px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 1rem;
  color: #fff;
}

.stats-icon.primary {
  background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);
}

.stats-icon.success {
  background: linear-gradient(135deg, #10b981 0%, #0f766e 100%);
}

.stats-icon.info {
  background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
}

.stats-icon.warning {
  background: linear-gradient(135deg, #f59e0b 0%, #dc2626 100%);
}

.dashboard-total {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
}

.dashboard-total-value {
  font-size: 2.25rem;
  font-weight: 800;
  color: #111827;
  letter-spacing: -0.04em;
}

.dashboard-total-note {
  font-size: 0.84rem;
  color: #6b7280;
}

.dashboard-card-compact {
  background: linear-gradient(180deg, rgba(255,255,255,0.96), rgba(248,250,252,0.92));
}

.dashboard-card-glow {
  position: relative;
  overflow: hidden;
}

.dashboard-card-glow::after {
  content: '';
  position: absolute;
  top: -30px;
  right: -30px;
  width: 120px;
  height: 120px;
  background: rgba(59, 130, 246, 0.18);
  border-radius: 50%;
}

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
  background: #e2e8f0;
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
  box-shadow: 0 0 0 2px #e2e8f0;
}

.timeline-content {
  background: #f8fafc;
  padding: 10px 15px;
  border-radius: 1rem;
  border-left: 3px solid #cbd5e1;
}

/* Quick Actions Hover Effects */
.btn-outline-primary:hover, .btn-outline-success:hover, .btn-outline-info:hover, .btn-outline-warning:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
  transition: all 0.3s ease;
}

/* Card hover effects */
.card:hover {
  transform: translateY(-3px);
  transition: all 0.3s ease;
}

.compact-chart-card {
  max-width: 100%;
  margin: 0 auto;
  border-radius: 1.5rem;
  background: linear-gradient(180deg, #ffffff 0%, #eff6ff 100%);
}

.compact-chart-card .card-body {
  padding: 1rem;
}

.compact-chart-card canvas {
  max-height: 160px !important;
}
</style>
@endsection

@section('content')
<!-- Welcome Section -->
<div class="row mb-6">
  <div class="col-12">
    <div class="card bg-gradient-primary text-white border-0 shadow-lg dashboard-hero">
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
    <div class="card border-left-primary shadow h-100 py-2 dashboard-card dashboard-card-glow">
      <div class="card-body">
        <div class="dashboard-total">
          <div>
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Total Siswa
            </div>
            <div class="dashboard-total-value">{{ $totalSiswa }}</div>
            <div class="dashboard-total-note">Jumlah siswa aktif saat ini</div>
          </div>
          <div class="stats-icon primary">
            <i class="ti ti-users" style="font-size: 1.25rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2 dashboard-card dashboard-card-glow">
      <div class="card-body">
        <div class="dashboard-total">
          <div>
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Total Kriteria
            </div>
            <div class="dashboard-total-value">{{ $totalKriteria }}</div>
            <div class="dashboard-total-note">Jumlah kriteria penilaian yang tersedia</div>
          </div>
          <div class="stats-icon success">
            <i class="ti ti-settings" style="font-size: 1.25rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2 dashboard-card dashboard-card-glow">
      <div class="card-body">
        <div class="dashboard-total">
          <div>
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
              Total Jurusan
            </div>
            <div class="dashboard-total-value">{{ $totalJurusan }}</div>
            <div class="dashboard-total-note">Jurusan yang dapat dipilih oleh siswa</div>
          </div>
          <div class="stats-icon info">
            <i class="ti ti-building" style="font-size: 1.25rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2 dashboard-card dashboard-card-glow">
      <div class="card-body">
        <div class="dashboard-total">
          <div>
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
              Hasil SPK
            </div>
            <div class="dashboard-total-value">{{ $totalHasilSAW }}</div>
            <div class="dashboard-total-note">Jumlah rekomendasi yang sudah dihitung</div>
          </div>
          <div class="stats-icon warning">
            <i class="ti ti-chart-bar" style="font-size: 1.25rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Charts Row -->
<div class="row mb-4 gx-4 gy-4 justify-content-center">
  <!-- Siswa Per Kelas Chart -->
  <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
    <div class="card shadow compact-chart-card">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
          <i class="ti ti-chart-bar me-2"></i>Distribusi Siswa Per Kelas
        </h6>
      </div>
      <div class="card-body">
        <canvas id="siswaPerKelasChart" width="100%" height="150"></canvas>
      </div>
    </div>
  </div>

  <!-- Siswa Per Tahun Ajaran Chart -->
  <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
    <div class="card shadow compact-chart-card">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">
          <i class="ti ti-calendar me-2"></i>Siswa Per Tahun Ajaran
        </h6>
      </div>
      <div class="card-body">
        <canvas id="siswaPerTahunChart" width="100%" height="170"></canvas>
      </div>
    </div>
  </div>

  <!-- Jurusan Rekomendasi Chart -->
  <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
    <div class="card shadow compact-chart-card">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-warning">
          <i class="ti ti-trophy me-2"></i>Jurusan Rekomendasi Terbanyak
        </h6>
      </div>
      <div class="card-body">
        <canvas id="jurusanRekomendasiChart" width="100%" height="180"></canvas>
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
                    <span class="fw-semibold">{{ $kriteria->nama_kriteria }}</span>
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
        <div class="mb-3 pb-3 border-bottom">
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
    type: 'bar',
    data: {
        labels: siswaPerKelasData.map(item => item.kelas),
        datasets: [{
            label: 'Jumlah Siswa',
            data: siswaPerKelasData.map(item => item.jumlah),
            backgroundColor: [
                '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#6f42c1'
            ],
            borderColor: [
                '#2e59d9', '#17a673', '#2c9faf', '#f4b619', '#e02d1b', '#5a32a3'
            ],
            borderWidth: 1,
            borderRadius: 4,
            maxBarThickness: 28,
        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                ticks: {
                    autoSkip: false,
                    maxRotation: 0,
                    minRotation: 0
                }
            },
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
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.dataset.label + ': ' + context.parsed.y + ' siswa';
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
            borderWidth: 1,
            borderRadius: 4,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                beginAtZero: true,
                ticks: {
                    autoSkip: false,
                    maxRotation: 0,
                    minRotation: 0
                }
            },
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

// Jurusan Rekomendasi Chart
const jurusanRekomendasiCtx = document.getElementById('jurusanRekomendasiChart').getContext('2d');
const jurusanRekomendasiData = @json($jurusanRekomendasi);

new Chart(jurusanRekomendasiCtx, {
    type: 'bar',
    data: {
        labels: jurusanRekomendasiData.map(item => item.nama_jurusan),
        datasets: [{
            label: 'Jumlah Siswa',
            data: jurusanRekomendasiData.map(item => item.jumlah),
            backgroundColor: 'rgba(246, 194, 62, 0.8)',
            borderColor: 'rgba(246, 194, 62, 1)',
            borderWidth: 1,
            borderRadius: 4,
            maxBarThickness: 32,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            },
            y: {
                ticks: {
                    autoSkip: false,
                    maxRotation: 45,
                    minRotation: 0
                }
            }
        },
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.dataset.label + ': ' + context.parsed.y + ' siswa';
                    }
                }
            }
        }
    }
});
</script>
@endsection