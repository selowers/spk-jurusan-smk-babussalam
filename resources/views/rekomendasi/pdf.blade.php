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
            margin: 0;
        }

        /*
         * SOLUSI MARGIN DOMPDF YANG PASTI BEKERJA:
         * Karena DomPDF mengabaikan @page margin dan setOption,
         * margin ditetapkan via padding di .halaman (wrapper per halaman).
         *
         * A4 landscape = 297mm x 210mm
         * Konversi ke px @96dpi: 1mm = 3.7795px
         *   top    3cm = 30mm = 113.39px
         *   right  3cm = 30mm = 113.39px
         *   bottom 3cm = 30mm = 113.39px
         *   left   4cm = 40mm = 151.18px
         *
         * Total lebar konten = 297mm - 4cm - 3cm = 297mm - 70mm = 227mm
         * Total tinggi konten = 210mm - 3cm - 3cm = 210mm - 60mm = 150mm
         */

        .halaman {
            width: 210mm;
            padding-top: 10mm;
            padding-right: 30mm;
            padding-bottom: 10mm;
            padding-left: 40mm;
            page-break-after: auto;
            overflow: visible;
        }

        .halaman:last-child {
            page-break-after: avoid;
        }

        /* =============================================
           KOP SURAT
        ============================================= */
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
            width: 60pt;
        }

        .td-logo img {
            width: 55pt;
            height: 55pt;
            display: block;
        }

        .td-logo .logo-placeholder {
            width: 55pt;
            height: 55pt;
            border: 1px solid #000;
            font-size: 7pt;
            font-weight: bold;
            text-align: center;
            line-height: 55pt;
        }

        .td-teks {
            text-align: center;
        }

        .td-teks .t1 {
            font-size: 11pt;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.3;
        }

        .td-teks .t2 {
            font-size: 15pt;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.2;
        }

        .td-teks .t3 {
            font-size: 8.5pt;
            line-height: 1.4;
            margin-top: 1pt;
        }

        .garis-kop {
            border: none;
            border-top: 3.5px solid #000;
            margin-top: 5pt;
            margin-bottom: 5pt;
        }

        /* =============================================
           JUDUL
        ============================================= */
        .judul {
            text-align: center;
            font-size: 10.5pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5pt;
            letter-spacing: 0.2pt;
        }

        /* =============================================
           TABEL DATA
           No.             :  4%
           Nama Siswa      : 22%
           Kelas           :  7%
           Rekomendasi     : 43%
           Peringkat       :  9%
           Nilai Preferensi: 15%
        ============================================= */
        table.tbl {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            font-size: 9pt;
        }

        table.tbl th,
        table.tbl td {
            border: 1px solid #000;
            padding: 2.5pt 4pt;
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
        table.tbl td.c-nilai  { text-align: right; padding-right: 5pt; }

        table.tbl tr.baris-pertama td {
            border-top: 1.5px solid #000;
        }

        /* =============================================
           TANDA TANGAN
        ============================================= */
        .ttd-wrap {
            margin-top: 10pt;
            width: 100%;
        }

        .ttd-table {
            width: 100%;
            border-collapse: collapse;
        }

        .ttd-table td {
            border: none;
            padding: 0;
            text-align: center;
            vertical-align: top;
        }

        .ttd-label { font-size: 9.5pt; }
        .ttd-spasi { height: 38pt; }

        .ttd-garis {
            display: inline-block;
            min-width: 130pt;
            border-top: 1px solid #000;
            padding-top: 2pt;
            font-size: 9.5pt;
            font-weight: bold;
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

    $chunkOf4     = $hasilSAW->chunk(4);
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
                        <img src="{{ $logoBase64 }}" alt="Logo">
                    @else
                        <div class="logo-placeholder">LOGO<br>SMK</div>
                    @endif
                </td>
                <td class="td-teks">
                    <div class="t1">SEKOLAH MENENGAH KEJURUAN</div>
                    <div class="t2">SMK BABUSSALAM</div>
                    <div class="t3"><strong>NSS: 342051825000</strong> &nbsp;&nbsp; <strong>NPSN: 20564083</strong></div>
                    <div class="t3">Jl. K.H Hasyim Asy'ari No 99 Banjarejo Pagelaran Kab. Malang Telp (0341) 874 212</div>
                    <div class="t3">Website: https://www.smkbabussalam.sch.id &nbsp;&nbsp; Email: smkbabussalam@yahoo.com</div>
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
            <col style="width:22%;">
            <col style="width:7%;">
            <col style="width:43%;">
            <col style="width:9%;">
            <col style="width:15%;">
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
                $noCounter = $halamanIndex * 4 + 1;
            @endphp
            @foreach($chunk as $idSiswa => $hasil)
                @foreach($hasil as $index => $h)
                <tr class="{{ $index === 0 ? 'baris-pertama' : '' }}">
                    @if($index === 0)
                        <td class="c-no" rowspan="5">{{ $noCounter }}</td>
                        <td rowspan="5">{{ $h->siswa->nama_siswa ?? '-' }}</td>
                        <td class="c-kelas" rowspan="5">{{ $h->siswa->kelas ?? '-' }}</td>
                    @endif
                    <td>{{ $h->jurusan->nama_jurusan ?? '-' }}</td>
                    <td class="c-pering">{{ $h->peringkat }}</td>
                    <td class="c-nilai">{{ number_format($h->nilai_preferensi, 4) }}</td>
                </tr>
                @endforeach
                @php $noCounter++; @endphp
            @endforeach
        </tbody>
    </table>

    {{-- ===== TANDA TANGAN (halaman terakhir saja) ===== --}}
    @if($halamanIndex === $totalHalaman - 1)
    <div class="ttd-wrap">
        <table class="ttd-table">
            <tr>
                <td style="width:50%;">&nbsp;</td>
                <td style="width:25%;">
                    <div class="ttd-label">Malang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                    <div class="ttd-label">Kepala Sekolah</div>
                    <div class="ttd-spasi"></div>
                    <span class="ttd-garis">______________________</span>
                </td>
                <td style="width:25%;">
                    <div class="ttd-label">Malang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                    <div class="ttd-label">Guru BK</div>
                    <div class="ttd-spasi"></div>
                    <span class="ttd-garis">______________________</span>
                </td>
            </tr>
        </table>
    </div>
    @endif

</div>{{-- .halaman --}}
@endforeach

</body>
</html>