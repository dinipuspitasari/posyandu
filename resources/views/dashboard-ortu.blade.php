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
    <div class="max-w-7xl mx-auto p-6">
        <!-- Tombol Cetak -->
        <div class="mb-4 print:hidden flex justify-end">
            <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded shadow">
                Cetak Halaman
            </button>
        </div>

        <!-- Header -->
        <div class="flex items-center space-x-4 mb-6">
            <img src="/assets/logo.jpeg" alt="Logo Posyandu" class="w-12 h-12 object-contain">
            <h1 class="text-2xl font-bold">POSYANDU GANGGANG</h1>
        </div>

        <!-- Bagian Atas: Info Anak + Grafik -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Info Anak -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="font-semibold text-2xl">{{ $anak->nama_anak }}</h3>
                <h3 class="text-lg py-2 text-gray-500">{{ $anak->nik_anak }}</h3>
                <p class="text-lg py-2 text-gray"><span class="font-semibold">Tempat Tanggal
                        Lahir:</span><br>{{ $anak->tempat_lahir }},
                    {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d M Y') }}</p>
                <p class="text-lg py-2 text-gray"><span class="font-semibold">Usia Saat
                        Ini:</span><br>{{ $usiaSekarang }}</p>
                <p class="text-lg py-2 text-gray"><span class="font-semibold">Jenis
                        Kelamin:</span><br>{{ $anak->jenis_kelamin }}</p>

                <div class="mt-6 border-t pt-4">
                    <h2 class="text-lg font-semibold mb-2">Jadwal Posyandu Berikutnya</h2>
                    <div class="flex items-center gap-2">
                        <div class="bg-green-100 p-2 rounded">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            @if ($jadwalBerikutnya)
                                <p class="font-bold">
                                    {{ \Carbon\Carbon::parse($jadwalBerikutnya->tanggal)->format('d M Y') }}
                                    <span class="font-normal text-sm ml-2">
                                        {{ \Carbon\Carbon::parse($jadwalBerikutnya->waktu)->format('H:i') }}
                                    </span>
                                </p>
                                <p class="text-sm text-gray-500">{{ $jadwalBerikutnya->lokasi }}</p>
                            @else
                                <p class="text-sm text-gray-500 italic">Belum ada jadwal posyandu berikutnya</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik -->
            <div class="lg:col-span-2 bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-4">Grafik Berat Badan Anak</h2>
                <div class="relative w-full h-72 mb-6">
                    <canvas id="grafikBerat"></canvas>
                </div>

                <h2 class="text-lg font-semibold mt-6 break-before-page">Grafik Tinggi Badan Anak</h2>
                <div class="relative w-full h-72">
                    <canvas id="grafikTinggi"></canvas>
                </div>
            </div>
        </div>

        <!-- Riwayat Kunjungan -->
        <div class="bg-white p-4 rounded-lg shadow-md mb-6">
            <h2 class="text-lg font-semibold mb-2">Riwayat Kunjungan</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm min-w-[700px]">
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

        <!-- Riwayat Vitamin & Imunisasi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Vitamin -->
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

            <!-- Imunisasi -->
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
    </div>

    <!-- Script Chart.js dan Konversi Print -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const dataBerat = @json($beratBadanChart);
        const dataTinggi = @json($tinggiBadanChart);

        const labels = dataBerat.map(item => Math.round(item.umur) + ' bln');
        const ctx = document.getElementById('grafikBerat').getContext('2d');
        const ctxTinggi = document.getElementById('grafikTinggi').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Berat Badan (kg)',
                    data: dataBerat.map(item => item.berat),
                    borderColor: 'blue',
                    backgroundColor: 'lightblue',
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(ctxTinggi, {
            type: 'line',
            data: {
                labels: dataTinggi.map(item => Math.round(item.umur) + ' bln'),
                datasets: [{
                    label: 'Tinggi Badan (cm)',
                    data: dataTinggi.map(item => item.tinggi),
                    borderColor: 'green',
                    backgroundColor: 'lightgreen',
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        // Konversi canvas ke image saat print
        function convertCanvasToImage(canvasId, imgId) {
            const canvas = document.getElementById(canvasId);
            const img = document.getElementById(imgId);
            const dataURL = canvas.toDataURL('image/png');
            img.src = dataURL;
        }

        window.addEventListener("beforeprint", function() {
            convertCanvasToImage('grafikBerat', 'imgBerat');
            convertCanvasToImage('grafikTinggi', 'imgTinggi');
            document.getElementById('grafikBerat').classList.add('hidden');
            document.getElementById('grafikTinggi').classList.add('hidden');
        });

        window.addEventListener("afterprint", function() {
            document.getElementById('grafikBerat').classList.remove('hidden');
            document.getElementById('grafikTinggi').classList.remove('hidden');
        });
    </script>
</body>

</html>
