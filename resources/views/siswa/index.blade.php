@extends('layouts.app')

@section('title', 'Kelola Data Siswa')

@section('content')
<!-- Statistics Row -->
<div class="row mb-4">
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Total Siswa
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $siswa->total() }}</div>
          </div>
          <div class="col-auto">
            <i class="ti ti-users fa-2x text-gray-300"></i>
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
              Aktif
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $siswa->total() }}</div>
          </div>
          <div class="col-auto">
            <i class="ti ti-check-circle fa-2x text-gray-300"></i>
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
              Kelas
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $siswa->unique('kelas')->count() }}</div>
          </div>
          <div class="col-auto">
            <i class="ti ti-school fa-2x text-gray-300"></i>
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
              Tahun Ajaran
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $siswa->unique('tahun_ajaran')->count() }}</div>
          </div>
          <div class="col-auto">
            <i class="ti ti-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Header with Add Button -->
<div class="row mb-4">
  <div class="col-12">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h4 class="mb-0 text-primary">
          <i class="ti ti-users me-2"></i>Data Siswa
        </h4>
        <p class="text-muted mb-0">Kelola data siswa SMK Babussalam</p>
      </div>
      <a href="{{ route('siswa.create') }}" class="btn btn-primary btn-lg shadow-sm">
        <i class="ti ti-plus me-2"></i>Tambah Siswa Baru
      </a>
    </div>
  </div>
</div>

<!-- Success Message -->
@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="ti ti-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

<!-- Siswa Table -->
<div class="row">
  <div class="col-12">
    <div class="card shadow">
      <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
        <h5 class="card-title mb-0">
          <i class="ti ti-table me-2"></i>Daftar Siswa
        </h5>
      </div>
      <div class="card-body">
        <div class="row align-items-center mb-3">
          <div class="col-md-8">
            <form action="{{ route('siswa.index') }}" method="GET" class="row g-2 align-items-center">
              <div class="col-md-8">
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0"><i class="ti ti-search"></i></span>
                  <input type="search" name="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Cari nama, kelas, jurusan, atau tahun ajaran">
                </div>
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-primary">
                  <i class="ti ti-filter me-1"></i>Cari
                </button>
              </div>
              @if(request('search'))
                <div class="col-auto">
                  <a href="{{ route('siswa.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-back-up"></i> Reset
                  </a>
                </div>
              @endif
            </form>
          </div>
          <div class="col-md-4 text-md-end mt-2 mt-md-0">
            <span class="text-muted">Menampilkan <strong>{{ $siswa->count() }}</strong> dari <strong>{{ $siswa->total() }}</strong> siswa</span>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-hover table-borderless align-middle">
            <thead class="table-primary-header text-uppercase small">
              <tr>
                <th class="text-center">No</th>
                <th>Data Siswa</th>
                <th class="text-center">Kelas</th>
                <th>Jurusan Sekolah</th>
                <th class="text-center">Tahun</th>
                <th>Dibuat Oleh</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($siswa as $index => $item)
                <tr class="table-row-hover">
                  <td class="text-center fw-semibold">{{ $siswa->firstItem() + $index }}</td>
                  <td>
                    <div>
                      <div class="fw-semibold mb-1">{{ $item->nama_siswa }}</div>
                      <div class="text-muted small">ID: {{ $item->id_siswa }}</div>
                    </div>
                  </td>
                  <td class="text-center">
                    <span class="badge bg-info text-dark px-3 py-2">{{ $item->kelas }}</span>
                  </td>
                  <td>
                    <div class="fw-semibold">{{ $item->jurusan_sekolah }}</div>
                    <div class="text-muted small">{{ $item->kelas }} • {{ $item->tahun_ajaran }}</div>
                  </td>
                  <td class="text-center">{{ $item->tahun_ajaran }}</td>
                  <td>{{ $item->user->name ?? 'N/A' }}</td>
                  <td class="text-center">
                    <div class="btn-group" role="group" aria-label="Aksi siswa">
                      <a href="{{ route('siswa.show', $item->id_siswa) }}" class="btn btn-sm btn-outline-info" title="Lihat Detail">
                        <i class="ti ti-eye"></i>
                      </a>
                      <a href="{{ route('siswa.edit', $item->id_siswa) }}" class="btn btn-sm btn-outline-warning" title="Edit Data">
                        <i class="ti ti-edit"></i>
                      </a>
                      <form action="{{ route('siswa.destroy', $item->id_siswa) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Data"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa {{ $item->nama_siswa }}?')">
                          <i class="ti ti-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center py-5">
                    <div class="empty-state">
                      <i class="ti ti-users display-4 text-muted mb-3"></i>
                      <h5 class="text-muted">Belum ada data siswa</h5>
                      <p class="text-muted mb-4">Mulai tambahkan data siswa pertama Anda</p>
                      <a href="{{ route('siswa.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-2"></i>Tambah Siswa Pertama
                      </a>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Pagination -->
@if($siswa->hasPages())
  <div class="row mt-4">
    <div class="col-12">
      <div class="d-flex justify-content-center">
        {{ $siswa->links() }}
      </div>
    </div>
  </div>
@endif

<style>
.bg-gradient-primary {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.table-row-hover:hover {
  background-color: #0f78e0 !important;
  transform: translateY(-1px);
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  transition: all 0.2s ease;
}
..table-primary-header {
  background-color: #0d6efd;
}

.table-primary-header th {
  color: #000000;
  border-bottom: none;
}
.avatar-initial {
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  font-size: 16px;
}

.btn-group .btn {
  border-radius: 0.375rem !important;
  margin: 0 1px;
}

.btn-group .btn:first-child {
  border-top-right-radius: 0 !important;
  border-bottom-right-radius: 0 !important;
}

.btn-group .btn:last-child {
  border-top-left-radius: 0 !important;
  border-bottom-left-radius: 0 !important;
}

.btn-group .btn:not(:first-child):not(:last-child) {
  border-radius: 0 !important;
}

.card-header {
  border-bottom: none;
}

.table th {
  border-top: none;
  font-weight: 600;
  text-transform: uppercase;
  font-size: 0.875rem;
  letter-spacing: 0.5px;
}

.table td {
  vertical-align: middle;
}

.empty-state {
  padding: 3rem 0;
}

@media (max-width: 768px) {
  .btn-group {
    flex-direction: column;
  }

  .btn-group .btn {
    margin: 1px 0;
    border-radius: 0.375rem !important;
  }
}
</style>
@endsection