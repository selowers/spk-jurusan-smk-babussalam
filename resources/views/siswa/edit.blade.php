@extends('layouts.app')

@section('title', 'Edit Data Siswa')

@section('content')
<!-- row -->
<div class="row mb-6 g-6">
  <div class="col-12">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-info bg-opacity-10">
        <h5 class="card-title mb-1">Edit Data Siswa</h5>
        <p class="mb-0 small text-muted">Perbarui informasi siswa dengan cepat dan mudah.</p>
      </div>
      <div class="card-body">
        <div class="row gy-4">
          <div class="col-lg-4">
            <div class="border rounded-3 p-4 bg-light h-100">
              <h6 class="text-uppercase text-muted mb-3">Ringkasan Siswa</h6>
              <p class="mb-2"><strong>Nama:</strong><br>{{ $siswa->nama_siswa }}</p>
              <p class="mb-2"><strong>Kelas:</strong><br>{{ $siswa->kelas }}</p>
              <p class="mb-2"><strong>Jurusan:</strong><br>{{ $siswa->jurusan_sekolah }}</p>
              <p class="mb-0"><strong>Tahun:</strong><br>{{ $siswa->tahun_ajaran }}</p>
            </div>
          </div>
          <div class="col-lg-8">
            <form action="{{ route('siswa.update', $siswa->id_siswa) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="row gy-4">
                <div class="col-md-6">
                  <label for="nama_siswa" class="form-label">Nama Siswa</label>
                  <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" id="nama_siswa" name="nama_siswa" value="{{ old('nama_siswa', $siswa->nama_siswa) }}" required>
                  @error('nama_siswa')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="kelas" class="form-label">Kelas</label>
                  <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas" value="{{ old('kelas', $siswa->kelas) }}" required>
                  @error('kelas')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="jurusan_sekolah" class="form-label">Jurusan Sekolah</label>
                  <input type="text" class="form-control @error('jurusan_sekolah') is-invalid @enderror" id="jurusan_sekolah" name="jurusan_sekolah" value="{{ old('jurusan_sekolah', $siswa->jurusan_sekolah) }}" required>
                  @error('jurusan_sekolah')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                  <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran', $siswa->tahun_ajaran) }}" required>
                  @error('tahun_ajaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="mt-4 d-flex flex-column flex-sm-row gap-2">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection