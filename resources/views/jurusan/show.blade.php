@extends('layouts.app')

@section('title', 'Detail Jurusan - SPK Jurusan SMK Babussalam')

@section('styles')
<style>
.bg-gradient-primary {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.card.shadow {
  box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
}

.detail-icon {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
}

.btn-outline-primary:hover {
  background-color: #4e73df;
  border-color: #4e73df;
}

.btn-outline-success:hover {
  background-color: #1cc88a;
  border-color: #1cc88a;
}

.btn-outline-warning:hover {
  background-color: #f6c23e;
  border-color: #f6c23e;
}

.btn-outline-danger:hover {
  background-color: #e74a3b;
  border-color: #e74a3b;
}
</style>
@endsection

@section('content')
<!-- Header Section -->
<div class="row mb-4">
  <div class="col-12">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
      <div class="d-flex align-items-center">
        <a href="{{ route('jurusan.index') }}" class="btn btn-outline-secondary me-3">
          <i class="ti ti-arrow-left"></i>
        </a>
        <div>
          <h1 class="h3 mb-0 text-gray-800">
            <i class="ti ti-building text-primary me-2"></i>Detail Jurusan
          </h1>
          <p class="text-muted mt-1 mb-0">Informasi lengkap jurusan: <strong>{{ $jurusan->nama_jurusan }}</strong></p>
        </div>
      </div>
      <div class="d-flex gap-2">
        <a href="{{ route('jurusan.edit', $jurusan->id_jurusan) }}" class="btn btn-outline-warning">
          <i class="ti ti-edit me-1"></i>Edit Jurusan
        </a>
        <form action="{{ route('jurusan.destroy', $jurusan->id_jurusan) }}" method="POST" class="d-inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')">
            <i class="ti ti-trash me-1"></i>Hapus Jurusan
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Main Content -->
<div class="row justify-content-center">
  <div class="col-12 col-xl-10 mb-4">
    <div class="card shadow-sm border-0">
      <div class="card-header py-3 bg-light">
        <h6 class="m-0 font-weight-bold text-primary mb-0">
          <i class="ti ti-info-circle me-2"></i>Informasi Jurusan
        </h6>
      </div>
      <div class="card-body p-4">
        <div class="row g-4">
          <!-- Nama Jurusan -->
          <div class="col-md-6">
            <div class="d-flex align-items-center">
              <div class="detail-icon bg-primary text-white me-3">
                <i class="ti ti-building"></i>
              </div>
              <div>
                <h6 class="font-weight-bold mb-1">Nama Jurusan</h6>
                <p class="text-muted mb-0">{{ $jurusan->nama_jurusan }}</p>
              </div>
            </div>
          </div>

          <!-- Fakultas -->
          <div class="col-md-6">
            <div class="d-flex align-items-center">
              <div class="detail-icon bg-success text-white me-3">
                <i class="ti ti-school"></i>
              </div>
              <div>
                <h6 class="font-weight-bold mb-1">Fakultas</h6>
                <p class="text-muted mb-0">{{ $jurusan->fakultas }}</p>
              </div>
            </div>
          </div>

          <!-- Perguruan Tinggi -->
          <div class="col-md-6">
            <div class="d-flex align-items-center">
              <div class="detail-icon bg-info text-white me-3">
                <i class="ti ti-university"></i>
              </div>
              <div>
                <h6 class="font-weight-bold mb-1">Perguruan Tinggi</h6>
                <p class="text-muted mb-0">{{ $jurusan->perguruan_tinggi }}</p>
              </div>
            </div>
          </div>

          <!-- Tanggal Dibuat -->
          <div class="col-md-6">
            <div class="d-flex align-items-center">
              <div class="detail-icon bg-warning text-white me-3">
                <i class="ti ti-calendar"></i>
              </div>
              <div>
                <h6 class="font-weight-bold mb-1">Tanggal Dibuat</h6>
                <p class="text-muted mb-0">{{ $jurusan->created_at->format('d M Y, H:i') }}</p>
              </div>
            </div>
          </div>

          <!-- Tanggal Diupdate -->
          <div class="col-md-6">
            <div class="d-flex align-items-center">
              <div class="detail-icon bg-secondary text-white me-3">
                <i class="ti ti-clock"></i>
              </div>
              <div>
                <h6 class="font-weight-bold mb-1">Terakhir Diupdate</h6>
                <p class="text-muted mb-0">{{ $jurusan->updated_at->format('d M Y, H:i') }}</p>
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
<script>
// Print functionality
function printJurusanInfo() {
    window.print();
}

// Add print styles
const printStyles = `
<style media="print">
  .btn, .card-header .btn, .dropdown, .no-print {
    display: none !important;
  }
  .card {
    border: 1px solid #ddd !important;
    box-shadow: none !important;
  }
  body {
    background: white !important;
  }
</style>
`;

// Inject print styles when printing
window.addEventListener('beforeprint', function() {
  document.head.insertAdjacentHTML('beforeend', printStyles);
});
</script>
@endsection