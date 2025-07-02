@extends('layouts.admin')

@section('title', 'Posyandu Ganggang | Dashboard')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @csrf
    {{--  Content --}}
    <div class="container">
        {{-- <div class="container mx-auto bg-white"> --}}
        <h1 class="text-2xl font-semibold mb-1">Selamat datang, {{ Auth::user()->name }}!</h1>
        @if (Auth::user()->id_level == 1)
            {{-- Grid 2 kolom --}}
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Card 1: Total Balita --}}
                <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100">
                    <h5 class="text-xl font-bold tracking-tight text-gray-900 mb-2 flex items-center gap-2">
                        Total Balita
                        <svg class="w-8 h-8 text-gray-400 duration-75 group-hover:text-blue-900" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                clip-rule="evenodd" />
                        </svg>
                    </h5>
                    <p class="font-normal text-base text-gray-700">{{ $totalBalita }} balita</p>
                </div>

                {{-- Card 2: Total Orang Tua --}}
                <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100">
                    <h5 class="text-xl font-bold tracking-tight text-gray-900 mb-2 flex items-center gap-2">
                        Total Orang Tua Balita
                        <svg class="w-8 h-8 text-gray-400 duration-75 group-hover:text-blue-900" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                clip-rule="evenodd" />
                        </svg>
                    </h5>
                    <p class="font-normal text-base text-gray-700">{{ $totalOrangTua }} orang tua</p>
                </div>

                {{-- Card 3: Jadwal Posyandu Terdekat --}}
                <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100">
                    <h5 class="text-xl font-bold tracking-tight text-gray-900 mb-2 flex items-center gap-2">
                        Jadwal Posyandu Terdekat
                        <svg class="w-7 h-7 text-gray-400 transition duration-75 group-hover:text-blue-900"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                                clip-rule="evenodd" />
                        </svg>
                    </h5>
                    <p class="font-normal text-base text-gray-700">
                        @if ($jadwalTerdekat)
                            <p class="text-base text-gray-700 mb-1">
                                Kegiatan: <span class="font-medium">{{ $jadwalTerdekat->nama_kegiatan }}</span>
                            </p>
                            <p class="font-normal text-base text-gray-700">
                                {{ \Carbon\Carbon::parse($jadwalTerdekat->tanggal)->translatedFormat('d F Y') }}
                            </p>
                        @else
                            <p class="font-normal text-base text-gray-700">Tidak ada jadwal</p>
                        @endif
                    </p>
                </div>

                {{-- Card 4: Kehadiran Hari Ini --}}
                <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100">
                    <h5 class="text-xl font-bold tracking-tight text-gray-900 mb-2 flex items-center gap-2">
                        Kehadiran Hari Ini
                        <svg class="w-7 h-7 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                clip-rule="evenodd" />
                        </svg>
                    </h5>
                    <p class="font-normal text-base text-gray-700">{{ $kehadiranHariIni }} balita hadir</p>
                </div>

                <!-- Grafik Kehadiran -->
                {{-- <div class="mt-4 w-full bg-white p-6 rounded-lg shadow-lg  md:col-span-2"> --}}
                <div class="mt-4 w-full bg-white p-6 rounded-lg shadow-lg md:p-6">
                    <h2 class="text-lg font-bold mb-4 text-gray-800">Grafik Kehadiran Posyandu</h2>
                    <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 ">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-lg bg-gray-100  flex items-center justify-center me-3">
                                <!-- Ikon -->
                                <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 20 19">
                                    <path d="M3 3h2v13H3V3zm12 0h2v13h-2V3zM7 6h2v10H7V6zm4 4h2v6h-2v-6z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="leading-none text-2xl font-bold text-gray-900">
                                    {{ $kehadiranPerTanggal->sum('total') }}</h5>
                                <p class="text-sm font-normal text-gray-500">Total Kehadiran Posyandu</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2">
                        <dl class="flex items-center">
                            <dt class="text-gray-500  text-sm font-normal me-1">Tanggal Terakhir:</dt>
                            <dd class="text-gray-900 text-sm font-semibold">
                                {{ $kehadiranPerTanggal->last()?->tanggal ?? '-' }}
                            </dd>
                        </dl>
                        <dl class="flex items-center justify-end">
                            <dt class="text-gray-500 text-sm font-normal me-1">Hari Aktif:</dt>
                            <dd class="text-gray-900 text-sm  font-semibold">
                                {{ $kehadiranPerTanggal->count() }}</dd>
                        </dl>
                    </div>

                    <!-- Chart -->
                    <div id="column-chart">
                        <canvas id="kehadiranChart" class="w-full h-56 mt-4"></canvas>
                    </div>
                </div>

                @push('scripts')
                    <script>
                        const ctx = document.getElementById('kehadiranChart').getContext('2d');
                        const chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: {!! json_encode($kehadiranPerTanggal->pluck('tanggal')) !!},
                                datasets: [{
                                    label: 'Jumlah Kehadiran',
                                    data: {!! json_encode($kehadiranPerTanggal->pluck('total')) !!},
                                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                                    borderColor: 'rgba(59, 130, 246, 1)',
                                    borderWidth: 1,
                                    borderRadius: 6
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            stepSize: 1
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                }
                            }
                        });
                    </script>
                @endpush
            @elseif(Auth::user()->id_level == 2)
                {{-- Grid 2 kolom --}}
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Card 1: Total Balita --}}
                    <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100">
                        <h5 class="text-xl font-bold tracking-tight text-gray-900 mb-2 flex items-center gap-2">
                            Total Balita
                            <svg class="w-8 h-8 text-gray-400 duration-75 group-hover:text-blue-900" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </h5>
                        <p class="font-normal text-base text-gray-700">{{ $totalBalita }} balita</p>
                    </div>

                    {{-- Card 2: Total Orang Tua --}}
                    <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100">
                        <h5 class="text-xl font-bold tracking-tight text-gray-900 mb-2 flex items-center gap-2">
                            Total Orang Tua Balita
                            <svg class="w-8 h-8 text-gray-400 duration-75 group-hover:text-blue-900" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </h5>
                        <p class="font-normal text-base text-gray-700">{{ $totalOrangTua }} orang tua</p>
                    </div>


                    {{-- Card 3: Jadwal Posyandu Terdekat --}}
                    <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100">
                        <h5 class="text-xl font-bold tracking-tight text-gray-900 mb-2 flex items-center gap-2">
                            Jadwal Posyandu Terdekat
                            <svg class="w-7 h-7 text-gray-400 transition duration-75 group-hover:text-blue-900"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </h5>
                        <p class="font-normal text-base text-gray-700">
                            @if ($jadwalTerdekat)
                                <p class="text-base text-gray-700 mb-1">
                                    Kegiatan: <span class="font-medium">{{ $jadwalTerdekat->nama_kegiatan }}</span>
                                </p>
                                <p class="font-normal text-base text-gray-700">
                                    {{ \Carbon\Carbon::parse($jadwalTerdekat->tanggal)->translatedFormat('d F Y') }}
                                </p>
                            @else
                                <p class="font-normal text-base text-gray-700">Tidak ada jadwal</p>
                            @endif
                        </p>
                    </div>

                    {{-- Card 4: Kehadiran Hari Ini --}}
                    <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100">
                        <h5 class="text-xl font-bold tracking-tight text-gray-900 mb-2 flex items-center gap-2">
                            Kehadiran Hari Ini
                            <svg class="w-7 h-7 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </h5>
                        <p class="font-normal text-base text-gray-700">{{ $kehadiranHariIni }} balita hadir</p>
                    </div>

                    <!-- Grafik Kehadiran -->
                    {{-- <div class="mt-4 bg-white p-6 rounded-lg shadow-md w-full md:col-span-2"> --}}
                    <div class="mt-4 w-full bg-white p-6 rounded-lg shadow-lg md:p-6">
                        <h2 class="text-lg font-bold mb-4 text-gray-800">Grafik Kehadiran Posyandu</h2>
                        <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 ">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-lg bg-gray-100  flex items-center justify-center me-3">
                                    <!-- Ikon -->
                                    <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 19">
                                        <path d="M3 3h2v13H3V3zm12 0h2v13h-2V3zM7 6h2v10H7V6zm4 4h2v6h-2v-6z" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="leading-none text-2xl font-bold text-gray-900">
                                        {{ $kehadiranPerTanggal->sum('total') }}</h5>
                                    <p class="text-sm font-normal text-gray-500">Total Kehadiran Posyandu</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2">
                            <dl class="flex items-center">
                                <dt class="text-gray-500  text-sm font-normal me-1">Tanggal Terakhir:</dt>
                                <dd class="text-gray-900 text-sm font-semibold">
                                    {{ $kehadiranPerTanggal->last()?->tanggal ?? '-' }}
                                </dd>
                            </dl>
                            <dl class="flex items-center justify-end">
                                <dt class="text-gray-500 text-sm font-normal me-1">Hari Aktif:</dt>
                                <dd class="text-gray-900 text-sm  font-semibold">
                                    {{ $kehadiranPerTanggal->count() }}</dd>
                            </dl>
                        </div>

                        <!-- Chart -->
                        <div id="column-chart">
                            <canvas id="kehadiranChart" class="w-full h-56 mt-4"></canvas>
                        </div>

                        <!-- Footer Dropdown + Link -->
                        <div class="grid grid-cols-1 items-center border-t border-gray-200 pt-5">
                            <div class="flex justify-between items-center">
                                <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown"
                                    class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 inline-flex items-center"
                                    type="button">
                                    Filter Data
                                    <svg class="w-2.5 ms-1.5" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-width="2" d="M1 1l4 4 4-4" />
                                    </svg>
                                </button>
                                <div id="lastDaysdropdown"
                                    class="z-10 hidden bg-white divide-y rounded-lg shadow-sm w-44">
                                    <ul class="py-2 text-sm text-gray-700">
                                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">7
                                                Hari Terakhir</a></li>
                                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">30 Hari
                                                Terakhir</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    @push('scripts')
                        <script>
                            const ctx = document.getElementById('kehadiranChart').getContext('2d');
                            const chart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: {!! json_encode($kehadiranPerTanggal->pluck('tanggal')) !!},
                                    datasets: [{
                                        label: 'Jumlah Kehadiran',
                                        data: {!! json_encode($kehadiranPerTanggal->pluck('total')) !!},
                                        backgroundColor: 'rgba(59, 130, 246, 0.7)',
                                        borderColor: 'rgba(59, 130, 246, 1)',
                                        borderWidth: 1,
                                        borderRadius: 6
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                stepSize: 1
                                            }
                                        }
                                    },
                                    plugins: {
                                        legend: {
                                            display: false
                                        }
                                    }
                                }
                            });
                        </script>
                    @endpush
        @endif

        <!-- Flowbite Charts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite/dist/flowbite.charts.min.js"></script>
    @endsection
