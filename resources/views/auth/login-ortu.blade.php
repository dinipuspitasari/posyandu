<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex justify-center">
                <img src="/build/assets/img/logo_posyandu-removebg-preview.png" class="w-12 h-12" alt="Logo" />
            </div>
            <h2 class="text-center text-2xl font-bold text-black">Login Orang Tua</h2>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.ortu.submit') }}" class="space-y-6 mt-6">
            @csrf
            <input type="hidden" name="login_mode" value="orangtua"> {{-- penting untuk Fortify custom --}}
            <div>
                <x-label for="nik_anak" class="text-lg text-blue-600/50" value="NIK Anak" />
                <x-input id="nik_anak" class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    type="text" name="nik_anak" maxlength="16" required autofocus />
            </div>

            <x-button class="w-full justify-center text-xl font-bold rounded-full px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white">
                Masuk
            </x-button>
        </form>
        <div class="mt-4 text-center">
    <a href="{{ route('login') }}" class="text-blue-600 hover:underline text-sm">
        Login Sebagai Kader?
    </a>
</div>
    </x-authentication-card>
</x-guest-layout>
