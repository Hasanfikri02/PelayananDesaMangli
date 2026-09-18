@extends('layouts.register')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 min-h-[650px]">

    {{-- LEFT FORM --}}
    <div class="flex justify-center items-center px-10 py-10
                bg-gradient-to-br from-teal-50 via-teal-100 to-teal-200">

        <div class="w-full max-w-md space-y-6
                    bg-white/70 backdrop-blur-xl shadow-xl rounded-2xl p-8 border border-white/50">

            {{-- Logo --}}
            <div class="text-center mb-4">
                <span class="text-3xl font-extrabold text-teal-700 tracking-wide">
                    Pelayanan Desa
                </span>
            </div>

            {{-- Judul --}}
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Buat Akun Baru</h2>
                <p class="text-gray-600 text-sm">
                    Daftar dan nikmati layanan desa secara digital
                </p>
            </div>

            {{-- Error --}}
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            {{-- FORM --}}
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                {{-- Nama --}}
<div>
    <x-input-label for="name" :value="__('Nama Lengkap')" />
    <x-text-input id="name" type="text" name="name"
        class="block mt-1 w-full rounded-xl border-gray-300
               bg-white text-black
               focus:bg-white focus:border-teal-600 focus:ring-teal-600"
        :value="old('name')" required autofocus />
</div>

{{-- NIK --}}
<div>
    <x-input-label for="nik" :value="__('Nomor NIK')" />
    <x-text-input id="nik" type="text" name="nik"
        class="block mt-1 w-full rounded-xl border-gray-300
               bg-white text-black
               focus:bg-white focus:border-teal-600 focus:ring-teal-600"
        :value="old('nik')" required />
</div>

{{-- Alamat --}}
<div>
    <x-input-label for="alamat" :value="__('Alamat Lengkap')" />
    <textarea id="alamat" name="alamat" rows="3"
        class="mt-1 w-full rounded-xl border-gray-300
               bg-white text-black
               focus:bg-white focus:border-teal-600 focus:ring-teal-600">{{ old('alamat') }}</textarea>
</div>

{{-- Email --}}
<div>
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" type="email" name="email"
        class="block mt-1 w-full rounded-xl border-gray-300
               bg-white text-black
               focus:bg-white focus:border-teal-600 focus:ring-teal-600"
        :value="old('email')" required />
</div>

{{-- Password --}}
<div>
    <x-input-label for="password" :value="__('Password')" />
    <x-text-input id="password" type="password" name="password"
        class="block mt-1 w-full rounded-xl border-gray-300
               bg-white text-black
               focus:bg-white focus:border-teal-600 focus:ring-teal-600"
        required />
</div>

{{-- Konfirmasi Password --}}
<div>
    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
    <x-text-input id="password_confirmation" type="password" name="password_confirmation"
        class="block mt-1 w-full rounded-xl border-gray-300
               bg-white text-black
               focus:bg-white focus:border-teal-600 focus:ring-teal-600"
        required />
</div>


                {{-- Submit --}}
                <button
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white py-3 rounded-xl font-semibold shadow-md transition">
                    Daftar Sekarang
                </button>

                {{-- Login --}}
                <div class="text-center pt-2">
                    <a href="{{ route('login') }}" class="text-sm text-teal-700 hover:text-teal-900">
                        Sudah punya akun? <span class="underline font-semibold">Login</span>
                    </a>
                </div>
            </form>

        </div>
    </div>

    {{-- RIGHT IMAGE PANEL --}}
    <div class="hidden md:flex relative overflow-hidden rounded-r-2xl min-h-[650px]">

        {{-- Background Image --}}
        <img src="{{ asset('assets/images/bg.jpg') }}"
             class="absolute inset-0 w-full h-full object-cover">

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-b from-teal-700/40 to-teal-900/60"></div>

    </div>

</div>

@endsection
