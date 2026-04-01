@extends('layouts.app')

@section('title', 'Tambah Data Siswa')

@section('content')
<!-- row -->
<div class="row mb-6 g-6">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">Tambah Siswa Baru</h5>
      </div>
      <div class="card-body">
        <form action="{{ route('siswa.store') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="nama_siswa" class="form-label">Nama Siswa</label>
              <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" id="nama_siswa" name="nama_siswa" value="{{ old('nama_siswa') }}" required>
              @error('nama_siswa')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="kelas" class="form-label">Kelas</label>
              <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas" value="{{ old('kelas') }}" required>
              @error('kelas')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="jurusan_sekolah" class="form-label">Jurusan Sekolah</label>
              <input type="text" class="form-control @error('jurusan_sekolah') is-invalid @enderror" id="jurusan_sekolah" name="jurusan_sekolah" value="{{ old('jurusan_sekolah') }}" required>
              @error('jurusan_sekolah')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
              <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}" required>
              @error('tahun_ajaran')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="id_user" class="form-label">User</label>
              <select class="form-select @error('id_user') is-invalid @enderror" id="id_user" name="id_user" required>
                <option value="">Pilih User</option>
                @foreach($users as $user)
                  <option value="{{ $user->id }}" {{ old('id_user') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
              </select>
              @error('id_user')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
          <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection