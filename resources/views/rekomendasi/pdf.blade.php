<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Surat Rekomendasi Pemilihan Jurusan - SMK Babussalam</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 10pt;
            line-height: 1.35;
            color: #000;
            background: white;
        }

        @page {
            size: A4 landscape;
            margin-top: 3cm;
            margin-right: 3cm;
            margin-bottom: 3cm;
            margin-left: 4cm;
        }

        /* =============================================
           KOP SURAT
        ============================================= */
        .kop-wrap {
            width: 100%;
            margin-bottom: 0;
        }

        .kop-wrap table {
            width: 100%;
            border-collapse: collapse;
        }

        .kop-wrap table td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }

        .td-logo {
            width: 68pt;
        }

        .td-logo img {
            width: 60pt;
            height: 60pt;
            display: block;
        }

        .td-logo .logo-placeholder {
            width: 60pt;
            height: 60pt;
            border: 1px solid #000;
            font-size: 7pt;
            font-weight: bold;
            text-align: center;
            line-height: 60pt;
        }

        .td-teks {
            text-align: center;
            padding-left: 0;
            padding-right: 0;
        }

        .td-teks .t1 {
            font-size: 11pt;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.3;
        }

        .td-teks .t2 {
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.2;
        }

        .td-teks .t3 {
            font-size: 9pt;
            line-height: 1.45;
            margin-top: 1pt;
        }

        .garis-kop {
            border: none;
            border-top: 3.5px solid #000;
            margin-top: 6pt;
            margin-bottom: 7pt;
        }

        /* =============================================
           JUDUL
        ============================================= */
        .judul {
            text-align: center;
            font-size: 11pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 7pt;
            letter-spacing: 0.2pt;
        }

        /* =============================================
           TABEL DATA
        ============================================= */
        table.tbl {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            font-size: 9.5pt;
        }

        table.tbl th,
        table.tbl td {
            border: 1px solid #000;
            padding: 3pt 5pt;
            vertical-align: middle;
            word-wrap: break-word;
            overflow: hidden;
        }

        table.tbl th {
            text-align: center;
            font-weight: bold;
            background: #fff;
        }

        table.tbl td.c-no     { text-align: center; }
        table.tbl td.c-kelas  { text-align: center; }
        table.tbl td.c-pering { text-align: center; }
        table.tbl td.c-nilai  { text-align: right;  }

        /* baris pertama tiap grup siswa — garis atas lebih tebal */
        table.tbl tr.baris-pertama td {
            border-top: 1.5px solid #000;
        }

        /*
         * PEMBATAS 4 SISWA PER HALAMAN
         * Setiap blok tbody.grup-siswa ke-4 akan diikuti page-break.
         * Karena DomPDF tidak mendukung :nth-child pada tbody,
         * kita gunakan class .page-break-after pada baris terakhir siswa ke-4.
         */
        tr.page-break-after-row {
            page-break-after: always;
        }

        /*
         * Kop & judul diulang di setiap halaman menggunakan
         * thead yang di-repeat (DomPDF mendukung thead repeat).
         * Untuk kop, kita jadikan bagian dari thead atau gunakan
         * pendekatan tabel terpisah per halaman.
         *
         * Karena DomPDF tidak bisa repeat elemen non-thead,
         * solusi terbaik: buat tabel baru tiap 4 siswa,
         * masing-masing punya kop + judul + thead.
         */

        /* =============================================
           BLOK PER HALAMAN
        ============================================= */
        .halaman {
            page-break-after: always;
        }
        /* Halaman terakhir tidak perlu page-break-after */
        .halaman:last-child {
            page-break-after: avoid;
        }

        /* =============================================
           TANDA TANGAN
        ============================================= */
        .ttd-wrap {
            margin-top: 14pt;
            text-align: right;
        }

        .ttd-inner {
            display: inline-block;
            text-align: center;
            min-width: 155pt;
        }

        .ttd-kota  { font-size: 10pt; }
        .ttd-spasi { height: 42pt; }

        .ttd-nama {
            display: inline-block;
            min-width: 150pt;
            border-top: 1px solid #000;
            padding-top: 3pt;
            font-size: 10pt;
            font-weight: bold;
        }

        .ttd-jabatan {
            display: inline-block;
            min-width: 150pt;
            border-top: 1px solid #000;
            padding-top: 3pt;
            font-size: 10pt;
            font-weight: bold;
        }

        @media print {
            body { margin: 0; padding: 0; }
        }
    </style>
</head>
<body>

