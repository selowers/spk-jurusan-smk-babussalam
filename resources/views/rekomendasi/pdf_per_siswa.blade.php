<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Surat Rekomendasi Pemilihan Jurusan - {{ $hasilSAW->first()->siswa->nama_siswa ?? 'Siswa' }}</title>
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

        .judul {
            text-align: center;
            font-size: 10.5pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5pt;
            letter-spacing: 0.2pt;
        }

        .detail-siswa {
            margin-bottom: 10pt;
            width: 100%;
            font-size: 9pt;
        }

        .detail-siswa td {
            padding: 2pt 4pt;
            vertical-align: top;
        }

        .detail-label {
            font-weight: bold;
            width: 120pt;
            padding-right: 8pt;
        }

        .detail-value {
            color: #000;
        }

        table.tbl {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            font-size: 9pt;
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
        table.tbl td.c-nilai  { text-align: right; padding-right: 5pt; }

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
    $siswa = $hasilSAW->first()->siswa;
@endphp

<div class="halaman">
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

    <div class="judul">SURAT REKOMENDASI PEMILIHAN JURUSAN PERGURUAN TINGGI SMK BABUSSALAM</div>

    <table class="detail-siswa">
        <tr>
            <td class="detail-label">Nama Siswa</td>
            <td class="detail-value">{{ $siswa->nama_siswa ?? '-' }}</td>
            <td class="detail-label">Tanggal Cetak</td>
            <td class="detail-value">{{ $tanggalCetak->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="detail-label">Kelas</td>
            <td class="detail-value">{{ $siswa->kelas ?? '-' }}</td>
            <td class="detail-label">Jurusan Sekolah</td>
            <td class="detail-value">{{ $siswa->jurusan_sekolah ?? '-' }}</td>
        </tr>
    </table>

    <table class="tbl" style="margin-top: 10pt;">
        <colgroup>
            <col style="width:6%;">
            <col style="width:44%;">
            <col style="width:20%;">
            <col style="width:15%;">
            <col style="width:15%;">
        </colgroup>
        <thead>
            <tr>
                <th>No.</th>
                <th>Rekomendasi Jurusan</th>
                <th>Fakultas</th>
                <th>Peringkat</th>
                <th>Nilai Preferensi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hasilSAW as $index => $h)
                <tr>
                    <td class="c-no">{{ $index + 1 }}</td>
                    <td>{{ $h->jurusan->nama_jurusan ?? '-' }}</td>
                    <td>{{ $h->jurusan->fakultas ?? '-' }}</td>
                    <td class="c-pering">{{ $h->peringkat }}</td>
                    <td class="c-nilai">{{ number_format($h->nilai_preferensi, 4) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ttd-wrap">
        <table class="ttd-table">
            <tr>
                <td style="width:50%;">&nbsp;</td>
                <td style="width:25%;">
                    <div class="ttd-label">&nbsp;</div>
                    <div class="ttd-label">Kepala Sekolah</div>
                    <div class="ttd-spasi"></div>
                    <span class="ttd-garis"></span>
                    <div class="ttd-label">Muis Robil S.Kom</div>
                </td>
                <td style="width:25%;">
                    <div class="ttd-label">Malang, {{ $tanggalCetak->translatedFormat('d F Y') }}</div>
                    <div class="ttd-label">Guru BK</div>
                    <div class="ttd-spasi"></div>
                    <span class="ttd-garis"></span>
                    <div class="ttd-label">Muhammad Yusuf</div>
                </td>
            </tr>
        </table>
    </div>
</div>

</body>
</html>
