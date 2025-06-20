@extends('layouts.admin')

@section('title', 'Posyandu Ganggang | Data Anak')

@section('content')

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- <div style="margin-left: 20px; margin-top: 16px;"> --}}
        {{-- Judul --}}
        <h2 class="text-xl font-semibold mb-6">Data Anak</h2>

        {{-- Entries --}}
        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-2 sm:gap-4 mb-4">
            <form method="GET" action="{{ route('data_anak.index') }}" class="flex items-center">
                <label for="perPage" class="mr-2 text-gray-900 whitespace-nowrap">Entries per page:</label>
                <select name="perPage" id="perPage" onchange="this.form.submit()"
                    class="border rounded-lg p-1 text-xs w-16">
                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                </select>
            </form>

            <form method="GET" action="{{ route('data_anak.index') }}" class="flex items-center">

                {{-- searching --}}
                <form method="GET" action="{{ route('data_anak.index') }}" class="w-full flex items-center" id="searchForm">
                    <input type="hidden" name="perPage" value="{{ request('perPage', 10) }}" />

                    <div class="relative md:w-60 w-full ">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama anak atau NIK anak..."
                            class="w-full pr-10 pl-4 py-2 text-xs border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none"
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

        {{-- Tombol Tambah Data perkembangan anak --}}
        <a href="{{ route('data_anak.create') }}"
            class="w-full md:w-fit inline-flex items-center gap-1 bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700">
            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14m-7 7V5" />
            </svg>
            <span class="text-sm">Tambah Data</span>
        </a>

        <div class="relative overflow-x-auto shadow-md mt-4 sm:rounded-lg p-4 bg-white">
            <table class="w-full text-sm text-left rtl:text-right text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">NIK Anak</th>
                        <th class="px-4 py-2 border">Nama Ibu</th>
                        <th class="px-4 py-2 border">Nama Anak</th>
                        <th class="px-4 py-2 border">Tempat Lahir</th>
                        <th class="px-4 py-2 border">Tanggal Lahir</th>
                        <th class="px-4 py-2 border">Umur</th>
                        <th class="px-4 py-2 border">Jenis Kelamin</th>
                        <th class="px-4 py-2 border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataAnak as $index => $item)
                        <tr class="border-b">
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $item->nik_anak }}</td>
                            <td class="px-4 py-2 border">{{ $item->orangTua->nama_ibu ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $item->nama_anak }}</td>
                            <td class="px-4 py-2 border">{{ $item->tempat_lahir }}</td>
                            <td class="px-4 py-2 border">{{ $item->tanggal_lahir }}</td>
                            <td class="px-4 py-2 border">{{ $item->umur_formatted }}</td>
                            <td class="px-4 py-2 border">{{ $item->jenis_kelamin }}</td>
                            <td class="px-4 py-2 border">
                                <div class="flex items-center space-x-1">

                                    {{-- Tombol detail anak --}}
                                    <a href={{ route('data_anak.show', $item->id_data_anak) }} type="button"
                                        class="text-gray-900 bg-green-300 hover:bg-green-300 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-1 py-1">
                                        <svg class="w-5 h-5 text-green-800 hover:bg-green-300" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm-1 9a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2Zm2-5a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1Zm4 4a1 1 0 1 0-2 0v3a1 1 0 1 0 2 0v-3Z"
                                                clip-rule="evenodd" />
                                        </svg></a>

                                    {{-- Tombol edit --}}
                                    <a href={{ route('data_anak.edit', $item->id_data_anak) }} type="button"
                                        class="text-gray-900 bg-blue-300 hover:bg-blue-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-1 py-1">
                                        <svg class="w-5 h-5 text-blue-800 hover:bg-blue-300" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                                clip-rule="evenodd" />
                                            <path fill-rule="evenodd"
                                                d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                                clip-rule="evenodd" />
                                        </svg></a>

                                    {{-- Tombol hapus --}}
                                    <form action="{{ route('data_anak.destroy', $item->id_data_anak) }}"
                                        method="POST"
                                        onsubmit="return confirm('Anda Yakin ingin Menghapus {{ $item->nama_anak }} ?')"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class=" text-gray-900 bg-red-300 hover:bg-red-300 focus:ring-4 focus:ring-red-400 font-medium rounded-lg text-sm px-1 py-1">
                                            <svg class="w-5 h-5 text-red-800 hover:bg-red-300" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">Belum ada data anak.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-left: 20px; margin-top: 16px;">
            <p class="text-gray-900 text-sm">
                Showing {{ $dataAnak->firstItem() ?? 0 }} to {{ $dataAnak->lastItem() ?? 0 }} of
                {{ $dataAnak->total() }} entries
            </p>
        </div>
    </div>
@endsection
