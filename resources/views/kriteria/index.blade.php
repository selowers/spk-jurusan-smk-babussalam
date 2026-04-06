@extends('layouts.app')

@section('title', 'Kelola Data Kriteria - SMK Babussalam')

@section('content')
<!-- Alert Success -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<!-- Alert Error -->
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Kriteria</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKriteria }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-list-check text-primary" style="font-size: 2rem;"></i>
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
                            Benefit</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $benefitCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-graph-up-arrow text-success" style="font-size: 2rem;"></i>
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
                            Cost</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $costCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-graph-down-arrow text-info" style="font-size: 2rem;"></i>
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
                            Total Bobot</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalBobot, 2) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-calculator text-warning" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">
            <i class="bi bi-list-check text-primary me-2"></i>Kelola Data Kriteria
        </h1>
        <p class="text-muted">Kelola kriteria penilaian untuk Sistem Pendukung Keputusan SAW</p>
    </div>
    <a href="{{ route('kriteria.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Kriteria
    </a>
</div>

<!-- Kriteria Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
        <h6 class="m-0 font-weight-bold">
            <i class="bi bi-table me-2"></i>Daftar Kriteria
        </h6>
    </div>
    <div class="card-body">
        @if($kriterias->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot</th>
                        <th>Tipe</th>
                        <th>Dibuat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kriterias as $index => $kriteria)
                    <tr>
                        <td>{{ $kriterias->firstItem() + $index }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-initial bg-primary text-white rounded-circle me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                    {{ strtoupper(substr($kriteria->nama_kriteria, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $kriteria->nama_kriteria }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-warning text-dark">{{ number_format($kriteria->bobot, 3) }}</span>
                        </td>
                        <td>
                            @if($kriteria->tipe == 'benefit')
                                <span class="badge bg-success">
                                    <i class="bi bi-graph-up-arrow me-1"></i>Benefit
                                </span>
                            @else
                                <span class="badge bg-info">
                                    <i class="bi bi-graph-down-arrow me-1"></i>Cost
                                </span>
                            @endif
                        </td>
                        <td>{{ $kriteria->created_at->format('d/m/Y') }}</td>
                        <td class="text-center text-nowrap">
                            <div class="d-flex justify-content-center gap-1 flex-wrap">
                                <a href="{{ route('kriteria.show', $kriteria) }}" class="btn btn-sm btn-primary d-flex align-items-center" title="Lihat Detail">
                                    <i class="bi bi-eye me-1"></i>Detail
                                </a>
                                <a href="{{ route('kriteria.edit', $kriteria) }}" class="btn btn-sm btn-warning d-flex align-items-center" title="Edit">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </a>
                                <form action="{{ route('kriteria.destroy', $kriteria) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus kriteria ini?')">
                                        <i class="bi bi-trash me-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $kriterias->links() }}
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-5">
            <i class="bi bi-list-check text-muted" style="font-size: 4rem;"></i>
            <h4 class="text-muted mt-3">Belum ada data kriteria</h4>
            <p class="text-muted">Tambahkan kriteria penilaian pertama untuk memulai proses SAW.</p>
            <a href="{{ route('kriteria.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Kriteria Pertama
            </a>
        </div>
        @endif
    </div>
</div>
@endsection