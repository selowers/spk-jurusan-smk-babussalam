@extends('layouts.app')

@section('title', 'Edit Nilai Kuesioner - ' . $siswa->nama_siswa)

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Informasi Siswa -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Siswa</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Nama Siswa:</strong> {{ $siswa->nama_siswa }}<br>
                            <strong>Kelas:</strong> {{ $siswa->kelas }}<br>
                            <strong>Jurusan Sekolah:</strong> {{ $siswa->jurusan_sekolah }}
                        </div>
                        <div class="col-md-6">
                            <strong>Tahun Ajaran:</strong> {{ $siswa->tahun_ajaran }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Edit Nilai -->
            <div class="card border-warning shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h3 class="card-title">Edit Skor Kuesioner</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <form action="{{ route('nilai.update', $siswa->id_siswa) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body bg-warning bg-opacity-10">
                        <div class="alert alert-warning">
                            <i class="fas fa-info-circle"></i>
                            <strong>Petunjuk:</strong> Edit skor mentah dari kuesioner siswa untuk setiap kriteria.
                            Sistem akan otomatis mengkonversi ke skala 0-100.
                        </div>

                        <div class="row">
                            @foreach($kriteria as $k)
                                @php
                                    $nilaiSiswa = $siswa->nilai->where('id_kriteria', $k->id_kriteria)->first();
                                    $skorMentah = 0;
                                    if ($nilaiSiswa) {
                                        // Reverse calculation to get original score
                                        switch($k->nama_kriteria) {
                                            case 'Pengetahuan Kognitif':
                                                $skorMentah = round(($nilaiSiswa->nilai / 100) * 60);
                                                break;
                                            case 'Minat dan Bakat':
                                                $skorMentah = round(($nilaiSiswa->nilai / 100) * 35);
                                                break;
                                            case 'Psikotes':
                                                $skorMentah = round(($nilaiSiswa->nilai / 100) * 45);
                                                break;
                                        }
                                    }
                                @endphp
                                <div class="col-md-4">
                                    <div class="card border-warning">
                                        <div class="card-header bg-warning text-white">
                                            <h5 class="card-title mb-0">
                                                <i class="fas fa-edit"></i> {{ $k->nama_kriteria }}
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="skor_{{ $k->id_kriteria }}">Skor Mentah</label>
                                                <input type="number"
                                                       class="form-control skor-input"
                                                       id="skor_{{ $k->id_kriteria }}"
                                                       name="skor_{{ $k->id_kriteria }}"
                                                       min="0"
                                                       @if($k->nama_kriteria == 'Pengetahuan Kognitif')
                                                           max="60"
                                                       @elseif($k->nama_kriteria == 'Minat dan Bakat')
                                                           max="35"
                                                       @elseif($k->nama_kriteria == 'Psikotes')
                                                           max="45"
                                                       @endif
                                                       value="{{ old('skor_' . $k->id_kriteria, $skorMentah) }}"
                                                       required>
                                                @error('skor_' . $k->id_kriteria)
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Konfigurasi Kuesioner:</label>
                                                <div class="text-muted">
                                                    @if($k->nama_kriteria == 'Pengetahuan Kognitif')
                                                        <small>12 soal × skala 1-5 = maksimal 60</small>
                                                    @elseif($k->nama_kriteria == 'Minat dan Bakat')
                                                        <small>7 soal × skala 1-5 = maksimal 35</small>
                                                    @elseif($k->nama_kriteria == 'Psikotes')
                                                        <small>9 soal × skala 1-5 = maksimal 45</small>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Nilai Saat Ini (0-100):</label>
                                                <div class="input-group">
                                                    <input type="text"
                                                           class="form-control nilai-konversi"
                                                           id="nilai_{{ $k->id_kriteria }}"
                                                           value="{{ $nilaiSiswa ? $nilaiSiswa->nilai : 0 }}"
                                                           readonly>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Update Nilai
                        </button>
                        <a href="{{ route('nilai.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Fungsi konversi skor ke nilai
    function konversiSkor(namaKriteria, skorMentah) {
        let nilai = 0;
        switch(namaKriteria) {
            case 'Pengetahuan Kognitif':
                nilai = (skorMentah / 60) * 100;
                break;
            case 'Minat dan Bakat':
                nilai = (skorMentah / 35) * 100;
                break;
            case 'Psikotes':
                nilai = (skorMentah / 45) * 100;
                break;
        }
        return nilai.toFixed(2);
    }

    // Event listener untuk input skor
    $('.skor-input').on('input', function() {
        const id = $(this).attr('id').replace('skor_', '');
        const namaKriteria = $(this).closest('.card').find('.card-title').text().trim().replace('✏️ ', '');
        const skorMentah = parseFloat($(this).val()) || 0;

        // Update nilai konversi
        const nilaiKonversi = konversiSkor(namaKriteria, skorMentah);
        $('#nilai_' + id).val(nilaiKonversi);
    });

    // Trigger initial calculation
    $('.skor-input').trigger('input');
});
</script>
@endsection