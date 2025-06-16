@extends('layouts.admin')

@section('title', 'Tambah Petugas')

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
        <h2 class="text-xl font-semibold mb-4">Tambah Petugas</h2>

        <form action="{{ route('petugas.store') }}" method="POST">
            @csrf

             {{-- Nama petugas --}}
            <div class="mb-4">
                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Petugas<span
                        class="text-red-500">*</span></label>
                <input placeholder="Masukkan nama petugas" type="text" name="nama" id="nama" value="{{ old('nama') }}"
                    class="border text-sm rounded-lg block w-full p2.5 focus:ring-blue-500 focus:border-blue-500" required>
                @error('nama')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email<span
                        class="text-red-500">*</span></label>
                <input placeholder="Masukkan email" type="text" name="email" id="email" value="{{ old('email') }}"
                    class="border text-sm rounded-lg block w-full p2.5 focus:ring-blue-500 focus:border-blue-500" required>
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            {{-- <div class="mb-4">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                <input type="password" name="password" id="password"
                    class="border text-sm rounded-lg block w-full p2.5 focus:ring-blue-500 focus:border-blue-500" required>
            </div> --}}

            {{-- Id Level --}}
            <div class="mb-4">
                <label for="id_level" class="block mb-2 text-sm font-medium text-gray-900">
                    Level ID<span class="text-red-500">*</span>
                </label>
                <select name="id_level" id="id_level"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" selected hidden>-- Pilih Level --</option>
                    <option value="1" {{ old('id_level') == '1' ? 'selected' : '' }}>Admin</option>
                    <option value="2" {{ old('id_level') == '2' ? 'selected' : '' }}>Kader</option>
                </select>
                @error('id_level')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>


            {{-- Tombol kembali & simpan --}}
            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('petugas.index') }}"
                    class="px-4 py-2 text-sm bg-white border-black border rounded-lg hover:bg-gray-400">Kembali</a>
                <button type="submit" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
@endsection
