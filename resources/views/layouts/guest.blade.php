<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-poppins bg-gray-100 dark:bg-gray-900">

    {{-- NAVBAR --}}
    <nav class="fixed top-0 w-full bg-white/80 backdrop-blur-md shadow-sm z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-8 py-4">

            {{-- Logo --}}
            <div class="flex items-center space-x-3">
                <img src="{{ asset('assets/images/images.png') }}"
                    class="w-12 h-12 rounded-full object-cover shadow-md border-2 border-white">

                <div>
                    <h1 class="font-extrabold text-lg text-gray-800 leading-tight">Desa Mangli</h1>
                    <p class="text-sm text-gray-500 -mt-1">Kabupaten Pemalang</p>
                </div>
            </div>

            {{-- Menu --}}
            <div class="hidden md:flex items-center space-x-8 font-semibold">
                <a href="/" class="hover:text-teal-600 transition">Beranda</a>

                {{-- Jika user belum login --}}
                @guest
                    <a href="{{ route('login') }}" class="hover:text-teal-600 transition">
                        Pengajuan Surat
                    </a>

                    <a href="{{ route('login') }}" class="hover:text-teal-600 transition">
                        Pengaduan Warga
                    </a>
                @endguest


                {{-- Jika user sudah login --}}
                @auth
                    <a href="{{ route('warga.surat.index') }}" class="hover:text-teal-600 transition">
                        Pengajuan Surat
                    </a>

                    <a href="{{ route('warga.pengaduan.index') }}" class="hover:text-teal-600 transition">
                        Pengaduan Warga
                    </a>
                @endauth


                <a href="{{ route('warga.sensuswarga') }}" class="hover:text-teal-600 transition">
                    Sensus Penduduk
                </a>

            </div>

            {{-- Login/Register --}}
            @guest
                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') }}"
                        class="px-5 py-2 rounded-full font-semibold text-teal-600 border border-teal-600
                              hover:bg-teal-600 hover:text-white transition shadow-sm">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                        class="px-5 py-2 rounded-full font-semibold text-white bg-teal-600
                              hover:bg-teal-700 transition shadow-sm">
                        Register
                    </a>
                </div>
            @endguest

            {{-- User login --}}
            @auth
                <div class="flex items-center space-x-3">
                    <a href="{{ route('profile.edit') }}"
                        class="p-2 rounded-full hover:bg-gray-200 transition flex items-center justify-center">
                        <div class="bg-teal-600 rounded-full p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v1.2h19.2v-1.2c0-3.2-6.4-4.8-9.6-4.8z" />
                            </svg>
                        </div>
                    </a>
                </div>
            @endauth

        </div>
    </nav>

    {{-- WRAPPER HALAMAN --}}
    <div
        class="pt-40 pb-16 px-4
                bg-gradient-to-br from-gray-50 to-gray-200
                dark:from-gray-800 dark:to-gray-900 min-h-screen">

        <div class="max-w-7xl mx-auto">
            {{ $slot }}
        </div>

    </div>

</body>

</html>
