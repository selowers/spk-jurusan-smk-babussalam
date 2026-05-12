@extends('layouts.app')

@section('title', 'Input Nilai Kuesioner - ' . $siswa->nama_siswa)

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

            <!-- Form Input Nilai -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Input Skor Kuesioner</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <form action="{{ route('nilai.store', $siswa->id_siswa) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            <strong>Petunjuk:</strong> Masukkan total skor mentah dari kuesioner siswa untuk setiap kriteria.
                            Sistem akan otomatis mengkonversi ke skala 0-100.
                        </div>

                        <div class="row">
                            @foreach($kriteria as $k)
                                <div class="col-md-4">
                                    <div class="card border-primary">
                                        <div class="card-header bg-primary text-white">
                                            <h5 class="card-title mb-0">
                                                <i class="fas fa-clipboard-check"></i> {{ $k->nama_kriteria }}
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
                                                       value="{{ old('skor_' . $k->id_kriteria) }}"
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
                                                <label>Nilai Konversi (0-100):</label>
                                                <div class="input-group">
                                                    <input type="text"
                                                           class="form-control nilai-konversi"
                                                           id="nilai_{{ $k->id_kriteria }}"
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
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Simpan Nilai
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
        const namaKriteria = $(this).closest('.card').find('.card-title').text().trim().replace('📋 ', '');
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