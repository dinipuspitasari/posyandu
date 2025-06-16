<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Posyandu Ganggang | Beranda</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    {{-- navigation bar start --}}
    <nav class="fixed w-full bg-white border-gray-200 shadow-md">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="build/assets/img/logo_posyandu-removebg-preview.png" class="h-10" alt="" />
                <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-gray-800">Posyandu
                    Ganggang</span>
            </a>
            <div class="flex items-center gap-2">
                <a href="/masuk"
                    class="text-white md:hidden bg-blue-400 hover:bg-blue-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Masuk</a>
                <button data-collapse-toggle="navbar-default" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg  md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 ">
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-gray-300 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-400 md:p-0">Beranda</a>
                    </li>
                    <li>
                        <a href="/tentang"
                            class="block py-2 px-3 text-gray-300 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-400 md:p-0">Tentang</a>
                    </li>
                        <li>
                        <a href="/layanan"
                            class="block py-2 px-3 text-gray-300 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-400 md:p-0">Layanan</a>
                    </li>
                        <li>
                        <a href="/kontak"
                            class="block py-2 px-3 text-gray-300 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-400 md:p-0">Kontak</a>
                    </li>
                    <li class="hidden md:block">
                        <a href="/login"
                            class="text-white bg-blue-400 hover:bg-blue-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Masuk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    {{-- navigation bar end --}}

    {{-- content selamat datang start --}}
    <section class="pt-28">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16" id="beranda">
            <div class="grid md:grid-cols-2">

                <div class="pt-10">
                    <div class="flex flex-col justify-center items-center">
                        <div class="px-4 py-6 ">
                            <h2 class="text-gray-900 text-3xl font-medium mb-8">Selamat Datang di Listrik Praktis</h2>
                            <br>
                            <p class="text-lg font-normal text-gray-900  mb-4">Nikmati kemudahan dan kenyamanan dalam
                                mengelola pembayaran tagihan listrik Anda dengan Listrik Praktis. Kami hadir untuk
                                memberikan solusi pembayaran yang cepat, mudah, dan aman hanya dalam beberapa langkah
                                sederhana. Dengan aplikasi kami, Anda tidak perlu lagi mengantre atau khawatir tentang
                                tagihan yang terlewat.</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center">
                        <img class="h-auto max-w-xs object cover" src="/assets/img/home1.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
        {{-- content selamat datang end --}}

        {{-- content mengapa kami start --}}
        <section>
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16" id="about">
                <div class="grid md:grid-cols-2">
                    <div class="flex items-center justify-center order-2 sm:order-none">
                        <img class="h-auto w-[450px] object cover" src="/assets/img/tim.jpg" alt="">
                    </div>
                    <div class="flex items-center order-1 sm:order-none">
                        <div class="px-4 py-6">
                            <h2 class="text-gray-900 text-3xl font-medium mb-2">Mengapa Kami?</h2>
                            <br>
                            <p class="text-lg font-normal text-gray-900  mb-4">Karena kami merupakan platform inovatif
                                yang
                                dirancang untuk
                                memudahkan Anda dalam mengelola dan membayar tagihan listrik.
                                <br> Kami memahami betapa pentingnya
                                kenyamanan dan efisiensi dalam kehidupan sehari-hari, oleh karena itu kami hadir untuk
                                memberikan
                                solusi yang cepat, aman, dan mudah diakses.
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- content mengapa kami end --}}

        {{-- content visi dan misi start --}}
        <section>
            <div class="py-3 px-4 mx-auto max-w-screen-xl lg:py-3">
                <div class="grid md:grid-cols-2">

                    <div class="flex-col flex justify-center items-center">
                        <div class="px-4 py-6 ">
                            <h2 class="text-gray-900 text-3xl font-medium mb-2">Visi dan Misi</h2>
                            <br>
                            <p class="text-lg font-normal text-gray-900  mb-4">Visi kami adalah menciptakan dunia di
                                mana
                                pembayaran tagihan listrik menjadi tugas yang sederhana dan bebas stres bagi setiap
                                orang.
                                Kami berkomitmen untuk menyediakan layanan terbaik yang mengedepankan kenyamanan
                                pengguna.
                                <br>
                                </br>Misi kami adalah memberikan kemudahan dan keandalan dalam setiap transaksi, serta
                                memastikan bahwa setiap pengguna dapat mengelola pembayaran listriknya dengan efisien
                                tanpa
                                hambatan.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center">
                        <img class="h-80" src="/assets/img/visi_misi.jpg" alt="">
                    </div>
                </div>
            </div>
        </section>
        {{-- content visi dan misi end --}}

        {{-- footer start --}}
        <hr>
        <footer class="bg-yellow-400">
            <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
                <div class="md:flex md:justify-between">
                    <div class="mb-6 md:mb-0">
                        <img src="/assets/img/lispra_full_white.png" class="h-16 me-3" alt="" />
                        <h2 class="mb-6 text-sm font-normal text-white uppercas px-2">Lispra
                            (Listrik Praktis)
                            adalah solusi digital yang memudahkan <br> Anda dalam membayar tagihan
                            listrik bulanan.
                            Dengan aplikasi ini, <br> Anda dapat melakukan pembayaran tagihan
                            listrik secara cepat dan aman.
                        </h2>
                        </a>
                        <div class="flex">
                            <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M7.978 4a2.553 2.553 0 0 0-1.926.877C4.233 6.7 3.699 8.751 4.153 10.814c.44 1.995 1.778 3.893 3.456 5.572 1.68 1.679 3.577 3.018 5.57 3.459 2.062.456 4.115-.073 5.94-1.885a2.556 2.556 0 0 0 .001-3.861l-1.21-1.21a2.689 2.689 0 0 0-3.802 0l-.617.618a.806.806 0 0 1-1.14 0l-1.854-1.855a.807.807 0 0 1 0-1.14l.618-.62a2.692 2.692 0 0 0 0-3.803l-1.21-1.211A2.555 2.555 0 0 0 7.978 4Z" />
                            </svg>
                            <span class="text-sm text-white px-1">+62 81269580000</span>
                        </div>
                        <div class="flex pt-2">
                            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" width="1em"
                                height="1em" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M4 20q-.825 0-1.412-.587T2 18V6q0-.825.588-1.412T4 4h16q.825 0 1.413.588T22 6v12q0 .825-.587 1.413T20 20zm8-7l8-5V6l-8 5l-8-5v2z" />
                            </svg>
                            <span class="text-sm text-white px-2">lispra@gmail.com</span>
                        </div>
                        <div class="flex pt-2">
                            <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm text-white px-1">Jl. K.H. Nasir No.24A 9, RT.9/RW.5, Srengseng, Kec.
                                Kembangan,<br>
                                Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11630</span>
                        </div>


                    </div>
                    <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-white uppercase">Navigasi</h2>
                            <ul class="text-white font-medium">
                                <li class="mb-4">
                                    <a href="/" class="hover:underline">Beranda</a>
                                </li>
                                <li class="mb-4">
                                    <a href="/tentang" class="hover:underline">Tentang</a>
                                </li>
                                <li class="mb-4">
                                    <a href="/login" class="hover:underline">Masuk</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto" />
                <div class="sm:flex sm:items-center sm:justify-between">
                    <span class="text-sm text-white sm:text-center">© 2024 <a href=""
                            class="">Lispra™</a>.
                        All Rights Reserved.
                    </span>
                    <div class="flex mt-4 sm:justify-center sm:mt-0 gap-4">
                        <a href="#" class="text-white hover:text-yellow-500">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 8 19">
                                <path fill-rule="evenodd"
                                    d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Facebook page</span>
                        </a>
                        <a href="#" class="text-white hover:text-yellow-500">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 21 16">
                                <path
                                    d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z" />
                            </svg>
                            <span class="sr-only">Discord community</span>
                        </a>
                        <a href="#" class="text-white hover:text-yellow-500">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 17">
                                <path fill-rule="evenodd"
                                    d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Twitter page</span>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
        {{-- footer end --}}


        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
