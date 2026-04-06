@extends('layouts.app')

@section('title', 'Input Nilai Kuesioner Siswa')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Input Nilai Kuesioner Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Nilai Kuesioner</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Peringatan!</h5>
                    {{ session('warning') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Siswa</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="siswaTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Jurusan Sekolah</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Status Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($siswa as $index => $s)
                                    <tr class="{{ $s->status_lengkap ? 'table-success' : 'table-warning' }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $s->nama_siswa }}</td>
                                        <td>{{ $s->kelas }}</td>
                                        <td>{{ $s->jurusan_sekolah }}</td>
                                        <td>{{ $s->tahun_ajaran }}</td>
                                        <td>
                                            @if($s->status_lengkap)
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check-circle"></i> Lengkap
                                                </span>
                                            @else
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-exclamation-triangle"></i> Belum Lengkap
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($s->status_lengkap)
                                                <a href="{{ route('nilai.edit', $s->id_siswa) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i> Edit Nilai
                                                </a>
                                            @else
                                                <a href="{{ route('nilai.create', $s->id_siswa) }}" class="btn btn-sm btn-success">
                                                    <i class="fas fa-plus"></i> Input Nilai
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle"></i> Belum ada data siswa.
                                                <a href="{{ route('siswa.create') }}" class="alert-link">Tambah siswa</a> terlebih dahulu.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Informasi Kriteria -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Kriteria & Konfigurasi Kuesioner</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($kriteria as $k)
                            <div class="col-md-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info">
                                        <i class="fas fa-clipboard-check"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">{{ $k->nama_kriteria }}</span>
                                        <span class="info-box-number">Bobot: {{ $k->bobot }}</span>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" style="width: {{ $k->bobot * 100 }}%"></div>
                                        </div>
                                        <span class="progress-description">
                                            @if($k->nama_kriteria == 'Pengetahuan Kognitif')
                                                12 soal, skor maks: 60
                                            @elseif($k->nama_kriteria == 'Minat dan Bakat')
                                                7 soal, skor maks: 35
                                            @elseif($k->nama_kriteria == 'Psikotes')
                                                9 soal, skor maks: 45
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#siswaTable').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#siswaTable_wrapper .col-md-6:eq(0)');
});
</script>
@endsection