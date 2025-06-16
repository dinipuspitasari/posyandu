@extends('layouts.admin')

@section('title', 'Tambah Data Orang Tua')

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
        <h2 class="text-xl font-semibold mb-4">Tambah Data Orang Tua</h2>

        <form action="{{ route('data_orang_tua.store') }}" method="POST">
            @csrf

            {{-- NIK ibu --}}
            <div class="mb-4">
                <label for="nik_ibu" class="block mb-2 text-sm font-medium text-gray-900">NIK Ibu<span class="text-red-500">*</span></label>
                <input placeholder="31754xxxx" type="text" name="nik_ibu" id="nik_ibu" maxlength="16"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    oninput="validateNIK(this)" required>
                <p id="nik-error" class="mt-1 text-sm text-red-600 hidden">Nik tidak boleh lebih dari 16 digit</p>
                @error('nik_ibu')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Script Validasi --}}
            <script>
                function validateNIK(input) {
                    const nikError = document.getElementById('nik-error');
                    input.value = input.value.replace(/[^0-9]/g, ''); // hanya angka
                    if (input.value.length > 16) {
                        input.classList.remove('border-gray-300', 'focus:ring-blue-500', 'focus:border-blue-500');
                        input.classList.add('border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
                        nikError.classList.remove('hidden');
                    } else {
                        input.classList.remove('border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
                        input.classList.add('border-gray-300', 'focus:ring-blue-500', 'focus:border-blue-500');
                        nikError.classList.add('hidden');
                    }
                }
            </script>

            {{-- Nama Ibu --}}
            <div class="mb-4">
                <label for="nama_ibu" class="block mb-2 text-sm font-medium text-gray-900">Nama Ibu<span class="text-red-500">*</span></label>
                <input placeholder="Masukkan nama ibu" type="text" name="nama_ibu" id="nama_ibu"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('nama_ibu')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- No Telpon --}}
            <div class="mb-4">
                <label for="no_telpon" class="block mb-2 text-sm font-medium text-gray-900">No Telpon<span class="text-red-500">*</span></label>
                <input type="tel" name="no_telpon" id="no_telpon" inputmode="numeric" pattern="[0-9]*"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required
                    maxlength="13" minlength="10" placeholder="Masukkan no telpon">
                    @error('no_telpon')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div class="mb-4">
                <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat<span class="text-red-500">*</span></label>
                <textarea placeholder="Masukkan alamat" name="alamat" id="alamat"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required></textarea>
                    @error('alamat')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Kembali & Simpan --}}
            <div class="flex justify-end space-x-2">
                <a href="{{ route('data_orang_tua.index') }}"
                    class="px-4 py-2 text-sm bg-white border-black border rounded-lg hover:bg-gray-400">Kembali</a>
                <button type="submit"
                    class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
@endsection
