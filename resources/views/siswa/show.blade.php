@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
<!-- row -->
<div class="row mb-6 g-6">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Detail Siswa</h5>
        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
          <i class="ti ti-arrow-left me-2"></i>Kembali
        </a>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <p><strong>Nama Siswa:</strong> {{ $siswa->nama_siswa }}</p>
            <p><strong>Kelas:</strong> {{ $siswa->kelas }}</p>
            <p><strong>Jurusan Sekolah:</strong> {{ $siswa->jurusan_sekolah }}</p>
            <p><strong>Tahun Ajaran:</strong> {{ $siswa->tahun_ajaran }}</p>
            <p><strong>User:</strong> {{ $siswa->user->name ?? 'N/A' }} ({{ $siswa->user->email ?? 'N/A' }})</p>
          </div>
        </div>
        <div class="mt-3">
          <a href="{{ route('siswa.edit', $siswa->id_siswa) }}" class="btn btn-warning">
            <i class="ti ti-edit me-2"></i>Edit
          </a>
          <form action="{{ route('siswa.destroy', $siswa->id_siswa) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
              <i class="ti ti-trash me-2"></i>Hapus
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection