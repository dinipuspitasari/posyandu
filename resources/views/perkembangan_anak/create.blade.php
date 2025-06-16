@extends('layouts.admin')

@section('title', 'Tambah Data Perkembangan Anak')

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
        <h2 class="text-xl font-semibold mb-4">Tambah Data Perkembangan Anak</h2>

        <form action="{{ route('perkembangan_anak.store') }}" method="POST">
            @csrf

            {{-- NIK Anak --}}
            <div class="mb-4">
                <label for="nik_anak" class="block mb-2 text-sm font-medium text-gray-900">NIK Anak<span
                        class="text-red-500">*</span></label>
                <select name="nik_anak" id="nik_anak"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" selected>Pilih NIK Anak</option>
                    @foreach ($dataAnak as $anak)
                        <option value="{{ $anak->nik_anak }}" {{ old('nik_anak') == $anak->nik_anak ? 'selected' : '' }}>
                            {{ $anak->nik_anak }}
                        </option>
                    @endforeach
                </select>
                @error('nik_anak')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama Anak --}}
            <div class="mb-4">
                <label for="nama_anak" class="block mb-2 text-sm font-medium text-gray-900">Nama Anak<span
                        class="text-red-500">*</span></label>
                <select name="nama_anak" id="nama_anak"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" selected>Pilih Nama Anak</option>
                    @foreach ($dataAnak as $anak)
                        <option value="{{ $anak->nama_anak }}" {{ old('nama_anak') == $anak->nama_anak ? 'selected' : '' }}>
                            {{ $anak->nama_anak }}
                        </option>
                    @endforeach
                </select>
                @error('nama_anak')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>


            {{-- Tanggal Posyandu --}}
            <div class="mb-4">
                <label for="tanggal_posyandu" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Posyandu<span
                        class="text-red-500">*</span></label>
                <input type="date" name="tanggal_posyandu" id="tanggal_posyandu"
                    class=" border text-sm rounded-lg block w-full p2.5 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('tanggal_posyandu') }}">
                @error('tanggal_posyandu')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Berat Badan --}}
            <div class="mb-4">
                <label for="berat_badan" class="block mb-2 text-sm font-medium text-gray-900">Berat Badan (kg)<span
                        class="text-red-500">*</span></label>
                <input placeholder="Masukkan berat badan" type="number" step="0.1" name="berat_badan" id="berat_badan"
                    class="border text-sm rounded-lg block w-full p2.5 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('berat_badan') }}">
                @error('berat_badan')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Keterangan Berat Badan --}}
            <div class="mb-4">
                <label for="keterangan_berat_badan" class="block mb-2 text-sm font-medium text-gray-900">Keterangan Berat
                    Badan<span class="text-red-500">*</span></label>
                <select name="keterangan_berat_badan" id="keterangan_berat_badan"
                    class="border text-sm rounded-lg block w-full p2.5 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" selected hidden>-- Pilih --</option>
                    <option value="N" {{ old('keterangan_berat_badan') == 'N' ? 'selected' : '' }}>Naik berat badan
                        (N)</option>
                    <option value="T" {{ old('keterangan_berat_badan') == 'T' ? 'selected' : '' }}>Tidak naik atau
                        tetap (T)</option>
                    <option value="O" {{ old('keterangan_berat_badan') == 'O' ? 'selected' : '' }}>Bulan lalu tidak
                        menimbang (O)</option>
                    <option value="B" {{ old('keterangan_berat_badan') == 'B' ? 'selected' : '' }}>Baru pertama kali
                        datang (B)</option>
                </select>
                @error('keterangan_berat_badan')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tinggi Badan --}}
            <div class="mb-4">
                <label for="tinggi_badan" class="block mb-2 text-sm font-medium text-gray-900">Tinggi Badan (cm)<span
                        class="text-red-500">*</span></label>
                <input placeholder="Masukkan tinggi badan" type="number" step="0.1" name="tinggi_badan"
                    id="tinggi_badan"
                    class="border text-sm rounded-lg block w-full p2.5 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('tinggi_badan') }}">
                @error('tinggi_badan')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Lingkar Lengan Atas --}}
            <div class="mb-4">
                <label for="lingkar_lengan_atas" class="block mb-2 text-sm font-medium text-gray-900">Lingkar Lengan Atas
                    (cm)<span class="text-red-500">*</span></label>
                <input placeholder="Masukkan lingkar lengan atas" type="number" step="0.1" name="lingkar_lengan_atas"
                    id="lingkar_lengan_atas"
                    class="border text-sm rounded-lg block w-full p2.5 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('lingkar_lengan_atas') }}">
                @error('lingkar_lengan_atas')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Keterangan Lingkar Lengan --}}
            <div class="mb-4">
                <label for="keterangan_lingkar_lengan" class="block mb-2 text-sm font-medium text-gray-900">Keterangan
                    Lingkar Lengan<span class="text-red-500">*</span></label>
                <select name="keterangan_lingkar_lengan" id="keterangan_lingkar_lengan"
                    class="border text-sm rounded-lg block w-full p2.5 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" selected hidden>-- Pilih --</option>
                    <option value="Hijau" {{ old('keterangan_lingkar_lengan') == 'Hijau' ? 'selected' : '' }}>Hijau
                    </option>
                    <option value="Merah" {{ old('keterangan_lingkar_lengan') == 'Merah' ? 'selected' : '' }}>Merah
                    </option>
                </select>
                @error('keterangan_lingkar_lengan')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Lingkar Kepala --}}
            <div class="mb-4">
                <label for="lingkar_kepala" class="block mb-2 text-sm font-medium text-gray-900">Lingkar Kepala (cm)<span
                        class="text-red-500">*</span></label>
                <input placeholder="Masukkan lingkar kepala" type="number" step="0.1" name="lingkar_kepala"
                    id="lingkar_kepala"
                    class="border text-sm rounded-lg block w-full p2.5 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('lingkar_kepala') }}">
                @error('lingkar_kepala')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Imunisasi --}}
            <div class="mb-4">
                <label for="id_imunisasi" class="block mb-2 text-sm font-medium text-gray-900">Jenis Imunisasi</label>
                <select name="id_imunisasi" id="id_imunisasi"
                    class="border text-sm rounded-lg block w-full p2.5 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" selected disabled>-- Pilih Jenis Imunisasi --</option>
                    @foreach (\App\Models\Imunisasi::all() as $imunisasi)
                        <option value="{{ $imunisasi->id_imunisasi }}"
                            {{ old('id_imunisasi') == $imunisasi->id_imunisasi ? 'selected' : '' }}>
                            {{ $imunisasi->name }}
                        </option>
                    @endforeach
                </select>
                @error('id_imunisasi')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pemberian --}}
            <div class="mb-4">
                <label for="pemberian" class="block mb-2 text-sm font-medium text-gray-900">Pemberian</label>
                <select name="pemberian" id="pemberian"
                    class="border text-sm rounded-lg block w-full p2.5 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Pilih --</option>
                    <option value="Vitamin A" {{ old('pemberian') == 'Vitamin A' ? 'selected' : '' }}>Vitamin A</option>
                    <option value="Obat Cacing" {{ old('pemberian') == 'Obat Cacing' ? 'selected' : '' }}>Obat Cacing
                    </option>
                    {{-- <option value="Tidak ada pemberian" {{ old('pemberian') == 'Tidak ada pemberian' ? 'selected' : '' }}>
                        Tidak
                        ada pemberian obat cacing atau vitamin A
                    </option> --}}
                </select>
                @error('pemberian')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- MT Pangan Lokal --}}
            <div class="mb-4">
                <label for="mt_pangan_lokal" class="block mb-2 text-sm font-medium text-gray-900">MT Pangan Lokal<span
                        class="text-red-500">*</span></label>
                <select name="mt_pangan_lokal" id="mt_pangan_lokal"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" selected hidden>-- Pilih --</option>
                    <option value="Y" {{ old('mt_pangan_lokal') == 'Y' ? 'selected' : '' }}>Ya</option>
                    <option value="T" {{ old('mt_pangan_lokal') == 'T' ? 'selected' : '' }}>Tidak</option>
                </select>
                @error('mt_pangan_lokal')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>


            {{-- ASI Eksklusif --}}
            <div class="mb-4">
                <label for="asi_eksklusif" class="block mb-2 text-sm font-medium text-gray-900">ASI Eksklusif<span
                        class="text-red-500">*</span></label>
                <select name="asi_eksklusif" id="asi_eksklusif"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" selected hidden>-- Pilih --</option>
                    <option value="Y" {{ old('asi_eksklusif') == 'Y' ? 'selected' : '' }}>Ya</option>
                    <option value="T" {{ old('asi_eksklusif') == 'T' ? 'selected' : '' }}>Tidak</option>
                </select>
                @error('asi_eksklusif')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Edukasi --}}
            <div class="mb-4">
                <label for="edukasi" class="block mb-2 text-sm font-medium text-gray-900">Edukasi</label>
                <textarea placeholder="Masukkan edukasi" name="edukasi" id="edukasi" rows="2"
                    class="border text-sm rounded-lg block w-full p2.5 focus:ring-blue-500 focus:border-blue-500">{{ old('edukasi') }}</textarea>
                @error('edukasi')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Rujuk --}}
            <div class="mb-4">
                <label for="rujuk" class="block mb-2 text-sm font-medium text-gray-900">Rujuk</label>
                <textarea placeholder="Masukkan rujuk" name="rujuk" id="rujuk" rows="2"
                    class="border text-sm rounded-lg block w-full p2.5 focus:ring-blue-500 focus:border-blue-500">{{ old('rujuk') }}</textarea>
                @error('rujuk')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Kembali & Simpan --}}
            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('perkembangan_anak.index') }}"
                    class="px-4 py-2 text-sm bg-white border-black border rounded-lg hover:bg-gray-400">Batal</a>
                <button type="submit"
                    class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
@endsection
