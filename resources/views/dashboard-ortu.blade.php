<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Orang Tua</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200..800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-[Inter]">
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex items-center space-x-4 mb-6">
            <img src="/assets/logo.jpeg" alt="Logo Posyandu" class="w-12 h-12 object-contain">
            <h1 class="text-2xl font-bold">POSYANDU GANGGANG</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
            <!-- Data Anak (kecil) -->
            <div class="bg-white p-4 rounded-lg shadow-md w-full">
                {{-- <h2 class="text-lg font-bold mb-2">Data Anak</h2> --}}
                <div class="flex items-center gap-4">
                    <div>
                        <h3 class="font-semibold text-2xl">{{ $anak->nama_anak }}</h3>
                        <h3 class="text-lg py-2 text-gray-500">{{ $anak->nik_anak }}</h3>
                        <p class="text-lg py-2 text-gray"><span class="font-semibold">Tempat Tanggal
                                Lahir:</span><br>{{ $anak->tempat_lahir }},<br>{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d M Y') }}
                        </p>
                        <p class="text-lg py-2 text-gray"><span class="font-semibold">Usia Saat
                                Ini:</span><br>{{ $usiaSekarang }}</p>
                        <p class="flex items-center text-sm text-gray gap-1">
                            <span class="text-lg"><span class="font-semibold">Jenis
                                    Kelamin:</span><br>{{ $anak->jenis_kelamin }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Grafik Pertumbuhan -->
            <div class="bg-white p-4 rounded-lg shadow-md col-span-2">
                <h2 class="text-lg font-semibold mb-4">Grafik Berat Badan Anak</h2>
                <canvas id="grafikBerat" height="100"></canvas>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <!-- Jadwal Posyandu Berikutnya -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-2">Jadwal Posyandu Berikutnya</h2>
                <div class="flex items-center gap-2">
                    <div class="bg-green-100 p-2 rounded">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        @if ($jadwalBerikutnya)
                            <p class="font-bold">
                                {{ \Carbon\Carbon::parse($jadwalBerikutnya->tanggal)->format('d M Y') }}
                                <span
                                    class="font-normal text-sm ml-2">{{ \Carbon\Carbon::parse($jadwalBerikutnya->waktu)->format('H:i') }}</span>
                            </p>
                            <p class="text-sm text-gray-500">{{ $jadwalBerikutnya->lokasi }}</p>
                        @else
                            <p class="text-sm text-gray-500 italic">Belum ada jadwal posyandu berikutnya</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Riwayat Kunjungan Lebar -->
            <div class="bg-white p-4 rounded-lg shadow-md md:col-span-2">
                <h2 class="text-lg font-semibold mb-2">Riwayat Kunjungan</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm min-w-[500px]">
                        <thead class="bg-gray-100">
                            <tr class="text-left border-b">
                                <th class="px-4 py-2 border">Tanggal Posyandu</th>
                                <th class="px-4 py-2 border">Berat Badan</th>
                                <th class="px-4 py-2 border">Keterangan Berat Badan</th>
                                <th class="px-4 py-2 border">Tinggi Badan</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anak->perkembangan as $perk)
                                <tr>
                                    <td class="px-4 py-2 border">
                                        {{ \Carbon\Carbon::parse($perk->tanggal_posyandu)->format('d M Y') }}</td>
                                    <td class="px-4 py-2 border">{{ $perk->berat_badan }} kg</td>
                                     <td class="px-4 py-2 border">{{ $perk->keterangan_berat_badan }}</td>
                                    <td class="px-4 py-2 border">{{ $perk->tinggi_badan }} cm</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- riwayat imunisasi & vitamin -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Riwayat Vitamin -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-2">Riwayat Pemberian</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm min-w-[500px]">
                        <thead class="bg-gray-100">
                            <tr class="text-left border-b">
                                <th class="px-4 py-2 border">Tanggal Posyandu</th>
                                <th class="px-4 py-2 border">Vitamin/Obat Cacing</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anak->perkembangan as $perk)
                                <tr>
                                    <td class="px-4 py-2 border">
                                        {{ \Carbon\Carbon::parse($perk->tanggal_posyandu)->format('d M Y') }}</td>
                                    <td class="px-4 py-2 border">{{ $perk->pemberian }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Riwayat Imunisasi -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-2">Riwayat Imunisasi</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm min-w-[500px]">
                        <thead class="bg-gray-100">
                            <tr class="text-left border-b">
                                <th class="px-4 py-2 border">Tanggal Posyandu</th>
                                <th class="px-4 py-2 border">Imunisasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anak->perkembangan ?? [] as $perk)
                                <tr>
                                    <td class="px-4 py-2 border">
                                        {{ \Carbon\Carbon::parse($perk->tanggal_posyandu)->format('d M Y') }}</td>
                                    <td class="px-4 py-2 border">{{ $perk->imunisasi?->name ?? '-' }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- edukasi --}}
        {{-- <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-6">
            <!-- Riwayat edukasi -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-2">Catatan / Edukasi</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm min-w-[500px]">
                        <thead class="bg-gray-100">
                            <tr class="text-left border-b">
                                <th class="px-4 py-2 border ">Tanggal Posyandu</th>
                                <th class="px-4 py-2 border">Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anak->perkembangan as $perk)
                                <tr>
                                    <td class="px-4 py-2 border">
                                        {{ \Carbon\Carbon::parse($perk->tanggal_posyandu)->format('d M Y') }}</td>
                                    <td class="px-4 py-2 border">{{ $perk->edukasi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
    </div>
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dataBerat = @json($beratBadanChart);

    const labels = dataBerat.map(item => Math.round(item.umur) + ' bln');
    const data = dataBerat.map(item => item.berat);

    const ctx = document.getElementById('grafikBerat').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Berat Badan (kg)',
                data: data,
                borderColor: 'blue',
                backgroundColor: 'lightblue',
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Berat Badan (kg)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Umur (bulan)'
                    }
                }
            }
        }
    });
</script>
</body>
</html>
