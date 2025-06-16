<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex justify-center">
                <img src="/build/assets/img/logo_posyandu-removebg-preview.png" class="w-12 h-12" alt="" />
            </div>
            <h2 class="text-center text-2xl font-bold text-black">
                Sistem Informasi Posyandu Ganggang
            </h2>
            <p class="text-center text-black">
                Kel. Kota Bambu Selatan, Kec. Palmerah - Jakarta Barat
            </p>
        </x-slot>

        <!-- Validation Errors -->
        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6 mt-6" id="login-form">
            @csrf

            {{-- <div>
                <label for="login_mode" class="block mb-2 text-sm font-medium text-gray-700">Login Sebagai</label>
                <select id="login_mode" name="login_mode"
                    class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500">
                    <option value="admin" selected>Admin / Kader</option>
                    <option value="orangtua">Orang Tua</option>
                </select>
            </div> --}}
            <div>
                <h1>login sebagai admin/kader</h1>
            </div>

            <div id="admin-fields">
                <x-label for="email" class="text-lg text-blue-600/50" value="Email" />
                <x-input id="email" class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    type="email" name="email" autofocus />
                
                <x-label for="password" class="text-lg text-blue-600/50 mt-4" value="Kata Sandi" />
                <x-input id="password" class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    type="password" name="password" />
            </div>

            <div id="orangtua-fields" class="hidden">
                <x-label for="nik_anak" class="text-lg text-blue-600/50" value="NIK Anak" />
                <x-input id="nik_anak" class="border text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    type="text" name="nik_anak" maxlength="16" />
            </div>

            <x-button class="w-full justify-center text-xl font-bold rounded-full px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white">
                Masuk
            </x-button>
        </form>
<div class="mt-4 text-center">
    <a href="{{ route('login.ortu') }}" class="text-blue-600 hover:underline text-sm">
        Login Sebagai Orang Tua?
    </a>
</div>

        <script>
            const modeSelect = document.getElementById('login_mode');
            const adminFields = document.getElementById('admin-fields');
            const orangtuaFields = document.getElementById('orangtua-fields');

            modeSelect.addEventListener('change', function () {
                if (this.value === 'orangtua') {
                    adminFields.classList.add('hidden');
                    orangtuaFields.classList.remove('hidden');
                } else {
                    adminFields.classList.remove('hidden');
                    orangtuaFields.classList.add('hidden');
                }
            });
        </script>
    </x-authentication-card>
</x-guest-layout>