@php
    $logoPath   = public_path('assets/images/logo-smk-babussalam.png');
    $logoBase64 = '';
    if (file_exists($logoPath)) {
        $logoBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
    }

    /*
     * Ratakan semua baris rekomendasi ke array datar
     * dengan menyertakan info siswa di setiap baris.
     * Kemudian kelompokkan per 4 siswa untuk pagination.
     */
    $grupSiswa   = $hasilSAW; // Collection grouped by id_siswa
    $chunkOf4    = $grupSiswa->chunk(4); // 4 siswa per halaman
    $totalHalaman = $chunkOf4->count();
@endphp

@foreach($chunkOf4 as $halamanIndex => $chunk)
<div class="halaman">

    {{-- ===== KOP SURAT ===== --}}
    <div class="kop-wrap">
        <table>
            <tr>
                <td class="td-logo">
                    @if($logoBase64)
                        <img src="{{ $logoBase64 }}" alt="Logo SMK Babussalam">
                    @else
                        <div class="logo-placeholder">LOGO<br>SMK</div>
                    @endif
                </td>
                <td class="td-teks">
                    <div class="t1">SEKOLAH MENENGAH KEJURUAN</div>
                    <div class="t2">SMK BABUSSALAM</div>
                    <div class="t3"><strong>NSS: 342051825000</strong> &nbsp;&nbsp; <strong>NPSN: 20564083</strong></div>
                    <div class="t3">Jl. K.H Hasyim Asy'ari No 99 Banjarejo Pagelaran Kab. Malang Telp (0341) 874 212</div>
                    <div class="t3">Website: https://www.smkbabussalam.sch.id &nbsp;&nbsp; Email: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="5b283630393a392e28283a373a361b223a33343475383436">[email&#160;protected]</a></div>
                </td>
            </tr>
        </table>
    </div>
    <hr class="garis-kop">

    {{-- ===== JUDUL ===== --}}
    <div class="judul">SURAT REKOMENDASI PEMILIHAN JURUSAN PERGURUAN TINGGI SMK BABUSSALAM</div>

    {{-- ===== TABEL ===== --}}
    <table class="tbl">
        <colgroup>
            <col style="width:4%;">
            <col style="width:18%;">
            <col style="width:8%;">
            <col style="width:37%;">
            <col style="width:13%;">
            <col style="width:20%;">
        </colgroup>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Rekomendasi Jurusan</th>
                <th>Peringkat</th>
                <th>Nilai Preferensi</th>
            </tr>
        </thead>
        <tbody>
            @php
                /*
                 * Nomor urut global: hitung berapa siswa sudah tampil
                 * di halaman-halaman sebelumnya.
                 */
                $nomorAwal = $halamanIndex * 4 + 1;
                $noCounter = $nomorAwal;
            @endphp

            @foreach($chunk as $idSiswa => $hasil)
                @foreach($hasil as $index => $h)
                <tr class="{{ $index === 0 ? 'baris-pertama' : '' }}">
                    <td class="c-no">
                        @if($index === 0) {{ $noCounter }} @else &nbsp; @endif
                    </td>
                    <td>
                        @if($index === 0) {{ $h->siswa->nama_siswa ?? '-' }} @else &nbsp; @endif
                    </td>
                    <td class="c-kelas">
                        @if($index === 0) {{ $h->siswa->kelas ?? '-' }} @else &nbsp; @endif
                    </td>
                    <td>{{ $h->jurusan->nama_jurusan ?? '-' }}</td>
                    <td class="c-pering">{{ $h->peringkat }}</td>
                    <td class="c-nilai">{{ number_format($h->nilai_preferensi, 4) }}</td>
                </tr>
                @endforeach
                @php $noCounter++; @endphp
            @endforeach

            {{-- Jika chunk terisi kurang dari 4 siswa (halaman terakhir), tidak perlu padding --}}
        </tbody>
    </table>

    {{-- ===== TANDA TANGAN (hanya di halaman terakhir) ===== --}}
    @if($halamanIndex === $totalHalaman - 1)
    <div class="ttd-wrap">
        <div class="ttd-inner">
            <div class="ttd-kota">Malang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
            <div class="ttd-spasi"></div>
            <span class="ttd-jabatan">Kepala Sekolah</span>
        </div>
        <div class="ttd-inner">
            <div class="ttd-kota">Malang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
            <div class="ttd-spasi"></div>
            <span class="ttd-jabatan">Guru BK</span>
        </div>
    </div>
    @endif

</div>
@endforeach

</body>
</html>