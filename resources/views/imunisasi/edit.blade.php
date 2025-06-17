@extends('layouts.admin')

@section('title', 'Posyandu Ganggang | Edit Imunisasi')

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
        <h2 class="text-xl font-semibold mb-6">Edit Imunisasi</h2>

        <form action="{{ route('imunisasi.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Imunisasi --}}
            <div class="mb-4">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Imunisasi<span
                        class="text-red-500">*</span></label>
                <input type="text" name="name" id="name"
                    class="border text-sm rounded-lg block w-full p2.5 focus:ring-blue-500 focus:border-blue-500" required
                    value="{{ old('name', $item->name) }}">
                      @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Batal & simpan Perubahan --}}
            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('imunisasi.index') }}"
                    class="px-4 py-2 text-sm bg-white border-black border rounded-lg hover:bg-gray-400">Batal</a>
                <button type="submit" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan
                    Perubahan</button>
            </div>
        </form>
    </div>
@endsection
