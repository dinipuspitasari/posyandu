@extends('layouts.admin')

@section('title', 'Posyandu Ganggang | Laporan Bulanan')

@section('content')

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- <div style="margin-left: 20px; margin-top: 16px;"> --}}
    <h2 class="text-xl font-semibold mb-6">Laporan Bulanan</h2>

    {{-- Entries --}}
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-2 sm:gap-4 mb-4">
        <form method="GET" action="{{ route('laporan.index') }}" class="flex items-center">
            <label for="perPage" class="mr-2 text-gray-900 whitespace-nowrap">Entries per page:</label>
            <select name="perPage" id="perPage" onchange="this.form.submit()" class="border rounded-lg p-1 text-xs w-16">
                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
            </select>
        </form>

        <form method="GET" action="{{ route('laporan.index') }}" class="flex items-center">

            {{-- searching --}}
            <form method="GET" action="{{ route('laporan.index') }}" class="w-full flex items-center" id="searchForm">
                <input type="hidden" name="perPage" value="{{ request('perPage', 10) }}" />

                <div class="relative md:w-60 w-full">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari tanggal posyandu..."
                        class="block w-full pr-10 pl-4 py-2 text-xs border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none"
                        autocomplete="off" oninput="document.getElementById('searchForm').submit();" />

                    <!-- Icon search di kanan input dengan padding kanan lebih besar -->
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35m1.6-4.65a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </form>
    </div>

    {{-- Tabel Laporan --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 bg-white" style="margin-left: 20px; margin-top: 16px;">
        <table class="w-full text-sm text-left rtl:text-right text-gray-700">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-1 py-2 border text-center">No</th>
                    <th class="px-4 py-2 border">Tanggal Posyandu</th>
                    <th class="px-4 py-2 border">Bulan</th>
                    <th class="px-4 py-2 border">Tahun</th>
                    <th class="px-4 py-2 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporan as $index => $item)
                    <tr class="border-b">
                        <td class="px-1 py-2 border text-center">{{ $loop->iteration + ($laporan->firstItem() - 1) }}
                        </td>
                        <td class="px-4 py-2 border">{{ $item->tanggal_posyandu }}</td>
                        <td class="px-4 py-2 border">
                            {{ \Carbon\Carbon::create()->month($item->bulan)->translatedFormat('F') }}</td>
                        <td class="px-4 py-2 border">{{ $item->tahun }}</td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center justify-center space-x-1">

                                {{-- Tombol print --}}
                                <a href={{ route('laporan.form1', ['bulan' => $item->bulan, 'tahun' => $item->tahun]) }}
                                    type="button"
                                    class="text-gray-900 bg-gray-300 hover:bg-gray-300 focus:ring-4 focus:ring-gray-400 font-medium rounded-lg text-sm px-1 py-1">
                                    <svg class="w-5 h-5 text-gray-800 hover:bg-gray-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">Tidak ada data laporan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="flex items-center justify-between mt-4 mx-5">
        <p class="text-gray-900 text-sm">
            Showing {{ $laporan->firstItem() ?? 0 }} to {{ $laporan->lastItem() ?? 0 }} of
            {{ $laporan->total() }} entries
        </p>

        <div class="flex space-x-1">
            {{-- Tombol ke halaman sebelumnya --}}
            @if ($laporan->onFirstPage())
                <span class="px-2 py-1 border border-gray-300 text-gray-400 rounded text-sm cursor-not-allowed">&lt;</span>
            @else
                <a href="{{ $laporan->previousPageUrl() }}"
                    class="px-2 py-1 border border-gray-400 text-gray-700 rounded text-sm hover:bg-gray-100">&lt;</a>
            @endif

            {{-- Halaman aktif --}}
            <span class="px-3 py-1 bg-blue-600 text-white rounded text-sm">{{ $laporan->currentPage() }}</span>

            {{-- Tombol ke halaman selanjutnya --}}
            @if ($laporan->hasMorePages())
                <a href="{{ $laporan->nextPageUrl() }}"
                    class="px-2 py-1 border border-gray-400 text-gray-700 rounded text-sm hover:bg-gray-100">&gt;</a>
            @else
                <span class="px-2 py-1 border border-gray-300 text-gray-400 rounded text-sm cursor-not-allowed">&gt;</span>
            @endif
        </div>
    </div>
@endsection
