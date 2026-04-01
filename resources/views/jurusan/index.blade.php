@extends('layouts.app')

@section('title', 'Kelola Data Jurusan - SPK Jurusan SMK Babussalam')

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

/* Custom styles for jurusan page */
.jurusan-card {
  transition: all 0.3s ease;
  border-radius: 15px;
  overflow: hidden;
}

.jurusan-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.avatar-initial {
  width: 50px;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  font-size: 1.2rem;
}

/* Action buttons styling */
.btn-group .btn {
  border-radius: 8px !important;
  margin: 0 2px;
  transition: all 0.3s ease;
  border-width: 2px;
}

.btn-group .btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.btn-outline-info:hover {
  background-color: #0dcaf0;
  border-color: #0dcaf0;
  color: white;
}

.btn-outline-warning:hover {
  background-color: #ffc107;
  border-color: #ffc107;
  color: white;
}

.btn-outline-danger:hover {
  background-color: #dc3545;
  border-color: #dc3545;
  color: white;
}

.btn-group .btn:focus {
  box-shadow: none;
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

/* Chart container */
.chart-container {
  position: relative;
  height: 300px;
  width: 100%;
}
</style>
@endsection

@section('content')
<!-- Header Section -->
<div class="row mb-4">
  <div class="col-12">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h1 class="h3 mb-0 text-gray-800">
          <i class="ti ti-building text-primary me-2"></i>Kelola Data Jurusan
        </h1>
        <p class="text-muted mt-1">Kelola data jurusan perguruan tinggi untuk rekomendasi SPK</p>
      </div>
      <a href="{{ route('jurusan.create') }}" class="btn btn-primary">
        <i class="ti ti-plus me-2"></i>Tambah Jurusan
      </a>
    </div>
  </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Total Jurusan
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalJurusan }}</div>
          </div>
          <div class="col-auto">
            <i class="ti ti-building text-primary" style="font-size: 2rem;"></i>
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
              Fakultas Teknik
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $jurusanPerFakultas->where('fakultas', 'Fakultas Teknik')->first()->jumlah ?? 0 }}
            </div>
          </div>
          <div class="col-auto">
            <i class="ti ti-cpu text-success" style="font-size: 2rem;"></i>
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
              Fakultas Ekonomi
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $jurusanPerFakultas->where('fakultas', 'Fakultas Ekonomi')->first()->jumlah ?? 0 }}
            </div>
          </div>
          <div class="col-auto">
            <i class="ti ti-cash text-info" style="font-size: 2rem;"></i>
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
              Fakultas Lainnya
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $totalJurusan - ($jurusanPerFakultas->where('fakultas', 'Fakultas Teknik')->first()->jumlah ?? 0) - ($jurusanPerFakultas->where('fakultas', 'Fakultas Ekonomi')->first()->jumlah ?? 0) }}
            </div>
          </div>
          <div class="col-auto">
            <i class="ti ti-school text-warning" style="font-size: 2rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Alert Messages -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <i class="ti ti-check-circle me-2"></i>{{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <i class="ti ti-alert-circle me-2"></i>{{ session('error') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<!-- Main Content -->
<div class="row">
  <!-- Jurusan Table -->
  <div class="col-12 mb-4">
    <div class="card shadow">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
          <i class="ti ti-building me-2"></i>Daftar Jurusan
        </h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Nama Jurusan</th>
                <th>Fakultas</th>
                <th>Perguruan Tinggi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($jurusan as $index => $item)
              <tr>
                <td>{{ $jurusan->firstItem() + $index }}</td>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="avatar avatar-md me-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                      {{ substr($item->nama_jurusan, 0, 1) }}
                    </div>
                    <div>
                      <div class="font-weight-bold text-dark">{{ $item->nama_jurusan }}</div>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="badge bg-primary">{{ $item->fakultas }}</span>
                </td>
                <td>{{ $item->perguruan_tinggi }}</td>
                <td>
                  <div class="btn-group" role="group">
                    <a href="{{ route('jurusan.show', $item->id_jurusan) }}" class="btn btn-sm btn-outline-info" title="Lihat Detail">
                      <i class="ti ti-eye"></i>
                    </a>
                    <a href="{{ route('jurusan.edit', $item->id_jurusan) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                      <i class="ti ti-edit"></i>
                    </a>
                    <form action="{{ route('jurusan.destroy', $item->id_jurusan) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')">
                        <i class="ti ti-trash"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="text-center py-4">
                  <i class="ti ti-building text-muted" style="font-size: 3rem;"></i>
                  <p class="text-muted mt-2">Belum ada data jurusan</p>
                  <a href="{{ route('jurusan.create') }}" class="btn btn-primary btn-sm">
                    <i class="ti ti-plus me-1"></i>Tambah Jurusan Pertama
                  </a>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        @if($jurusan->hasPages())
        <div class="d-flex justify-content-center mt-4">
          {{ $jurusan->links() }}
        </div>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection