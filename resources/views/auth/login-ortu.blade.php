<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex justify-center">
                <img src="/assets/logo.jpeg" class="w-10 h-10 "alt="" />
            </div>
            <h2 class="text-center text-2xl font-bold text-black">Sistem Informasi Posyandu Ganggang</h2>
            <p class="text-center text-black">Kel. Kota Bambu Selatan, Kec. Palmerah - Jakarta Barat</p>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div>
            <h1 class="text-sm font-semibold text-black">Lihat Perkembangan Anak</h1>
        </div>

        <form method="POST" action="{{ route('login.ortu.submit') }}" class="space-y-6 mt-6">
            @csrf
            <input type="hidden" name="login_mode" value="orangtua"> {{-- penting untuk Fortify custom --}}
            <div>
                <x-label for="nik_anak" class="text-lg text-blue-600/50" value="NIK Anak" />
                <x-input placeholder="Masukkan NIK anak" id="nik_anak"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    type="text" name="nik_anak" maxlength="16" required autofocus />
            </div>

            <x-button
                class="w-full justify-center text-xl font-bold rounded-full px-5 py-3 bg-blue-500 hover:bg-blue-500 text-white">
                Masuk
            </x-button>
        </form>
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline text-sm">
                Login Sebagai Admin/Kader?
            </a>
        </div>
    </x-authentication-card>
</x-guest-layout>
