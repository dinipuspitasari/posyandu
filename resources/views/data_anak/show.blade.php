@extends('layouts.admin')

@section('title', 'Posyandu Ganggang | Detail Anak')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>

    <div class="p-6">
        <h2 class="text-xl font-bold">Detail Anak:</h2>
        <p>Nama: {{ $anak->nama_anak }}</p>
        <p>Tanggal Lahir: {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d M Y') }}</p>
        <p>Usia Sekarang: {{ $usiaSekarang }}</p>

        <div class="mt-8">
            <div class="bg-white rounded-xl shadow p-6">
                    <div class="bg-white rounded-xl shadow p-6">
                        <h3 class="text-lg font-semibold mb-2">Grafik Pertumbuhan Berat Badan</h3>
                        <canvas id="grafikBerat"></canvas>

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
                    </div>

                        <div class="mt-8">
                            <div class="bg-white rounded-xl shadow p-6">
                                <h3 class="text-lg font-semibold mb-2">Grafik Pertumbuhan Tinggi Badan</h3>
                                <canvas id="grafikTinggi"></canvas>

                                <script>
                                    const dataTinggi = @json($tinggiBadanChart);

                                    const labelsTinggi = dataTinggi.map(item => Math.round(item.umur) + ' bln');
                                    const dataTinggiValues = dataTinggi.map(item => item.tinggi);

                                    const ctxTinggi = document.getElementById('grafikTinggi').getContext('2d');
                                    new Chart(ctxTinggi, {
                                        type: 'line',
                                        data: {
                                            labels: labelsTinggi,
                                            datasets: [{
                                                label: 'Tinggi Badan (cm)',
                                                data: dataTinggiValues,
                                                borderColor: 'green',
                                                backgroundColor: 'lightgreen',
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
                                                        text: 'Tinggi Badan (cm)'
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
                            </div>
                        </div>


                        <h3 class="mt-6 font-semibold">Perkembangan Anak</h3>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-700 mt-2">
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
                                        <td class="px-4 py-2 border">
                                            {{ \Carbon\Carbon::parse($perk->tanggal_posyandu)->format('d M Y') }}</td>
                                        <td class="px-4 py-2 border">{{ $perk->berat_badan }} kg</td>
                                        <td class="px-4 py-2 border">{{ $perk->tinggi_badan }} cm</td>
                                        <td class="px-4 py-2 border">{{ $perk->pemberian }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <h3 class="mt-6 font-semibold">Riwayat Imunisasi</h3>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-700 mt-2">
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
                                        <td class="px-4 py-2 border">
                                            {{ \Carbon\Carbon::parse($imun['tanggal'])->format('d M Y') }}
                                        </td>
                                        <td class="px-4 py-2 border">{{ $imun['nama'] }}</td>
                                        <td class="px-4 py-2 border">{{ $imun['usia'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endsection
