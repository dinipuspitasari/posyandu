@extends('layouts.admin')

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
        <h2 class="text-xl font-semibold mb-4">Tambah Imunisasi</h2>

        <form action="{{ route('imunisasi.store') }}" method="POST">
            @csrf
            {{-- Input Nama Imunisasi --}}
            {{-- <div class="mb-4">
                <label for="name" class="block mb-1">
                    <span className='after:text-destructive text-sm font-semibold after:ml-0.5 after:content-["*"]'>Nama
                        Imunisasi</span>
                </label>
                <input type="text" name="name" id="name" class="form-control" required
                    value="{{ old('name') }}">
            </div> --}}

            {{-- Nama Imunisasi --}}
            <div class="mb-4">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Imunisasi<span
                        class="text-red-500">*</span></label>
                <input type="text" name="name" id="name"
                    class="border text-sm rounded-lg block w-full p2.5 focus:ring-blue-500 focus:border-blue-500" required
                    value="{{ old('name') }}">
                    @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Kembali & Simpan --}}
            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('imunisasi.index') }}"
                    class="px-4 py-2 text-sm bg-white border-black border rounded-lg hover:bg-gray-400">Kembali</a>
                <button type="submit" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
@endsection
