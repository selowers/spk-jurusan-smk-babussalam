@extends('layouts.app')

@section('title', 'Input Nilai Kuesioner Siswa')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Peringatan!</h5>
                    {{ session('warning') }}
                </div>
            @endif

            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body py-4">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                                <div>
                                    <h1 class="h3 mb-1">Input Nilai Kuesioner Siswa</h1>
                                    <p class="text-muted mb-0">Pilih siswa untuk melakukan input atau perbaikan nilai kuesioner dengan cepat.</p>
                                </div>
                                <div class="text-md-end">
                                    <span class="badge bg-primary rounded-pill px-3 py-2">Total Siswa: {{ $siswa->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row gap-2">
                        <div>
                            <h3 class="card-title mb-1">Daftar Siswa</h3>
                            <small class="text-white-75">Tabel menampilkan status lengkap nilai kuesioner siswa untuk memudahkan input.</small>
                        </div>
                        <div>
                            <span class="badge bg-light text-primary">Lengkap: {{ $siswa->where('status_lengkap', true)->count() }}</span>
                            <span class="badge bg-white text-warning ms-2">Belum lengkap: {{ $siswa->where('status_lengkap', false)->count() }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0" id="siswaTable">
                            <thead class="bg-primary" style="color: #ffffff;">
                                <tr>
                                    <th class="py-3" style="color: #ffffff;">No</th>
                                    <th class="py-3" style="color: #ffffff;">Nama Siswa</th>
                                    <th class="py-3" style="color: #ffffff;">Kelas</th>
                                    <th class="py-3" style="color: #ffffff;">Jurusan Sekolah</th>
                                    <th class="py-3" style="color: #ffffff;">Tahun Ajaran</th>
                                    <th class="py-3 text-center" style="color: #ffffff;">Status Nilai</th>
                                    <th class="py-3 text-center" style="color: #ffffff;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($siswa as $index => $s)
                                    <tr class="align-middle">
                                        <td class="fw-semibold">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="fw-semibold">{{ $s->nama_siswa }}</div>
                                            <div class="text-muted small">ID: {{ $s->id_siswa }}</div>
                                        </td>
                                        <td>{{ $s->kelas }}</td>
                                        <td>{{ $s->jurusan_sekolah }}</td>
                                        <td>{{ $s->tahun_ajaran }}</td>
                                        <td class="text-center">
                                            @if($s->status_lengkap)
                                                <span class="badge bg-success rounded-pill px-3 py-2">
                                                    <i class="fas fa-check-circle me-1"></i> Lengkap
                                                </span>
                                            @else
                                                <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                                                    <i class="fas fa-exclamation-triangle me-1"></i> Belum Lengkap
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($s->status_lengkap)
                                                <a href="{{ route('nilai.edit', $s->id_siswa) }}" class="btn btn-sm btn-outline-light text-primary border-white">
                                                    <i class="fas fa-edit me-1"></i>Edit Nilai
                                                </a>
                                            @else
                                                <a href="{{ route('nilai.create', $s->id_siswa) }}" class="btn btn-sm btn-light text-success">
                                                    <i class="fas fa-plus me-1"></i>Input Nilai
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-info-circle fa-2x mb-2"></i>
                                                <div class="fw-semibold">Belum ada data siswa.</div>
                                                <div>Tambahkan siswa terlebih dahulu agar nilai kuesioner dapat diinput.</div>
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
    </section>
</div>

<style>
    #siswaTable thead th {
        border-bottom: 2px solid rgba(255,255,255,0.3);
    }
    #siswaTable tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.08);
    }
    .btn-outline-light {
        background-color: rgba(255,255,255,0.92);
    }
    .btn-outline-light:hover {
        background-color: white;
    }
</style>
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