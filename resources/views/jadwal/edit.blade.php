@extends('layouts.admin')

@section('title', 'Posyandu Ganggang | Edit Jadwal Posyandu')

@section('content')

   @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-500 rounded-lg alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <div class="p-6 bg-white rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Edit Jadwal Posyandu</h2>

        <form action="{{ route('jadwal.update', $jadwal->id_jadwal_posyandu) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama kegiatan --}}
            <div class="mb-4">
                <label for="nama_kegiatan" class="block mb-2 text-sm font-medium text-gray-900">Nama Kegiatan<span
                        class="text-red-500">*</span></label>
                <input placeholder="Masukkan nama kegiatan" type="text" name="nama_kegiatan"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ $jadwal->nama_kegiatan }}" required>
                    @error('nama_kegiatan')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal kegiatan --}}
            <div class="mb-4">
                <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900">Tanggal<span
                        class="text-red-500">*</span></label>
                <input placeholder="Masukkan tanggal kegiatan" type="date" name="tanggal"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ $jadwal->tanggal }}" required>
                    @error('tanggal')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Waktu kegiatan --}}
            <div class="mb-4">
                <label for="waktu" class="block mb-2 text-sm font-medium text-gray-900">Waktu<span
                        class="text-red-500">*</span></label>
                <input placeholder="Masukkan waktu kegiatan" type="time" name="waktu"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ $jadwal->waktu }}" required>
                    @error('waktu')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Lokasi kegiatan --}}
            <div class="mb-4">
                <label for="lokasi" class="block mb-2 text-sm font-medium text-gray-900">Lokasi<span
                        class="text-red-500">*</span></label>
                <input placeholder="Masukkan lokasi kegiatan" type="text" name="lokasi"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ $jadwal->lokasi }}" required>
                    @error('lokasi')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Petugas kegiatan --}}
            <div class="mb-4">
                <label for="id_petugas" class="block mb-2 text-sm font-medium text-gray-900">Petugas<span
                        class="text-red-500">*</span></label>
                <select name="id_petugas"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" selected hidden>-- Pilih Petugas --</option>
                    @foreach ($petugas as $p)
                        <option value="{{ $p->id_petugas }}" {{ $jadwal->id_petugas == $p->id_petugas ? 'selected' : '' }}>
                            {{ $p->nama }}
                        </option>
                    @endforeach
                </select>
                @error('petugas_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol batal & simpan perubahan  --}}
            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('jadwal.index') }}"
                    class="px-4 py-2 text-sm bg-white border-black border rounded-lg hover:bg-gray-400">Batal</a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-sm text-white rounded-lg hover:bg-blue-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection
