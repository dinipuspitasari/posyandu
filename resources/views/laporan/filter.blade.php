{{-- <!DOCTYPE html>
<html>
<head>
    <title>Filter Laporan Bulanan</title>
</head>
<body>
    <h2>Filter Laporan Bulanan</h2>

    <form action="{{ route('laporan.bulanan.pdf') }}" method="GET" target="_blank">
        <label for="bulan">Bulan:</label>
        <select name="bulan" id="bulan">
            @foreach(range(1, 12) as $m)
                <option value="{{ $m }}">{{ DateTime::createFromFormat('!m', $m)->format('F') }}</option>
            @endforeach
        </select>

        <label for="tahun">Tahun:</label>
        <select name="tahun" id="tahun">
            @for($y = date('Y'); $y >= 2020; $y--)
                <option value="{{ $y }}">{{ $y }}</option>
            @endfor
        </select>

        <button type="submit">Cetak PDF</button>
    </form>
</body>
</html> --}}
