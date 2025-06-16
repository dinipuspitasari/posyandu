<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penimbangan Posyandu</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        table, th, td { border: 1px solid black; border-collapse: collapse; }
        th, td { padding: 4px; text-align: center; }
        h3 { text-align: center; }
    </style>
</head>
<body>

<h3>FORM 1 PENIMBANGAN</h3>
<p><strong>POSYANDU:</strong> GANGGANG<br>
<strong>RT/RW:</strong> 04 / 07<br>
<strong>KELURAHAN:</strong> KOTA BAMBU SELATAN<br>
<strong>KECAMATAN:</strong> PALMERAH<br>
<strong>KOTA:</strong> JAKARTA BARAT</p>

<p><strong>BULAN:</strong> {{ $bulan_nama }} {{ $tahun }}</p>

<h4>A. Data Ibu Hamil, Nifas, dan Buteki</h4>
<ul>
    <li>Jumlah Ibu Hamil: {{ $ibu_hamil }}</li>
    <li>Jumlah Ibu Hamil Dapat Fe: {{ $ibu_hamil_fe }}</li>
    <li>Jumlah Ibu KEK: {{ $ibu_kek }}</li>
    <!-- lanjutkan data lainnya -->
</ul>

<h4>C. Jumlah Balita Ditimbang (0–60 bln)</h4>
<table>
    <thead>
        <tr>
            <th>Kelompok Umur</th>
            <th>Laki-laki</th>
            <th>Perempuan</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>0–6 bulan</td>
            <td>{{ $data['balita']['0_6']['L'] }}</td>
            <td>{{ $data['balita']['0_6']['P'] }}</td>
            <td>{{ $data['balita']['0_6']['L'] + $data['balita']['0_6']['P'] }}</td>
        </tr>
        <tr>
    <td>6–12 bulan</td>
    <td>{{ $data['balita']['6_12']['L'] }}</td>
    <td>{{ $data['balita']['6_12']['P'] }}</td>
    <td>{{ $data['balita']['6_12']['L'] + $data['balita']['6_12']['P'] }}</td>
</tr>
<tr>
    <td>12–24 bulan</td>
    <td>{{ $data['balita']['12_24']['L'] }}</td>
    <td>{{ $data['balita']['12_24']['P'] }}</td>
    <td>{{ $data['balita']['12_24']['L'] + $data['balita']['12_24']['P'] }}</td>
</tr>
<tr>
    <td>24–60 bulan</td>
    <td>{{ $data['balita']['24_60']['L'] }}</td>
    <td>{{ $data['balita']['24_60']['P'] }}</td>
    <td>{{ $data['balita']['24_60']['L'] + $data['balita']['24_60']['P'] }}</td>
</tr>
<tr style="font-weight: bold;">
    <td>Total</td>
    <td>
        {{
            $data['balita']['0_6']['L'] +
            $data['balita']['6_12']['L'] +
            $data['balita']['12_24']['L'] +
            $data['balita']['24_60']['L']
        }}
    </td>
    <td>
        {{
            $data['balita']['0_6']['P'] +
            $data['balita']['6_12']['P'] +
            $data['balita']['12_24']['P'] +
            $data['balita']['24_60']['P']
        }}
    </td>
    <td>
        {{
            array_sum(array_column($data['balita'], 'L')) +
            array_sum(array_column($data['balita'], 'P'))
        }}
    </td>
</tr>

        <!-- ulangi untuk kelompok umur lain -->
    </tbody>
</table>

<!-- Tambahkan bagian lainnya seperti Gizi, Imunisasi, Tanda Tangan -->
<p style="margin-top: 40px; text-align: right;">Jakarta, {{ now()->translatedFormat('d F Y') }}</p>
<p style="text-align: right;">Kader Posyandu</p>
<br><br>
<p style="text-align: right;">(.....................................)</p>

</body>
</html>
