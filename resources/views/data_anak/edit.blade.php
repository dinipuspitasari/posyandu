@extends('layouts.admin')

@section('title', 'Posyandu Ganggang | Edit Data Anak')

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
        <h2 class="text-xl font-semibold mb-4">Edit Data Anak</h2>

        <form action="{{ route('data_anak.update', $anak->id_data_anak) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- NIK anak --}}
            <div class="mb-4">
                <label for="nik_anak" class="block mb-2 text-sm font-medium text-gray-900">NIK Anak<span
                        class="text-red-500">*</span></label>
                <input placeholder="Masukkan NIK anak" type="text" name="nik_anak" id="nik_anak"
                    value="{{ old('nik_anak', $anak->nik_anak) }}" maxlength="16"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    oninput="validateNIK(this)">
                <p id="nik-error" class="mt-1 text-sm text-red-600 hidden">Nik tidak boleh lebih dari 16 digit </p>
                @error('nik_anak')
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
                <label for="id_data_orang_tua" class="block mb-2 text-sm font-medium text-gray-900">Nama Ibu<span
                        class="text-red-500">*</span></label>
                <select id="id_data_orang_tua" name="id_data_orang_tua"
                    class="select2 border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    required>
                </select>
                @error('id_data_orang_tua')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama anak --}}
            <div class="mb-4">
                <label for="nama_anak" class="block mb-2 text-sm font-medium text-gray-900">Nama Anak<span
                        class="text-red-500">*</span></label>
                <input placeholder="Masukkan nama anak" type="text" name="nama_anak" id="nama_anak"
                    value="{{ old('nama_anak', $anak->nama_anak) }}"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            {{-- Tempat lahir --}}
            <div class="mb-4">
                <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tempat Lahir<span
                        class="text-red-500">*</span></label>
                <input placeholder="Masukkan tempat lahir" type="text" name="tempat_lahir" id="tempat_lahir"
                    value="{{ old('tempat_lahir', $anak->tempat_lahir) }}"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            {{-- Tanggal lahir --}}
            <div class="mb-4">
                <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir<span
                        class="text-red-500">*</span></label>
                <input placeholder="Masukkan tanggal lahir" type="date" name="tanggal_lahir" id="tanggal_lahir"
                    value="{{ old('tanggal_lahir', $anak->tanggal_lahir) }}"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            {{-- Jenis kelamin --}}
            <div class="mb-4">
                <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900">
                    Jenis Kelamin <span class="text-red-500">*</span>
                </label>
                <fieldset>
                    <legend class="sr-only">Jenis Kelamin</legend>
                    <div class="flex items-center mb-4">
                        <input id="laki-laki" type="radio" name="jenis_kelamin" value="1"
                            {{ old('jenis_kelamin', $anak->jenis_kelamin) == '1' ? 'checked' : '' }}
                            class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300">
                        <label for="laki-laki" class="block ms-2 text-sm font-medium text-gray-900">
                            Laki-laki
                        </label>
                    </div>
                    <div class="flex items-center mb-4">
                        <input id="perempuan" type="radio" name="jenis_kelamin" value="2"
                            {{ old('jenis_kelamin', $anak->jenis_kelamin) == '2' ? 'checked' : '' }}
                            class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300">
                        <label for="perempuan" class="block ms-2 text-sm font-medium text-gray-900">
                            Perempuan
                        </label>
                    </div>
                    @error('jenis_kelamin')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>
            </div>


            {{-- Tombol batal & simpan perubahan --}}
            <div class="flex justify-end space-x-2">
                <a href="{{ route('data_anak.index') }}"
                    class="px-4 py-2 text-sm bg-white border-black border rounded-lg hover:bg-gray-400">Batal</a>
                <button type="submit" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan
                    Perubahan</button>
            </div>
        </form>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


        <script>
            $(document).ready(function() {
                $('#id_data_orang_tua').select2({
                    placeholder: 'Masukkan nama ibu...',
                    minimumInputLength: 2,
                    width: '100%', // Paksa lebar penuh
                    dropdownAutoWidth: true,
                    ajax: {
                        url: '/cari-nama-ibu',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data
                            };
                        },
                        cache: true
                    }
                });

                // Paksa samakan tinggi Select2 dengan input Tailwind
                setTimeout(function() {
                    $('.select2-selection').css({
                        'height': '42px',
                        'padding': '8px 12px',
                        'border-radius': '0.5rem',
                        'border': '0.5px solid #000000',
                        'font-size': '0.875rem'
                    });
                }, 300)
            });
        </script>
    </div>
@endsection
