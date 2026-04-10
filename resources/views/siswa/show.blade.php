@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
<!-- row -->
<div class="row mb-6 g-6">
  <div class="col-12">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h5 class="card-title mb-1">Detail Siswa</h5>
            <p class="mb-0 small text-white-50">Lihat informasi lengkap siswa dan lakukan perubahan jika perlu.</p>
          </div>
          <a href="{{ route('siswa.index') }}" class="btn btn-light btn-sm">
            <i class="ti ti-arrow-left me-2"></i>Kembali
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="row gy-4">
          <div class="col-lg-4">
            <div class="border rounded-3 p-4 text-center bg-light">
              <h4 class="mb-1 fw-semibold">{{ $siswa->nama_siswa }}</h4>
              <p class="text-muted mb-2">{{ $siswa->kelas }} • {{ $siswa->jurusan_sekolah }}</p>
              <span class="badge bg-primary">Tahun {{ $siswa->tahun_ajaran }}</span>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="row g-3">
              <div class="col-sm-6">
                <div class="bg-white rounded-3 p-3 border">
                  <div class="text-uppercase text-muted small mb-1">Nama Siswa</div>
                  <div class="fw-semibold">{{ $siswa->nama_siswa }}</div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="bg-white rounded-3 p-3 border">
                  <div class="text-uppercase text-muted small mb-1">Kelas</div>
                  <div class="fw-semibold">{{ $siswa->kelas }}</div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="bg-white rounded-3 p-3 border">
                  <div class="text-uppercase text-muted small mb-1">Jurusan Sekolah</div>
                  <div class="fw-semibold">{{ $siswa->jurusan_sekolah }}</div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="bg-white rounded-3 p-3 border">
                  <div class="text-uppercase text-muted small mb-1">Tahun Ajaran</div>
                  <div class="fw-semibold">{{ $siswa->tahun_ajaran }}</div>
                </div>
              </div>
              <div class="col-12">
                <div class="bg-white rounded-3 p-3 border">
                  <div class="text-uppercase text-muted small mb-1">Dibuat Oleh</div>
                  <div class="fw-semibold">{{ $siswa->user->name ?? 'N/A' }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-4 d-flex flex-column flex-sm-row gap-2">
          <a href="{{ route('siswa.edit', $siswa->id_siswa) }}" class="btn btn-warning">
            <i class="ti ti-edit me-2"></i>Edit Data
          </a>
          <form action="{{ route('siswa.destroy', $siswa->id_siswa) }}" method="POST" class="m-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa {{ $siswa->nama_siswa }}?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
              <i class="ti ti-trash me-2"></i>Hapus Data
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection