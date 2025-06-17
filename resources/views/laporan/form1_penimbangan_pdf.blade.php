<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FORM 1 PENIMBANGAN</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 4px;
            text-align: center;
        }

        .header,
        .footer {
            text-align: left;
            margin-bottom: 10px;
        }

        h3,
        h4 {
            text-align: center;
            margin: 10px 0;
        }

        .section-title {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h3>FORMAT HASIL KEGIATAN PENIMBANGAN DI POSYANDU (FORM 1 PENIMBANGAN)</h3>
    <div class="header">
        <p>
            <strong>A. ALAMAT POSYANDU</strong><br><br>
            <span style="display: inline-block; width: 180px;">1. POSYANDU</span>: GANGGANG<br>
            <span style="display: inline-block; width: 180px;">2. LOKASI RT/RW</span>: 04 / 07<br>
            <span style="display: inline-block; width: 180px;">3. KELURAHAN</span>: KOTA BAMBU SELATAN<br>
            <span style="display: inline-block; width: 180px;">4. PUSKESMAS KEL</span>: KOTA BAMBU SELATAN<br>
            <span style="display: inline-block; width: 180px;">5. KECAMATAN</span>: PALMERAH<br>
            <span style="display: inline-block; width: 180px;">6. KOTA ADMINISTRASI</span>: JAKARTA BARAT<br>
            <span style="display: inline-block; width: 180px;">7. JUMLAH KADER</span>:
            {{ \App\Models\Petugas::where('id_level', 2)->count() }}<br>
            <span style="display: inline-block; width: 180px;">8. JUMLAH KADER AKTIF</span>:
            {{ \App\Models\Petugas::where('id_level', 2)->count() }}<br>
            <span style="display: inline-block; width: 180px;">9. NAMA PETUGAS</span>: <br>
            <span style="display: inline-block; width: 180px;">10. BULAN</span>: {{ $bulan_nama }}<br>
            <span style="display: inline-block; width: 180px;">11. TAHUN</span>: {{ $tahun }}
        </p>
    </div>

    {{-- <div class="section-title">B. <b>Ibu hamil</b>, <b>nifas</b> dan <b>buteki</b></div><br>
    (ga di pake karena ini ttg ibu hamil)
    <div style="display: flex;">
        <div style="flex: 1;">
            <div><span style="display: inline-block; width: 260px;">1. Jumlah ibu hamil</span>:
                {{ $rekap['ibu_hamil'] ?? '-' }}</div>
            <div><span style="display: inline-block; width: 260px;">2. Jumlah ibu hamil dapat Fe III (90 tb)</span>:
                {{ $rekap['ibu_hamil_fe'] ?? '-' }}</div>
            <div><span style="display: inline-block; width: 260px;">3. Jumlah ibu hamil KEK (LILA < 23,5)</span>:
                        {{ $rekap['ibu_kek'] ?? '-' }}</div>
            <div><span style="display: inline-block; width: 260px;">4. Jumlah ibu nifas</span>:
                {{ $rekap['ibu_nifas'] ?? '-' }}</div>
            <div><span style="display: inline-block; width: 260px;">5. Jumlah ibu nifas dapat Vit A</span>:
                {{ $rekap['ibu_nifas_vita'] ?? '-' }}</div>
            <div><span style="display: inline-block; width: 260px;">6. Jumlah Buteki dapat Fe</span>:
                {{ $rekap['buteki_fe'] ?? '-' }}</div>
        </div>
    </div><br> --}}

    <table width="100%" style="border: 1px solid black; border-collapse: collapse; font-size: 11px;">
        <thead>
            <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2">URAIAN KEGIATAN</th>
                <th colspan="5">HASIL KEGIATAN/KELOMPOK UMUR</th>
            </tr>
            <tr>
                <th>0–6 bln</th>
                <th>6–12 bln</th>
                <th>12–24 bln</th>
                <th>24–60 bln</th>
                <th>0–60 bln</th>
            </tr>
        </thead>
        <tbody>
            {{-- Kolom C (sudah oke) --}}
            <tr>
                <td>B</td>
                <td style="text-align: left; padding-left: 4px;">
                    <span style="color: black;">Jumlah balita (S)</span>
                </td>
                <td>{{ ($rekap['balita']['0_6']['L'] ?? 0) + ($rekap['balita']['0_6']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['balita']['6_12']['L'] ?? 0) + ($rekap['balita']['6_12']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['balita']['12_24']['L'] ?? 0) + ($rekap['balita']['12_24']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['balita']['24_60']['L'] ?? 0) + ($rekap['balita']['24_60']['P'] ?? 0) }}</td>
                <td>
                    {{ ($rekap['balita']['0_6']['L'] ?? 0) +
                        ($rekap['balita']['0_6']['P'] ?? 0) +
                        ($rekap['balita']['6_12']['L'] ?? 0) +
                        ($rekap['balita']['6_12']['P'] ?? 0) +
                        ($rekap['balita']['12_24']['L'] ?? 0) +
                        ($rekap['balita']['12_24']['P'] ?? 0) +
                        ($rekap['balita']['24_60']['L'] ?? 0) +
                        ($rekap['balita']['24_60']['P'] ?? 0) }}
                </td>
            </tr>
            {{-- Kolom D (tidak dipakai) --}}
            {{-- <tr>
                <td>D</td>
                <td style="text-align: left; padding-left: 4px;">
                    <span style="color: black;">Jumlah balita punya KMS (K)</span>
                </td>
                <td>{{ ($rekap['kms']['0_6']['L'] ?? 0) + ($rekap['kms']['0_6']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['kms']['6_12']['L'] ?? 0) + ($rekap['kms']['6_12']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['kms']['12_24']['L'] ?? 0) + ($rekap['kms']['12_24']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['kms']['24_60']['L'] ?? 0) + ($rekap['kms']['24_60']['P'] ?? 0) }}</td>
                <td>
                    {{ ($rekap['kms']['0_6']['L'] ?? 0) +
                        ($rekap['kms']['0_6']['P'] ?? 0) +
                        ($rekap['kms']['6_12']['L'] ?? 0) +
                        ($rekap['kms']['6_12']['P'] ?? 0) +
                        ($rekap['kms']['12_24']['L'] ?? 0) +
                        ($rekap['kms']['12_24']['P'] ?? 0) +
                        ($rekap['kms']['24_60']['L'] ?? 0) +
                        ($rekap['kms']['24_60']['P'] ?? 0) }}
                </td>
            </tr> --}}
            {{-- Kolom E (sudah oke ubah nama jadi kolom D) --}}
            <tr>
                <td>C</td>
                <td style="text-align: left; padding-left: 4px;">
                    <span style="color: black;">Jumlah balita ditimbang (D)</span>
                </td>
                <td>{{ ($rekap['hadir']['0_6']['L'] ?? 0) + ($rekap['hadir']['0_6']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['hadir']['6_12']['L'] ?? 0) + ($rekap['hadir']['6_12']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['hadir']['12_24']['L'] ?? 0) + ($rekap['hadir']['12_24']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['hadir']['24_60']['L'] ?? 0) + ($rekap['hadir']['24_60']['P'] ?? 0) }}</td>
                <td>
                    {{ ($rekap['hadir']['0_6']['L'] ?? 0) +
                        ($rekap['hadir']['0_6']['P'] ?? 0) +
                        ($rekap['hadir']['6_12']['L'] ?? 0) +
                        ($rekap['hadir']['6_12']['P'] ?? 0) +
                        ($rekap['hadir']['12_24']['L'] ?? 0) +
                        ($rekap['hadir']['12_24']['P'] ?? 0) +
                        ($rekap['hadir']['24_60']['L'] ?? 0) +
                        ($rekap['hadir']['24_60']['P'] ?? 0) }}
                </td>
            </tr>
            {{-- Kolom F (sudah oke ubah nama jadi kolom E) --}}
            <tr>
                <td>D</td>
                <td style="text-align: left; padding-left: 4px;">
                    <span style="color: black;">Hasil Penimbangan dengan rambu</span>
                </td>
                <td></td> <!-- 0–6 -->
                <td></td> <!-- 6–12 -->
                <td></td> <!-- 12–24 -->
                <td></td> <!-- 24–60 -->
                <td></td> <!-- 24–60 -->
            </tr>
            {{-- N (naik berat badan) --}}
            <tr>
                <td></td>
                <td style="text-align: left; padding-left: 4px;">
                    <span style="color: black;">N (naik berat badan)</span>
                </td>
                <td>{{ ($rekap['rambu']['N']['0_6']['L'] ?? 0) + ($rekap['rambu']['N']['0_6']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['N']['6_12']['L'] ?? 0) + ($rekap['rambu']['N']['6_12']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['N']['12_24']['L'] ?? 0) + ($rekap['rambu']['N']['12_24']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['N']['24_60']['L'] ?? 0) + ($rekap['rambu']['N']['24_60']['P'] ?? 0) }}</td>
                <td>
                    {{ ($rekap['rambu']['N']['0_6']['L'] ?? 0) +
                        ($rekap['rambu']['N']['0_6']['P'] ?? 0) +
                        ($rekap['rambu']['N']['6_12']['L'] ?? 0) +
                        ($rekap['rambu']['N']['6_12']['P'] ?? 0) +
                        ($rekap['rambu']['N']['12_24']['L'] ?? 0) +
                        ($rekap['rambu']['N']['12_24']['P'] ?? 0) +
                        ($rekap['rambu']['N']['24_60']['L'] ?? 0) +
                        ($rekap['rambu']['N']['24_60']['P'] ?? 0) }}
                </td>
            </tr>
            {{-- T (tidak/tetap) --}}
            <tr>
                <td></td>
                <td style="text-align: left; padding-left: 4px;">
                    <span style="color: black;">T (tidak/tetap)</span>
                </td>
                <td>{{ ($rekap['rambu']['T']['0_6']['L'] ?? 0) + ($rekap['rambu']['T']['0_6']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['T']['6_12']['L'] ?? 0) + ($rekap['rambu']['T']['6_12']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['T']['12_24']['L'] ?? 0) + ($rekap['rambu']['T']['12_24']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['T']['24_60']['L'] ?? 0) + ($rekap['rambu']['T']['24_60']['P'] ?? 0) }}</td>
                <td>
                    {{ ($rekap['rambu']['T']['0_6']['L'] ?? 0) +
                        ($rekap['rambu']['T']['0_6']['P'] ?? 0) +
                        ($rekap['rambu']['T']['6_12']['L'] ?? 0) +
                        ($rekap['rambu']['T']['6_12']['P'] ?? 0) +
                        ($rekap['rambu']['T']['12_24']['L'] ?? 0) +
                        ($rekap['rambu']['T']['12_24']['P'] ?? 0) +
                        ($rekap['rambu']['T']['24_60']['L'] ?? 0) +
                        ($rekap['rambu']['T']['24_60']['P'] ?? 0) }}
                </td>
            </tr>
            {{-- O (bulan lalu tidak menimbang) --}}
            {{-- <tr>
                <td></td>
                <td style="text-align: left; padding-left: 4px;">
                    <span style="color: black;">O (bulan lalu tidak menimbang)</span>
                </td>
                <td>{{ ($rekap['rambu']['O']['0_6']['L'] ?? 0) + ($rekap['rambu']['O']['0_6']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['O']['6_12']['L'] ?? 0) + ($rekap['rambu']['O']['6_12']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['O']['12_24']['L'] ?? 0) + ($rekap['rambu']['O']['12_24']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['O']['24_60']['L'] ?? 0) + ($rekap['rambu']['O']['24_60']['P'] ?? 0) }}</td>
                <td>
                    {{ ($rekap['rambu']['O']['0_6']['L'] ?? 0) +
                        ($rekap['rambu']['O']['0_6']['P'] ?? 0) +
                        ($rekap['rambu']['O']['6_12']['L'] ?? 0) +
                        ($rekap['rambu']['O']['6_12']['P'] ?? 0) +
                        ($rekap['rambu']['O']['12_24']['L'] ?? 0) +
                        ($rekap['rambu']['O']['12_24']['P'] ?? 0) +
                        ($rekap['rambu']['O']['24_60']['L'] ?? 0) +
                        ($rekap['rambu']['O']['24_60']['P'] ?? 0) }}
                </td>
            </tr> --}}
            {{-- B (baru pertama kali datang) --}}
            <tr>
                <td></td>
                <td style="text-align: left; padding-left: 4px;">
                    <span style="color: black;">B (baru pertama kali datang)</span>
                </td>
                <td>{{ ($rekap['rambu']['B']['0_6']['L'] ?? 0) + ($rekap['rambu']['B']['0_6']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['6_12']['L'] ?? 0) + ($rekap['rambu']['B']['6_12']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['12_24']['L'] ?? 0) + ($rekap['rambu']['B']['12_24']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['24_60']['L'] ?? 0) + ($rekap['rambu']['B']['24_60']['P'] ?? 0) }}</td>
                <td>
                    {{ ($rekap['rambu']['B']['0_6']['L'] ?? 0) +
                        ($rekap['rambu']['B']['0_6']['P'] ?? 0) +
                        ($rekap['rambu']['B']['6_12']['L'] ?? 0) +
                        ($rekap['rambu']['B']['6_12']['P'] ?? 0) +
                        ($rekap['rambu']['B']['12_24']['L'] ?? 0) +
                        ($rekap['rambu']['B']['12_24']['P'] ?? 0) +
                        ($rekap['rambu']['B']['24_60']['L'] ?? 0) +
                        ($rekap['rambu']['B']['24_60']['P'] ?? 0) }}
                </td>
            </tr>
    </table>
    {{-- <tr>
                <td>G</td>
                <td style="text-align: left; padding-left: 4px;">
                    <span style="color: black;">Jumlah balita BGM</span>
                </td>
                <td>{{ ($rekap['rambu']['B']['0_6']['L'] ?? 0) + ($rekap['rambu']['B']['0_6']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['6_12']['L'] ?? 0) + ($rekap['rambu']['B']['6_12']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['12_24']['L'] ?? 0) + ($rekap['rambu']['B']['12_24']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['24_60']['L'] ?? 0) + ($rekap['rambu']['B']['24_60']['P'] ?? 0) }}</td>
                <td>
                    {{ ($rekap['rambu']['B']['0_6']['L'] ?? 0) +
                        ($rekap['rambu']['B']['0_6']['P'] ?? 0) +
                        ($rekap['rambu']['B']['6_12']['L'] ?? 0) +
                        ($rekap['rambu']['B']['6_12']['P'] ?? 0) +
                        ($rekap['rambu']['B']['12_24']['L'] ?? 0) +
                        ($rekap['rambu']['B']['12_24']['P'] ?? 0) +
                        ($rekap['rambu']['B']['24_60']['L'] ?? 0) +
                        ($rekap['rambu']['B']['24_60']['P'] ?? 0) }}
                </td>
            </tr>
            <tr>
                <td>H</td>
                <td style="text-align: left; padding-left: 4px;">
                    <span style="color: black;">Jumlah balita BGM yang dirujuk</span>
                </td>
                <td>{{ ($rekap['rambu']['B']['0_6']['L'] ?? 0) + ($rekap['rambu']['B']['0_6']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['6_12']['L'] ?? 0) + ($rekap['rambu']['B']['6_12']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['12_24']['L'] ?? 0) + ($rekap['rambu']['B']['12_24']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['24_60']['L'] ?? 0) + ($rekap['rambu']['B']['24_60']['P'] ?? 0) }}</td>
                <td>
                    {{ ($rekap['rambu']['B']['0_6']['L'] ?? 0) +
                        ($rekap['rambu']['B']['0_6']['P'] ?? 0) +
                        ($rekap['rambu']['B']['6_12']['L'] ?? 0) +
                        ($rekap['rambu']['B']['6_12']['P'] ?? 0) +
                        ($rekap['rambu']['B']['12_24']['L'] ?? 0) +
                        ($rekap['rambu']['B']['12_24']['P'] ?? 0) +
                        ($rekap['rambu']['B']['24_60']['L'] ?? 0) +
                        ($rekap['rambu']['B']['24_60']['P'] ?? 0) }}
                </td>
            </tr>
            <tr>
                <td>I</td>
                <td style="text-align: left; padding-left: 4px;">
                    <span style="color: black;">Jumlah balita APH (atas pita hitam)</span>
                </td>
                <td>{{ ($rekap['rambu']['B']['0_6']['L'] ?? 0) + ($rekap['rambu']['B']['0_6']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['6_12']['L'] ?? 0) + ($rekap['rambu']['B']['6_12']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['12_24']['L'] ?? 0) + ($rekap['rambu']['B']['12_24']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['24_60']['L'] ?? 0) + ($rekap['rambu']['B']['24_60']['P'] ?? 0) }}</td>
                <td>
                    {{ ($rekap['rambu']['B']['0_6']['L'] ?? 0) +
                        ($rekap['rambu']['B']['0_6']['P'] ?? 0) +
                        ($rekap['rambu']['B']['6_12']['L'] ?? 0) +
                        ($rekap['rambu']['B']['6_12']['P'] ?? 0) +
                        ($rekap['rambu']['B']['12_24']['L'] ?? 0) +
                        ($rekap['rambu']['B']['12_24']['P'] ?? 0) +
                        ($rekap['rambu']['B']['24_60']['L'] ?? 0) +
                        ($rekap['rambu']['B']['24_60']['P'] ?? 0) }}
                </td>
            </tr>
            <tr>
                <td>J</td>
                <td style="text-align: left; padding-left: 4px;">
                    <span style="color: black;">Jumlah balita APH yang dirujuk</span>
                </td>
                <td>{{ ($rekap['rambu']['B']['0_6']['L'] ?? 0) + ($rekap['rambu']['B']['0_6']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['6_12']['L'] ?? 0) + ($rekap['rambu']['B']['6_12']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['12_24']['L'] ?? 0) + ($rekap['rambu']['B']['12_24']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['24_60']['L'] ?? 0) + ($rekap['rambu']['B']['24_60']['P'] ?? 0) }}</td>
                <td>
                    {{ ($rekap['rambu']['B']['0_6']['L'] ?? 0) +
                        ($rekap['rambu']['B']['0_6']['P'] ?? 0) +
                        ($rekap['rambu']['B']['6_12']['L'] ?? 0) +
                        ($rekap['rambu']['B']['6_12']['P'] ?? 0) +
                        ($rekap['rambu']['B']['12_24']['L'] ?? 0) +
                        ($rekap['rambu']['B']['12_24']['P'] ?? 0) +
                        ($rekap['rambu']['B']['24_60']['L'] ?? 0) +
                        ($rekap['rambu']['B']['24_60']['P'] ?? 0) }}
                </td>
            </tr>
            <tr>
                <td>K</td>
                <td style="text-align: left; padding-left: 4px;">
                    <span style="color: black;">Jumlah balita tidak naik berat badan 2x berturut-turut</span>
                </td>
                <td>{{ ($rekap['rambu']['B']['0_6']['L'] ?? 0) + ($rekap['rambu']['B']['0_6']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['6_12']['L'] ?? 0) + ($rekap['rambu']['B']['6_12']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['12_24']['L'] ?? 0) + ($rekap['rambu']['B']['12_24']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['24_60']['L'] ?? 0) + ($rekap['rambu']['B']['24_60']['P'] ?? 0) }}</td>
                <td>
                    {{ ($rekap['rambu']['B']['0_6']['L'] ?? 0) +
                        ($rekap['rambu']['B']['0_6']['P'] ?? 0) +
                        ($rekap['rambu']['B']['6_12']['L'] ?? 0) +
                        ($rekap['rambu']['B']['6_12']['P'] ?? 0) +
                        ($rekap['rambu']['B']['12_24']['L'] ?? 0) +
                        ($rekap['rambu']['B']['12_24']['P'] ?? 0) +
                        ($rekap['rambu']['B']['24_60']['L'] ?? 0) +
                        ($rekap['rambu']['B']['24_60']['P'] ?? 0) }}
                </td>
            </tr>
            <tr>
                <td>L</td>
                <td style="text-align: left; padding-left: 4px;">
                    <span style="color: black;">Jumlah balita tidak naik berat badan 2x berturut-turut dirujuk</span>
                </td>
                <td>{{ ($rekap['rambu']['B']['0_6']['L'] ?? 0) + ($rekap['rambu']['B']['0_6']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['6_12']['L'] ?? 0) + ($rekap['rambu']['B']['6_12']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['12_24']['L'] ?? 0) + ($rekap['rambu']['B']['12_24']['P'] ?? 0) }}</td>
                <td>{{ ($rekap['rambu']['B']['24_60']['L'] ?? 0) + ($rekap['rambu']['B']['24_60']['P'] ?? 0) }}</td>
                <td>
                    {{ ($rekap['rambu']['B']['0_6']['L'] ?? 0) +
                        ($rekap['rambu']['B']['0_6']['P'] ?? 0) +
                        ($rekap['rambu']['B']['6_12']['L'] ?? 0) +
                        ($rekap['rambu']['B']['6_12']['P'] ?? 0) +
                        ($rekap['rambu']['B']['12_24']['L'] ?? 0) +
                        ($rekap['rambu']['B']['12_24']['P'] ?? 0) +
                        ($rekap['rambu']['B']['24_60']['L'] ?? 0) +
                        ($rekap['rambu']['B']['24_60']['P'] ?? 0) }}
                </td>
            </tr>
        </tbody>
    </table> --}}
    <br>
    {{-- M judul (sudah oke) --}}
    <table width="100%" style="border: 1px solid black; border-collapse: collapse; font-size: 11px;">
        <tr>
            <td><strong>E</strong></td>
            <td style="text-align: left; padding-left: 4px;">
                <strong><span style="color: black;">Jumlah bayi dan balita dapat Vit A</span></strong>
            </td>
            <td><strong>L</strong></td>
            <td><strong>P</strong></td>
        </tr>
        <tr>
            <td>1.</td>
            <td style="text-align: left; padding-left: 4px;">
                <span style="color: black;">Jumlah bayi (6–11 bulan) dapat Vitamin A Biru</span>
            </td>
            <td>{{ $rekap['vit_a']['6_12']['L'] ?? 0 }}</td>
            <td>{{ $rekap['vit_a']['6_12']['P'] ?? 0 }}</td>
        </tr>
        <tr>
            <td>2.</td>
            <td style="text-align: left; padding-left: 4px;">
                <span style="color: black;">Jumlah balita (12–59 bulan) dapat Vitamin A Merah</span>
            </td>
            <td>{{ ($rekap['vit_a']['12_24']['L'] ?? 0) + ($rekap['vit_a']['24_60']['L'] ?? 0) }}</td>
            <td>{{ ($rekap['vit_a']['12_24']['P'] ?? 0) + ($rekap['vit_a']['24_60']['P'] ?? 0) }}</td>
        </tr>
    </table>
    <br>
    {{-- N judul (sudah oke) --}}
    <table width="100%" style="border: 1px solid black; border-collapse: collapse; font-size: 11px;">
        <tr>
            <td><strong>F</strong></td>
            <td style="text-align: left; padding-left: 4px;">
                <strong><span style="color: black;">Bayi 0 - 6 bulan mendapat ASI Eksklusif</span></strong>
            </td>
            <td><strong>L</strong></td>
            <td><strong>P</strong></td>
        </tr>
        <tr>
            <td>1.</td>
            <td style="text-align: left; padding-left: 4px;">
                <span style="color: black;">Jumlah bayi (0 - 6 bulan) yang masih diberi ASI saja</span>
            </td>
            <td>{{ $rekap['asi_eksklusif']['0_6']['L'] ?? 0 }}</td>
            <td>{{ $rekap['asi_eksklusif']['0_6']['P'] ?? 0 }}</td>
        </tr>
        <tr>
            <td>2.</td>
            <td style="text-align: left; padding-left: 4px;">
                <span style="color: black;">Jumlah bayi (0 - 6 bulan) yang sudah diberi makan</span>
            </td>
            <td>
                {{ ($rekap['hadir']['0_6']['L'] ?? 0) - ($rekap['asi_eksklusif']['0_6']['L'] ?? 0) }}
            </td>
            <td>
                {{ ($rekap['hadir']['0_6']['P'] ?? 0) - ($rekap['asi_eksklusif']['0_6']['P'] ?? 0) }}
            </td>
        </tr>

        {{-- kayanya ini ga perlu deh soalnya bingung ngambil datanya dimana --}}
        {{-- <tr>
            <td>3.</td>
            <td style="text-align: left; padding-left: 4px;">
                <span style="color: black;">Jumlah bayi (0 - 6 bulan) yang tidak datang menimbang</span>
            </td>
            <td>-</td>
            <td>-</td>
        </tr> --}}
    </table>

    {{-- O. Judul --}}
    {{-- <br>
    <p><strong>O. Status Gizi balita (Berdasarkan KMS)</strong></p>
    <table width="100%" style="border: 1px solid black; border-collapse: collapse; font-size: 11px;">
        <thead>
            <tr>
                <th rowspan="3" style="width: 5%;">NO</th>
                <th rowspan="3">STATUS GIZI</th>
                <th colspan="10">HASIL KEGIATAN / KELOMPOK UMUR</th>
            </tr>
            <tr>
                <th colspan="2">0–6 bln</th>
                <th colspan="2">6–12 bln</th>
                <th colspan="2">12–24 bln</th>
                <th colspan="2">24–60 bln</th>
                <th colspan="2">0–60 bln</th>
            </tr>
            <tr>
                @for ($i = 0; $i < 5; $i++)
                    <th style="width: 5%;">L</th>
                    <th style="width: 5%;">P</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @php
                $statusGizi = [
                    ['no' => 1, 'label' => 'Balita gizi lebih  (GL)', 'key' => 'GL'],
                    ['no' => 2, 'label' => 'Balita Gizi Baik (H)', 'key' => 'H'],
                    ['no' => 3, 'label' => 'Balita Gizi Kurang (K)', 'key' => 'K'],
                    ['no' => 4, 'label' => 'Balita BGM (M)', 'key' => 'M'],
                ];

                $ranges = ['0_6', '6_12', '12_24', '24_60'];
            @endphp

            @foreach ($statusGizi as $item)
                <tr>
                    <td>{{ $item['no'] }}</td>
                    <td style="text-align: left; padding-left: 4px;">{!! $item['label'] !!}</td>
                    @foreach ($ranges as $range)
                        <td>{{ $rekap['status_gizi'][$item['key']][$range]['L'] ?? 0 }}</td>
                        <td>{{ $rekap['status_gizi'][$item['key']][$range]['P'] ?? 0 }}</td>
                    @endforeach
                    <td>
                        {{ array_sum([
                            $rekap['status_gizi'][$item['key']]['0_6']['L'] ?? 0,
                            $rekap['status_gizi'][$item['key']]['6_12']['L'] ?? 0,
                            $rekap['status_gizi'][$item['key']]['12_24']['L'] ?? 0,
                            $rekap['status_gizi'][$item['key']]['24_60']['L'] ?? 0,
                        ]) }}
                    </td>
                    <td>
                        {{ array_sum([
                            $rekap['status_gizi'][$item['key']]['0_6']['P'] ?? 0,
                            $rekap['status_gizi'][$item['key']]['6_12']['P'] ?? 0,
                            $rekap['status_gizi'][$item['key']]['12_24']['P'] ?? 0,
                            $rekap['status_gizi'][$item['key']]['24_60']['P'] ?? 0,
                        ]) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}

    {{-- P judul --}}
    <br>
    <table style="width: 100%; border-collapse: collapse;" border="1">
        <tr>
            <th style="width: 6%; text-align: center;">No</th>
            <th style="text-align: left;">Catatan Imunisasi</th>
            <th style="width: 5%; text-align: center;">L</th>
            <th style="width: 5%; text-align: center;">P</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1.</td>
            <td style="text-align: left;">Jumlah bayi imunisasi BCG</td>
            <td style="text-align: center;">{{ $rekap['imunisasi']['0_6']['L'] ?? 0 }}</td>
            <td style="text-align: center;">{{ $rekap['imunisasi']['0_6']['P'] ?? 0 }}</td>
        </tr>
        <tr>
            <td>2.</td>
            <td style="text-align: left;">Jumlah bayi imunisasi Combo 1</td>
            <td style="text-align: center;">{{ $rekap['imunisasi']['6_12']['L'] ?? 0 }}</td>
            <td style="text-align: center;">{{ $rekap['imunisasi']['6_12']['P'] ?? 0 }}</td>
        </tr>
        <tr>
            <td>3.</td>
            <td style="text-align: left;">Jumlah bayi imunisasi Combo 2</td>
            <td style="text-align: center;">
                {{ ($rekap['imunisasi']['12_24']['L'] ?? 0) + ($rekap['imunisasi']['24_60']['L'] ?? 0) }}
            </td>
            <td style="text-align: center;">
                {{ ($rekap['imunisasi']['12_24']['P'] ?? 0) + ($rekap['imunisasi']['24_60']['P'] ?? 0) }}
            </td>
        </tr>
        <tr>
            <td>4.</td>
            <td style="text-align: left;">Jumlah bayi imunisasi Combo 3</td>
            <td style="text-align: center;">
                {{ ($rekap['imunisasi']['12_24']['L'] ?? 0) + ($rekap['imunisasi']['24_60']['L'] ?? 0) }}
            </td>
            <td style="text-align: center;">
                {{ ($rekap['imunisasi']['12_24']['P'] ?? 0) + ($rekap['imunisasi']['24_60']['P'] ?? 0) }}
            </td>
        </tr>
           <tr>
            <td>5.</td>
            <td style="text-align: left;">Jumlah bayi imunisasi Polio 1</td>
            <td style="text-align: center;">
                {{ ($rekap['imunisasi']['12_24']['L'] ?? 0) + ($rekap['imunisasi']['24_60']['L'] ?? 0) }}
            </td>
            <td style="text-align: center;">
                {{ ($rekap['imunisasi']['12_24']['P'] ?? 0) + ($rekap['imunisasi']['24_60']['P'] ?? 0) }}
            </td>
        </tr>
        <tr>
            <td>6.</td>
            <td style="text-align: left;">Jumlah bayi imunisasi Polio 2</td>
            <td style="text-align: center;">
                {{ ($rekap['imunisasi']['12_24']['L'] ?? 0) + ($rekap['imunisasi']['24_60']['L'] ?? 0) }}
            </td>
            <td style="text-align: center;">
                {{ ($rekap['imunisasi']['12_24']['P'] ?? 0) + ($rekap['imunisasi']['24_60']['P'] ?? 0) }}
            </td>
        </tr>
         <tr>
            <td>7.</td>
            <td style="text-align: left;">Jumlah bayi imunisasi Polio 3</td>
            <td style="text-align: center;">
                {{ ($rekap['imunisasi']['12_24']['L'] ?? 0) + ($rekap['imunisasi']['24_60']['L'] ?? 0) }}
            </td>
            <td style="text-align: center;">
                {{ ($rekap['imunisasi']['12_24']['P'] ?? 0) + ($rekap['imunisasi']['24_60']['P'] ?? 0) }}
            </td>
        </tr>
         <tr>
            <td>8.</td>
            <td style="text-align: left;">Jumlah bayi imunisasi Polio 4</td>
            <td style="text-align: center;">
                {{ ($rekap['imunisasi']['12_24']['L'] ?? 0) + ($rekap['imunisasi']['24_60']['L'] ?? 0) }}
            </td>
            <td style="text-align: center;">
                {{ ($rekap['imunisasi']['12_24']['P'] ?? 0) + ($rekap['imunisasi']['24_60']['P'] ?? 0) }}
            </td>
        </tr>
          <tr>
            <td>9.</td>
            <td style="text-align: left;">Jumlah bayi imunisasi Campak</td>
            <td style="text-align: center;">
                {{ ($rekap['imunisasi']['12_24']['L'] ?? 0) + ($rekap['imunisasi']['24_60']['L'] ?? 0) }}
            </td>
            <td style="text-align: center;">
                {{ ($rekap['imunisasi']['12_24']['P'] ?? 0) + ($rekap['imunisasi']['24_60']['P'] ?? 0) }}
            </td>
        </tr>
    </table>
    <br>
    {{-- Q Judul --}}
    <p><strong>Q. Catatan Lain</strong></p>

    <!-- Tanda Tangan -->
    <div style="width: 100%; text-align: right; margin-top:50px; font-size: 11px;">
        <p style="margin-bottom: 40px;">
            Jakarta, {{ now()->translatedFormat('d F Y') }}<br>
            Kader Posyandu
        </p>
        <p style="margin-top: 60px;">
            <span>Yossi Eka Ashfi</span>
        </p>
    </div>

</body>

</html>