<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Orang Tua</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="max-w-5xl mx-auto py-6 px-4">
        <h1 class="text-3xl font-bold mb-6">Dashboard Orang Tua</h1>

        <div class="bg-white shadow-md rounded-lg p-4 mb-8">
            <h2 class="text-xl font-semibold mb-4">Detail Anak</h2>
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Nama Orang Tua</th>
                        <th class="px-4 py-2 border">Nama Anak</th>
                        <th class="px-4 py-2 border">NIK Anak</th>
                        <th class="px-4 py-2 border">Usia Anak</th>
                    </tr>
                </thead>
                <tbody>
                        <tr class="border-b">
                           <td class="px-4 py-2 border">{{ $anak->nama_ibu }}</td>
                           <td class="px-4 py-2 border">{{ $anak->nama_anak }}</td>
                           <td class="px-4 py-2 border">{{ $anak->nik_anak }}</td>
                           <td class="px-4 py-2 border">{{ $usiaSekarang }}</td>
                        </tr>
                </tbody>
            </table>
        </div>
        {{-- Riwayat Imunisasi --}}
        <div class="bg-white shadow-md rounded-lg p-4 mb-8">
            <h2 class="text-xl font-semibold mb-4">Riwayat Imunisasi</h2>
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Tanggal</th>
                        <th class="px-4 py-2 border">Imunisasi</th>
                        <th class="px-4 py-2 border">Usia Saat Itu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($imunisasiList as $imun)
                        <tr class="border-b">
                            <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($imun['tanggal'])->format('d M Y') }}</td>
                            <td class="px-4 py-2 border">{{ $imun['nama'] }}</td>
                            <td class="px-4 py-2 border">{{ $imun['usia'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Perkembangan Anak --}}
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-xl font-semibold mb-4">Perkembangan Anak</h2>
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Tanggal</th>
                        <th class="px-4 py-2 border">Berat Badan</th>
                        <th class="px-4 py-2 border">Tinggi Badan</th>
                        <th class="px-4 py-2 border">Pemberian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anak->perkembangan as $perk)
                        <tr class="border-b">
                            <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($perk->tanggal_posyandu)->format('d M Y') }}</td>
                            <td class="px-4 py-2 border">{{ $perk->berat_badan }} kg</td>
                            <td class="px-4 py-2 border">{{ $perk->tinggi_badan }} cm</td>
                            <td class="px-4 py-2 border">{{ $perk->pemberian }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
