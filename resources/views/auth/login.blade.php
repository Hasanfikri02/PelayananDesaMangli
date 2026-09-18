@extends('layouts.register') {{-- pakai layout yang sama dengan register untuk keseragaman --}}

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
                <h2 class="text-3xl font-bold text-gray-800">Masuk Akun</h2>
                <p class="text-gray-600 text-sm">
                    Masukkan email dan password Anda
                </p>
            </div>

            {{-- Session Status --}}
            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{-- Error --}}
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            {{-- FORM --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                {{-- Email --}}
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" type="email" name="email"
                        class="block mt-1 w-full rounded-xl border-gray-300
                               bg-white text-gray-800
                               focus:bg-white focus:border-teal-600 focus:ring-teal-600"
                        :value="old('email')" required autofocus autocomplete="username" />
                </div>

                {{-- Password --}}
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" type="password" name="password"
                        class="block mt-1 w-full rounded-xl border-gray-300
                               bg-white text-gray-800
                               focus:bg-white focus:border-teal-600 focus:ring-teal-600"
                        required autocomplete="current-password" />
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center mt-2">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-teal-600 focus:ring-teal-500"
                        name="remember">
                    <label for="remember_me" class="ms-2 text-gray-700 text-sm">Remember me</label>
                </div>

                {{-- Submit --}}
                <button
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white py-3 rounded-xl font-semibold shadow-md transition mt-4">
                    Log in
                </button>

                {{-- Forgot Password --}}
                @if (Route::has('password.request'))
                <div class="text-center pt-2">
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-teal-700 hover:text-teal-900 underline font-semibold">
                        Forgot your password?
                    </a>
                </div>
                @endif

                {{-- Register Link --}}
                <div class="text-center pt-2">
                    <a href="{{ route('register') }}"
                       class="text-sm text-teal-700 hover:text-teal-900 underline font-semibold">
                        Belum punya akun? Daftar sekarang
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

