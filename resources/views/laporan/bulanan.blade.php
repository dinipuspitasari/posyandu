{{-- <!DOCTYPE html>
<html>

<head>
    <title>{{ $judul }}</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2>{{ $judul }}</h2>
    <p>Bulan: {{ $tanggal }}</p>

    <table>
        <thead>
            <tr>
                <th>Nama Anak</th>
                <th>Usia</th>
                <th>Berat Badan</th>
                <th>Tinggi Badan</th>
                <th>Tanggal Posyandu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anak as $a)
                @foreach ($a->perkembangan as $perk)
                    <tr>
                        <td>{{ $a->nama }}</td>
                        <td>{{ $a->usia }} bln</td>
                        <td>{{ $perk->berat_badan }} kg</td>
                        <td>{{ $perk->tinggi_badan }} cm</td>
                        <td>{{ \Carbon\Carbon::parse($perk->tanggal_posyandu)->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>

</html> --}}
