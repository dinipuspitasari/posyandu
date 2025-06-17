@extends('layouts.admin')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>

    <div class="p-6">
        <h2 class="text-xl font-bold">Detail Anak:</h2>
        <p>Nama: {{ $anak->nama_anak }}</p>
        <p>Tanggal Lahir: {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d M Y') }}</p>
        <p>Usia Sekarang: {{ $usiaSekarang }}</p>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 bg-white"
            style="margin-left: 20px; margin-top: 16px;">
            @if ($anak->jenis_kelamin === 'Laki-laki')
                {{-- grafik untuk laki-laki --}}
                <h3 class="mt-6 font-semibold">Grafik Berat Badan Laki-Laki</h3>
                <canvas id="beratBadanChartLaki" class="w-full max-w-3xl my-4"></canvas>
                <script>
                    const ctxlaki = document.getElementById('beratBadanChartLaki').getContext('2d');
                    const beratBadanChart = new Chart(ctxlaki, {
                        type: 'line',
                        data: {
                            labels: {!! '[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60]' !!},
                            datasets: [{
                                    label: 'Berat Badan (kg)',
                                    data: {!! json_encode($beratBadanChart->pluck('berat')) !!},
                                    fill: false,
                                    borderColor: 'rgb(10, 10, 120)',
                                    tension: 0.3,
                                    pointBackgroundColor: 'rgb(10, 10, 120)',
                                    pointStyle: true,
                                },
                                {
                                    label: 'Obesitas ekstrem',
                                    data: [5.0, 6.6, 8.0, 9.0, 9.7, 10.4, 10.9, 11.4, 11.9, 12.3, 12.7, 13.0, 13.3, 13.7,
                                        14.0, 14.3, 14.6, 14.9, 15.3, 15.6, 15.9, 16.2, 16.5, 16.8, 17.1, 17.5, 17.8,
                                        18.1, 18.4, 18.7, 19.0, 19.3, 19.6, 19.9, 20.2, 20.4, 20.7, 21.0, 21.3, 21.6,
                                        21.9, 22.1, 22.4, 22.7, 23.0, 23.3, 23.6, 23.9, 24.2, 24.5, 24.8, 25.1, 25.4,
                                        25.7, 26.0, 26.3, 26.6, 26.9, 27.2, 27.6, 27.9
                                    ],
                                    fill: false,
                                    borderColor: 'rgba(5, 5, 5, 0.3)',
                                },
                                {
                                    label: 'Sangat gemuk',
                                    data: [4.4, 5.8, 7.1, 8.0, 8.7, 9.3, 9.8, 10.3, 10.7, 11.0, 11.4, 11.7, 12.0, 12.3,
                                        12.6, 12.8, 13.1, 13.4, 13.7, 13.9, 14.2, 14.5, 14.7, 15.0, 15.3, 15.5, 15.8,
                                        16.1, 16.3, 16.6, 16.9, 17.1, 17.4, 17.6, 17.8, 18.1, 18.3, 18.6, 18.8, 19.0,
                                        19.3, 19.5, 19.7, 20.0, 20.2, 20.5, 20.7, 20.9, 21.2, 21.4, 21.7, 21.9, 22.2,
                                        22.4, 22.7, 22.9, 23.2, 23.4, 23.7, 23.9, 24.2
                                    ],
                                    fill: false,
                                    borderColor: 'rgba(5, 5, 5, 0.3)',
                                },
                                {
                                    label: 'Gizi lebih',
                                    data: [3.9, 5.1, 6.3, 7.2, 7.8, 8.4, 8.8, 9.2, 9.6, 9.9, 10.2, 10.5, 10.8, 11.0, 11.3,
                                        11.5, 11.7, 12.0, 12.2, 12.5, 12.7, 12.9, 13.2, 13.4, 13.6, 13.9, 14.1, 14.3,
                                        14.5, 14.8, 15.0, 15.2, 15.4, 15.6, 15.8, 16.0, 16.2, 16.4, 16.6, 16.8, 17.0,
                                        17.2, 17.4, 17.6, 17.8, 18.0, 18.2, 18.4, 18.6, 18.8, 19.0, 19.2, 19.4, 19.6,
                                        19.8, 20.0, 20.2, 20.4, 20.6, 20.8, 21.0
                                    ],
                                    fill: false,
                                    borderColor: 'rgba(230, 124, 32, 0.3)',
                                },
                                {
                                    label: 'Normal',
                                    data: [3.3, 4.5, 5.6, 6.4, 7.0, 7.5, 7.9, 8.3, 8.6, 8.9, 9.2, 9.4, 9.6, 9.9, 10.1, 10.3,
                                        10.5, 10.7, 10.9, 11.1, 11.3, 11.5, 11.8, 12.0, 12.2, 12.4, 12.5, 12.7, 12.9,
                                        13.1, 13.3, 13.5, 13.7, 13.8, 14.0, 14.2, 14.3, 14.5, 14.7, 14.8, 15.0, 15.2,
                                        15.3, 15.5, 15.7, 15.8, 16.0, 16.2, 16.3, 16.5, 16.7, 16.8, 17.0, 17.2, 17.3,
                                        17.5, 17.7, 17.8, 18.0, 18.2, 18.3
                                    ],
                                    fill: false,
                                    borderColor: 'rgba(35, 201, 6, 0.3)',
                                },
                                {
                                    label: 'Gizi buruk',
                                    data: [2.9, 3.9, 4.9, 5.7, 6.2, 6.7, 7.1, 7.4, 7.7, 8.0, 8.2, 8.4, 8.6, 8.8, 9.0, 9.2,
                                        9.4, 9.6, 9.8, 10.0, 10.1, 10.3, 10.5, 10.7, 10.8, 11.0, 11.2, 11.3, 11.5, 11.7,
                                        11.8, 12.0, 12.1, 12.3, 12.4, 12.6, 12.7, 12.9, 13.0, 13.1, 13.3, 13.4, 13.6,
                                        13.7, 13.8, 14.0, 14.1, 14.3, 14.4, 14.5, 14.7, 14.8, 14.8, 15.0, 15.1, 15.2,
                                        15.4, 15.5, 15.6, 15.8, 15.9, 16.0
                                    ],
                                    fill: false,
                                    borderColor: 'rgba(201, 6, 6, 0.3)',
                                },
                                {
                                    label: 'Gizi buruk ekstrem',
                                    data: [2.5, 3.4, 4.3, 5.0, 5.6, 6.0, 6.4, 6.7, 6.9, 7.1, 7.4, 7.6, 7.7, 7.9, 8.1, 8.3,
                                        8.4, 8.6, 8.8, 8.9, 9.1, 9.2, 9.4, 9.5, 9.7, 9.8, 10.0, 10.1, 10.2, 10.4, 10.5,
                                        10.7, 10.8, 10.9, 11.0, 11.2, 11.3, 11.4, 11.5, 11.6, 11.8, 11.9, 12.0, 12.1,
                                        12.2, 12.4, 12.5, 12.6, 12.7, 12.8, 12.9, 13.1, 13.2, 13.3, 13.4, 13.5, 13.6,
                                        13.7, 13.8, 14.0, 14.1

                                    ],
                                    fill: false,
                                    borderColor: 'rgba(5, 5, 5, 0.3)',
                                },
                                {
                                    label: 'Anak sangat berisiko stunting parah',
                                    data: [2.1, 2.9, 3.8, 4.4, 4.9, 5.3, 5.7, 5.9, 6.2, 6.4, 6.6, 6.8, 6.9, 7.1, 7.2, 7.4,
                                        7.5, 7.7, 7.8, 8.0, 8.1, 8.2, 8.4, 8.5, 8.6, 8.8, 8.9, 9.0, 9.1, 9.2, 9.4, 9.5,
                                        9.6, 9.7, 9.8, 9.9, 10.0, 10.1, 10.2, 10.3, 10.4, 10.5, 10.6, 10.7, 10.8, 10.9,
                                        11.0, 11.1, 11.2, 11.3, 11.4, 11.5, 11.6, 11.7, 11.8, 11.9, 12.0, 12.1, 12.2,
                                        12.3, 12.4
                                    ],
                                    fill: false,
                                    borderColor: 'rgba(5, 5, 5, 0.3)',
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            pointStyle: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Perkembangan Berat Badan'
                                },
                                pointStyle: false
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Kg'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Umur (Bulan)'
                                    }
                                }
                            }
                        }
                    });
                </script>
            @elseif ($anak->jenis_kelamin === 'Perempuan')
                {{-- grafik untuk perempuan --}}
                <h3 class="mt-6 font-semibold">Grafik Berat Badan Perempuan</h3>
                <canvas id="beratBadanChartPerempuan" class="w-full max-w-3xl my-4"></canvas>
                <script>
                    const ctx = document.getElementById('beratBadanChartPerempuan').getContext('2d');
                    const beratBadanChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: {!! '[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60]' !!},
                            datasets: [{
                                    label: 'Berat Badan (kg)',
                                    data: {!! json_encode($beratBadanChart->pluck('berat')) !!},
                                    fill: false,
                                    borderColor: 'rgb(10, 10, 120)',
                                    tension: 0.3,
                                    pointBackgroundColor: 'rgb(10, 10, 120)',
                                    pointStyle: true,
                                },
                                {
                                    label: 'Obesitas ekstrem',
                                    data: [4.8, 6.2, 7.5, 8.5, 9.3, 10.0, 10.6, 11.1, 11.6, 12.0, 12.4, 12.8, 13.1, 13.5,
                                        13.8, 14.1, 14.5, 14.8, 15.1, 15.4, 15.7, 16.1, 16.3, 16.7, 17.0, 17.3, 17.7,
                                        18.0, 18.3, 18.7, 19.0, 19.3, 19.6, 20.0, 20.3, 20.6, 20.9, 21.3, 21.6, 22.0,
                                        22.3, 22.7, 23.0, 23.4, 23.7, 24.1, 24.5, 24.8, 25.2, 25.5, 25.9, 26.3, 26.6,
                                        27.0, 27.4, 27.7, 28.1, 28.5, 28.8, 29.2, 29.5
                                    ],
                                    fill: false,
                                    borderColor: 'rgba(5, 5, 5, 0.3)',

                                },
                                {
                                    label: 'Sangat gemuk',
                                    data: [4.2, 5.5, 6.6, 7.5, 8.2, 8.8, 9.3, 9.8, 10.2, 10.5, 10.9, 11.2, 11.5, 11.8, 12.1,
                                        12.4, 12.6, 12.9, 13.2, 13.5, 13.7, 14.0, 14.3, 14.6, 14.8, 15.1, 15.4, 15.7,
                                        16.0, 16.2, 16.5, 16.8, 17.1, 17.3, 17.6, 17.9, 18.1, 18.4, 18.7, 19.0, 19.2,
                                        19.5, 19.8, 20.1, 20.4, 20.7, 20.9, 21.2, 21.5, 21.8, 22.1, 22.4, 22.6, 22.9,
                                        23.2, 23.5, 23.8, 24.1, 24.4, 24.6, 24.9
                                    ],
                                    fill: false,
                                    borderColor: 'rgba(5, 5, 5, 0.3)',
                                },
                                {
                                    label: 'Gizi lebih',
                                    data: [3.7, 4.8, 5.8, 6.6, 7.3, 7.8, 8.2, 8.6, 9.0, 9.3, 9.6, 9.9, 10.1, 10.4, 10.6,
                                        10.9, 11.1, 11.4, 11.6, 11.8, 12.1, 12.3, 12.5, 12.8, 13.0, 13.3, 13.5, 13.7,
                                        14.0, 14.2, 14.4, 14.7, 14.9, 15.1, 15.4, 15.6, 15.8, 16.0, 16.3, 16.5, 16.7,
                                        16.9, 17.2, 17.4, 17.6, 17.8, 18.1, 18.3, 18.5, 18.8, 19.0, 19.2, 19.4, 19.7,
                                        19.9, 20.1, 20.3, 20.6, 20.8, 21.0, 21.2
                                    ],
                                    fill: false,
                                    borderColor: 'rgba(230, 124, 32, 0.3)',
                                },
                                {
                                    label: 'Normal',
                                    data: [3.2, 4.2, 5.1, 5.8, 6.4, 6.9, 7.3, 7.6, 7.9, 8.2, 8.5, 8.7, 8.9, 9.2, 9.4, 9.6,
                                        9.8, 10.0, 10.2, 10.4, 10.6, 10.9, 11.1, 11.3, 11.5, 11.7, 11.9, 12.1, 12.3,
                                        12.5, 12.7, 12.9, 13.1, 13.3, 13.5, 13.7, 13.9, 14.0, 14.2, 14.4, 14.6, 14.8,
                                        15.0, 15.2, 15.3, 15.5, 15.7, 15.9, 16.1, 16.3, 16.4, 16.6, 16.8, 17.0, 17.2,
                                        17.3, 17.5, 17.7, 17.9, 18.0, 18.2
                                    ],
                                    fill: false,
                                    borderColor: 'rgba(35, 201, 6, 0.3)',
                                },
                                {
                                    label: 'Gizi buruk',
                                    data: [2.8, 3.6, 4.5, 5.2, 5.7, 6.1, 6.5, 6.8, 7.0, 7.3, 7.5, 7.7, 7.9, 8.1, 8.3, 8.5,
                                        8.7, 8.9, 9.1, 9.2, 9.4, 9.6, 9.8, 10.0, 10.2, 10.3, 10.5, 10.7, 10.9, 11.1,
                                        11.2, 11.4, 11.6, 11.7, 11.9, 12.0, 12.2, 12.4, 12.5, 12.7, 12.8, 13.0, 13.1,
                                        13.3, 13.4, 13.6, 13.7, 13.9, 14.0, 14.2, 14.3, 14.5, 14.6, 14.8, 14.9, 15.1,
                                        15.2, 15.3, 15.5, 15.6, 15.8
                                    ],
                                    fill: false,
                                    borderColor: 'rgba(201, 6, 6, 0.3)',
                                },
                                {
                                    label: 'Gizi buruk ekstrem',
                                    data: [2.4, 3.2, 3.9, 4.5, 5.0, 5.4, 5.7, 6.0, 6.3, 6.5, 6.7, 6.9, 7.0, 7.2, 7.4, 7.6,
                                        7.7, 7.9, 8.1, 8.2, 8.4, 8.6, 8.7, 8.9, 9.0, 9.2, 9.4, 9.5, 9.7, 9.8, 10.0,
                                        10.1, 10.3, 10.4, 10.5, 10.7, 10.8, 10.9, 11.1, 11.2, 11.3, 11.5, 11.6, 11.7,
                                        11.8, 12.0, 12.1, 12.2, 12.3, 12.4, 12.6, 12.7, 12.8, 12.9, 13.0, 13.2, 13.3,
                                        13.4, 13.5, 13.6, 13.7

                                    ],
                                    fill: false,
                                    borderColor: 'rgba(5, 5, 5, 0.3)',
                                },
                                {
                                    label: 'Anak sangat berisiko stunting parah',
                                    data: [2.0, 2.7, 3.4, 4.0, 4.4, 4.8, 5.1, 5.3, 5.6, 5.8, 5.9, 6.1, 6.3, 6.4, 6.6, 6.7,
                                        6.9, 7.0, 7.2, 7.3, 7.5, 7.6, 7.8, 7.9, 8.1, 8.2, 8.4, 8.5, 8.6, 8.8, 8.9, 9.0,
                                        9.1, 9.3, 9.4, 9.5, 9.6, 9.7, 9.8, 9.9, 10.1, 10.2, 10.3, 10.4, 10.5, 10.6,
                                        10.7, 10.8, 10.9, 11.0, 11.1, 11.2, 11.3, 11.4, 11.5, 11.6, 11.7, 11.8, 11.9,
                                        12.0, 12.1
                                    ],
                                    fill: false,
                                    borderColor: 'rgba(5, 5, 5, 0.3)',
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            pointStyle: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Perkembangan Berat Badan'
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Kg'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Umur (Bulan)'
                                    }
                                }
                            }
                        }
                    });
                </script>
            @endif

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
                            <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($imun['tanggal'])->format('d M Y') }}</td>
                            <td class="px-4 py-2 border">{{ $imun['nama'] }}</td>
                            <td class="px-4 py-2 border">{{ $imun['usia'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
