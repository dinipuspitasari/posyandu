@extends('layouts.admin')

@section('title', 'Posyandu Ganggang | Edit Data Orang Tua')

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
        <h2 class="text-lg font-semibold mb-4">Edit Data Orang Tua</h2>

        <form action="{{ route('data_orang_tua.update', $orangTua->id_data_orang_tua) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- NIK ibu --}}
            <div class="mb-4">
                <label for="nik_ibu" class="block mb-2 text-sm font-medium text-gray-900">NIK Ibu<span class="text-red-500">*</span></label>
                <input placeholder="Masukkan nik ibu" type="text" name="nik_ibu" id="nik_ibu"
                    value="{{ old('nik_ibu', $orangTua->nik_ibu) }}"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('nik_ibu')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama Ibu --}}
            <div class="mb-4">
                <label for="nama_ibu" class="block mb-2 text-sm font-medium text-gray-900">Nama Ibu<span class="text-red-500">*</span></label>
                <input placeholder="Masukkan nama ibu" type="text" name="nama_ibu" id="nama_ibu"
                    value="{{ old('nama_ibu', $orangTua->nama_ibu) }}"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('nama_ibu')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- No Telpon --}}
            <div class="mb-4">
                <label for="no_telpon" class="block mb-2 text-sm font-medium text-gray-900">No Telpon<span class="text-red-500">*</span></label>
                <input placeholder="Masukkan no telpon" type="text" name="no_telpon" id="no_telpon"
                    value="{{ old('no_telpon', $orangTua->no_telpon) }}"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('no_telpon')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div class="mb-4">
                <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat<span class="text-red-500">*</span></label>
                <textarea placeholder="Masukkan alamat" name="alamat" id="alamat"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>{{ old('alamat', $orangTua->alamat) }}</textarea>
                    @error('alamat')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Batal & Simpan Perubahan --}}
            <div class="flex justify-end space-x-2">
                <a href="{{ route('data_orang_tua.index') }}"
                    class="px-4 py-2 text-sm bg-white border-black border rounded-lg hover:bg-gray-400">Batal</a>
                <button type="submit"
                    class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection
