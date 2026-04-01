@extends('layouts.app')

@section('title', 'Dashboard - SMK Babussalam')

@section('content')
<!-- row -->
<div class="row mb-6 g-6">
  <div class="col-12">
    <div class="bg-gradient-mixed p-8 py-10 rounded-3 p-lg-7">
      <!--heading-->
      <h1 class="fs-3">👋 Selamat Datang di Dashboard SPK Jurusan</h1>
      <p class="mb-0">Sistem Pendukung Keputusan untuk Pemilihan Jurusan di SMK Babussalam.</p>
      <p>Monitor siswa, kelola jurusan, dan dapatkan rekomendasi terbaik.</p>
      <a href="#" class="btn btn-dark">Mulai Analisis</a>
    </div>
  </div>
</div>

<!-- Additional content can be added here -->
<div class="row mb-6 g-6">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">Dashboard Overview</h5>
      </div>
      <div class="card-body">
        <p>Halaman dashboard untuk Sistem Pendukung Keputusan Jurusan SMK Babussalam telah berhasil diintegrasikan dengan template Bootstrap modern.</p>
      </div>
    </div>
  </div>
</div>

<!-- Statistik Siswa -->
<div class="row mb-6 g-6">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">Statistik Siswa</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="table-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Siswa</th>
                <th scope="col">Jurusan</th>
                <th scope="col">Nilai Rata-rata</th>
                <th scope="col">Status</th>
                <th scope="col">Rekomendasi SPK</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Ahmad Fauzi</td>
                <td>Teknik Komputer Jaringan</td>
                <td>85.5</td>
                <td><span class="badge bg-success">Aktif</span></td>
                <td>Teknik Komputer Jaringan</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Siti Nurhaliza</td>
                <td>Akuntansi</td>
                <td>88.2</td>
                <td><span class="badge bg-success">Aktif</span></td>
                <td>Akuntansi</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Budi Santoso</td>
                <td>Teknik Otomotif</td>
                <td>82.1</td>
                <td><span class="badge bg-warning">Pending</span></td>
                <td>Teknik Otomotif</td>
              </tr>
              <tr>
                <th scope="row">4</th>
                <td>Rina Sari</td>
                <td>Tata Boga</td>
                <td>90.3</td>
                <td><span class="badge bg-success">Aktif</span></td>
                <td>Tata Boga</td>
              </tr>
              <tr>
                <th scope="row">5</th>
                <td>Dedi Rahman</td>
                <td>Teknik Elektronika</td>
                <td>87.8</td>
                <td><span class="badge bg-success">Aktif</span></td>
                <td>Teknik Elektronika</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection