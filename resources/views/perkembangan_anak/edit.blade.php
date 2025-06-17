@extends('layouts.admin')

@section('title', 'Posyandu Ganggang | Edit Data Perkembangan Anak')

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
        <h2 class="text-xl font-semibold mb-6">Edit Data Perkembangan Anak</h2>

        <form action="{{ route('perkembangan_anak.update', $perkembangan->id_perkembangan_anak) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- NIK anak --}}
            <div class="mb-4">
                <label for="nik_anak" class="block mb-2 text-sm font-medium text-gray-900">NIK Anak<span
                        class="text-red-500">*</span></label>
                <input type="text" id="nik_anak" value="{{ $perkembangan->nik_anak }}" readonly
                    class="border text-sm text-gray-500 rounded-lg block w-full p-2.5">
                <input type="hidden" name="nik_anak" value="{{ $perkembangan->nik_anak }}">
                @error('nik_anak')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama anak --}}
            <div class="mb-4">
                <label for="nama_anak" class="block mb-2 text-sm font-medium text-gray-900">Nama Anak<span
                        class="text-red-500">*</span></label>
                <input type="text" id="nama_anak" value="{{ $perkembangan->nama_anak }}" readonly
                    class="border text-sm text-gray-500 rounded-lg block w-full p-2.5">
                <input type="hidden" name="nama_anak" value="{{ $perkembangan->nama_anak }}">
                @error('nama_anak')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal posyandu --}}
            <div class="mb-4">
                <label for="tanggal_posyandu" class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                    Posyandu<span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_posyandu" id="tanggal_posyandu"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('tanggal_posyandu', $perkembangan->tanggal_posyandu) }}" required>
                @error('tanggal_posyandu')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Berat badan --}}
            <div class="mb-4">
                <label for="berat_badan" class="block mb-2 text-sm font-medium text-gray-900">Berat Badan<span
                        class="text-red-500">*</span></label>
                <input placeholder="Masukkan berat badan" type="number" name="berat_badan" id="berat_badan" step="0.1"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('berat_badan', $perkembangan->berat_badan) }}" required>
                @error('berat_badan')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Keterangan berat badan --}}
            <div class="mb-4">
                <label for="keterangan_berat_badan" class="block mb-2 text-sm font-medium text-gray-900">Keterangan
                    Berat Badan<span class="text-red-500">*</span></label>
                <select name="keterangan_berat_badan" id="keterangan_berat_badan"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" selected hidden>-- Pilih --</option>
                    <option value="N" {{ $perkembangan->keterangan_berat_badan == 'N' ? 'selected' : '' }}>Naik
                        berat badan (N)
                    </option>
                    <option value="T" {{ $perkembangan->keterangan_berat_badan == 'T' ? 'selected' : '' }}>Tidak
                        naik atau tetap (T)
                        </option>
                    {{-- <option value="O" {{ $perkembangan->keterangan_berat_badan == 'O' ? 'selected' : '' }}>Bulan
                        lalu tidak menimbang (O)
                        </option> --}}
                    <option value="B" {{ $perkembangan->keterangan_berat_badan == 'B' ? 'selected' : '' }}>Baru
                        pertama kali datang (B)</option>
                </select>
                @error('keterangan_berat_badan')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tinggi badan --}}
            <div class="mb-4">
                <label for="tinggi_badan" class="block mb-2 text-sm font-medium text-gray-900">Tinggi Badan<span
                        class="text-red-500">*</span></label>
                <input placeholder="Masukkan tingi badan" type="number" name="tinggi_badan" id="tinggi_badan"
                    step="0.1"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('tinggi_badan', $perkembangan->tinggi_badan) }}" required>
                @error('tinggi_badan')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Lingkar lengan atas --}}
            <div class="mb-4">
                <label for="lingkar_lengan_atas" class="block mb-2 text-sm font-medium text-gray-900">Lingkar Lengan
                    Atas<span class="text-red-500">*</span></label>
                <input placeholder="Masukkan lingkar lengan atas" type="number" name="lingkar_lengan_atas"
                    id="lingkar_lengan_atas" step="0.1"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('lingkar_lengan_atas', $perkembangan->lingkar_lengan_atas) }}" required>
                @error('lingkar_lengan_atas')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Keterangan lingkar lengan --}}
            <div class="mb-4">
                <label for="keterangan_lingkar_lengan" class="block mb-2 text-sm font-medium text-gray-900">Keterangan
                    Lingkar Lengan<span class="text-red-500">*</span></label>
                <select name="keterangan_lingkar_lengan" id="keterangan_lingkar_lengan"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" selected hidden>-- Pilih --</option>
                    <option value="Hijau" {{ $perkembangan->keterangan_lingkar_lengan == 'Hijau' ? 'selected' : '' }}>
                        Hijau</option>
                    <option value="Merah" {{ $perkembangan->keterangan_lingkar_lengan == 'Merah' ? 'selected' : '' }}>
                        Merah</option>
                </select>
                @error('keterangan_lingkar_lengan')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Lingkar kepala --}}
            <div class="mb-4">
                <label for="lingkar_kepala" class="block mb-2 text-sm font-medium text-gray-900">Lingkar Kepala<span
                        class="text-red-500">*</span></label>
                <input placeholder="Masukkan lingkar kepala" type="number" name="lingkar_kepala" id="lingkar_kepala"
                    step="0.1"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('lingkar_kepala', $perkembangan->lingkar_kepala) }}" required>
                @error('lingkar_kepala')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Imunisasi --}}
            <div class="mb-4">
                <label for="id_imunisasi" class="block mb-2 text-sm font-medium text-gray-900">Jenis Imunisasi</label>
                <select name="id_imunisasi" id="id_imunisasi"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" selected disabled>-- Pilih Jenis Imunisasi --</option>
                    @foreach (\App\Models\Imunisasi::all() as $imunisasi)
                        <option value="{{ $imunisasi->id_imunisasi }}"
                            {{ old('id_imunisasi') == $imunisasi->id_imunisasi? 'selected' : '' }}>
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
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Pilih --</option>
                    <option value="Vitamin A" {{ old('pemberian') == 'Vitamin A' ? 'selected' : '' }}>Vitamin A
                    </option>
                    <option value="Obat Cacing" {{ old('pemberian') == 'Obat Cacing' ? 'selected' : '' }}>Obat Cacing
                    </option>
                    {{-- <option value="Tidak ada pemberian"
                            {{ old('pemberian') == 'Tidak ada pemberian' ? 'selected' : '' }}>
                            Tidak
                            ada pemberian obat cacing atau vitamin A
                        </option> --}}
                </select>
                @error('pemberian')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- MT pangan lokal --}}
            <div class="mb-4">
                <label for="mt_pangan_lokal" class="block mb-2 text-sm font-medium text-gray-900">MT Pangan
                    Lokal<span class="text-red-500">*</span></label>
                <select name="mt_pangan_lokal" id="mt_pangan_lokal"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="" selected hidden>-- Pilih --</option>
                    <option value="Y" {{ $perkembangan->mt_pangan_lokal == 'Y' ? 'selected' : '' }}>Ya</option>
                    <option value="T" {{ $perkembangan->mt_pangan_lokal == 'T' ? 'selected' : '' }}>Tidak
                    </option>
                </select>
                @error('mt_pangan_lokal')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Asi eksklusif --}}
            <div class="mb-4">
                <label for="asi_eksklusif" class="block mb-2 text-sm font-medium text-gray-900">ASI Eksklusif<span
                        class="text-red-500">*</span></label>
                <select name="asi_eksklusif" id="asi_eksklusif"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="" selected hidden>-- Pilih --</option>
                    <option value="Y" {{ $perkembangan->asi_eksklusif == 'Y' ? 'selected' : '' }}>Ya</option>
                    <option value="T" {{ $perkembangan->asi_eksklusif == 'T' ? 'selected' : '' }}>Tidak</option>
                </select>
                @error('asi_eksklusif')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Edukasi --}}
            <div class="md:col-span-2">
                <label for="edukasi" class="block mb-2 text-sm font-medium text-gray-900">Edukasi</label>
                <textarea placeholder="Masukkan edukasi" name="edukasi" id="edukasi" rows="2"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500">{{ old('edukasi', $perkembangan->edukasi) }}</textarea>
                @error('edukasi')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Rujuk --}}
            <div class="md:col-span-2">
                <label for="rujuk" class="block mb-2 text-sm font-medium text-gray-900">Rujuk</label>
                <textarea placeholder="Masukkan rujuk" name="rujuk" id="rujuk" rows="2"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500">{{ old('rujuk', $perkembangan->rujuk) }}</textarea>
                @error('rujuk')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol batal dan simpan perubahan --}}
            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('perkembangan_anak.index') }}"
                    class="px-4 py-2 text-sm bg-white border-black border rounded-lg hover:bg-gray-400">Batal</a>
                <button type="submit"
                    class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan
                    Perubahan</button>
            </div>
        </form>
    </div>
@endsection
