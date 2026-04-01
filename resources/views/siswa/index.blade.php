@extends('layouts.app')

@section('title', 'Kelola Data Siswa')

@section('content')
<!-- row -->
<div class="row mb-6 g-6">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Data Siswa</h5>
        <a href="{{ route('siswa.create') }}" class="btn btn-primary">
          <i class="ti ti-plus me-2"></i>Tambah Siswa
        </a>
      </div>
      <div class="card-body">
        @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="table-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Siswa</th>
                <th scope="col">Kelas</th>
                <th scope="col">Jurusan Sekolah</th>
                <th scope="col">Tahun Ajaran</th>
                <th scope="col">User</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($siswa as $item)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $item->nama_siswa }}</td>
                  <td>{{ $item->kelas }}</td>
                  <td>{{ $item->jurusan_sekolah }}</td>
                  <td>{{ $item->tahun_ajaran }}</td>
                  <td>{{ $item->user->name ?? 'N/A' }}</td>
                  <td>
                    <a href="{{ route('siswa.show', $item->id_siswa) }}" class="btn btn-sm btn-info">
                      <i class="ti ti-eye"></i>
                    </a>
                    <a href="{{ route('siswa.edit', $item->id_siswa) }}" class="btn btn-sm btn-warning">
                      <i class="ti ti-edit"></i>
                    </a>
                    <form action="{{ route('siswa.destroy', $item->id_siswa) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        <i class="ti ti-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center">Tidak ada data siswa.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        {{ $siswa->links() }}
      </div>
    </div>
  </div>
</div>
@endsection