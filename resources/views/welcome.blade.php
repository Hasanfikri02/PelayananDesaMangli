<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Desa Mangli</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 antialiased">
    {{-- NAVBAR --}}
    <nav class="fixed top-0 w-full bg-white/80 backdrop-blur-md shadow-sm z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-8 py-4">
            {{-- Logo & Nama Desa --}}
            <div class="flex items-center space-x-3">
                <img src="{{ asset('assets/images/images.png') }}" alt="Logo Desa"
                    class="w-12 h-12 rounded-full object-cover shadow-md border-2 border-white">

                <div>
                    <h1 class="font-extrabold text-lg text-gray-800 leading-tight">Desa Mangli</h1>
                    <p class="text-sm text-gray-500 -mt-1">Kabupaten Pemalang</p>
                </div>
            </div>


            {{-- Menu --}}
            <div class="hidden md:flex items-center space-x-8 font-semibold">
                <a href="#sensus" class="hover:text-teal-600 transition flex items-center gap-1">
                    Beranda
                </a>
                @auth
                    <a href="{{ route('warga.surat.index') }}"
                        class="hover:text-teal-600 transition flex items-center gap-1">
                        Pengajuan Surat
                    </a>

                    <a href="{{ route('warga.pengaduan.index') }}"
                        class="hover:text-teal-600 transition flex items-center gap-1">
                        Pengaduan Warga
                    </a>
                    <a href="{{ route('warga.sensuswarga') }}" class="hover:text-teal-600 transition flex items-center gap-1">
                        Sensus Penduduk
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-teal-600 transition flex items-center gap-1">
                        Pengajuan Surat
                    </a>
                    <a href="{{ route('login') }}" class="hover:text-teal-600 transition flex items-center gap-1">
                        Pengaduan Warga
                    </a>
                    <a href="{{ route('login') }}" class="hover:text-teal-600 transition flex items-center gap-1">
                        Sensus Penduduk
                    </a>
                @endauth

                </a>
            </div>

            {{-- Login/Register --}}
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




    </nav>

    {{-- HERO SECTION --}}
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <img src="{{ asset('assets/images/mangli.jpg') }}" alt="Latar Desa"
            class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 to-black/60"></div>

        <div class="relative text-center text-white max-w-3xl px-6 mt-16">
            <div class="bg-white/20 backdrop-blur-md inline-block px-6 py-2 rounded-full mb-6">
                <span class="text-sm font-semibold text-teal-200">PELAYANAN MASYARAKAT</span>
            </div>

            <h1 class="text-5xl md:text-6xl font-extrabold leading-tight drop-shadow-lg">
                Selamat Datang di <span class="text-teal-600">Layanan Desa Digital</span>
            </h1>


            <p class="text-gray-100 text-lg mt-5 mb-10">
                Sistem pelayanan terpadu untuk memudahkan warga dalam mengajukan surat, menyampaikan pengaduan,
                serta melakukan sensus penduduk secara cepat dan efisien.
            </p>

            <div class="flex justify-center gap-5">
                <a href="#"
                    class="bg-teal-600 hover:bg-teal-700 text-white px-8 py-3 rounded-full font-semibold shadow-lg transition">
                    Mulai layanan
                </a>
                <a href="#"
                    class="bg-white hover:bg-gray-100 text-gray-800 px-8 py-3 rounded-full font-semibold shadow-lg transition">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </section>

    {{-- FITUR UTAMA --}}
    <section class="py-24 bg-gradient-to-b from-white to-gray-50 relative overflow-hidden">
        {{-- Dekorasi Latar --}}
        <div class="absolute top-0 left-0 w-40 h-40 bg-teal-100 rounded-full blur-3xl opacity-40"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-blue-100 rounded-full blur-3xl opacity-30"></div>

        <div class="max-w-6xl mx-auto text-center px-6 relative z-10">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">
                🌿 Layanan Digital Desa <span class="text-teal-600">Mangli</span>
            </h2>
            <p class="text-gray-500 max-w-2xl mx-auto mb-14">
                Nikmati berbagai layanan publik desa secara cepat, mudah, dan transparan melalui sistem digital terpadu.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                {{-- Pengajuan Surat --}}
                <div
                    class="group bg-white p-8 rounded-2xl shadow-lg hover:-translate-y-2 hover:shadow-2xl transition-all duration-300">
                    <div class="text-5xl mb-5 text-teal-600 group-hover:scale-110 transition-transform">📄</div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800 group-hover:text-teal-600 transition-colors">
                        Pengajuan Surat</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Ajukan berbagai surat seperti domisili, pengantar nikah, atau izin usaha dengan proses online
                        yang mudah.
                    </p>
                </div>

                {{-- Pengaduan --}}
                <div
                    class="group bg-white p-8 rounded-2xl shadow-lg hover:-translate-y-2 hover:shadow-2xl transition-all duration-300">
                    <div class="text-5xl mb-5 text-teal-600 group-hover:scale-110 transition-transform">💬</div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800 group-hover:text-teal-600 transition-colors">
                        Pengaduan Warga</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Sampaikan keluhan atau aspirasi langsung kepada perangkat desa dengan transparansi dan kecepatan
                        respon.
                    </p>
                </div>

                {{-- Sensus --}}
                <div
                    class="group bg-white p-8 rounded-2xl shadow-lg hover:-translate-y-2 hover:shadow-2xl transition-all duration-300">
                    <div class="text-5xl mb-5 text-teal-600 group-hover:scale-110 transition-transform">👨‍👩‍👧‍👦
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800 group-hover:text-teal-600 transition-colors">Sensus
                        Penduduk</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Data keluarga dan individu dikelola secara digital untuk mendukung akurasi administrasi
                        kependudukan desa.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="jenis-surat" class="py-24 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-6">
                📑 Daftar Jenis Surat Desa Mangli
            </h2>
            <p class="text-gray-500 mb-14 max-w-2xl mx-auto">
                Berikut daftar semua jenis surat yang tersedia di sistem layanan digital Desa Mangli.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 text-left">
                @forelse ($surat as $item)
                    <div class="bg-white p-6 rounded-2xl shadow-md hover:-translate-y-2 hover:shadow-xl transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="font-bold text-lg text-gray-800">{{ $item->nama_surat }}</h3>
                            @if ($item->is_active)
                                <span
                                    class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-semibold">Aktif</span>
                            @else
                                <span
                                    class="bg-gray-200 text-gray-600 text-xs px-3 py-1 rounded-full font-semibold">Nonaktif</span>
                            @endif
                        </div>

                        <p class="text-gray-600 text-sm leading-relaxed">
                            {{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}
                        </p>
                    </div>
                @empty
                    <p class="text-gray-500 col-span-full">Belum ada jenis surat.</p>
                @endforelse
            </div>
        </div>
    </section>


    {{-- 🧭 TATA CARA PENGAJUAN --}}
    <section id="tata-cara" class="py-24 bg-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-40 h-40 bg-teal-100 rounded-full blur-3xl opacity-40"></div>
        <div class="max-w-6xl mx-auto px-6 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">🧭 Tata Cara Pengajuan Surat & Pengaduan
            </h2>
            <p class="text-gray-500 mb-14 max-w-2xl mx-auto">
                Berikut langkah-langkah mudah untuk mengajukan surat atau menyampaikan pengaduan secara online.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 text-left">
                {{-- Pengajuan Surat --}}
                <div class="bg-gray-50 p-8 rounded-2xl shadow-md hover:shadow-xl transition-all">
                    <h3 class="text-xl font-bold mb-4 text-teal-700">📄 Pengajuan Surat</h3>
                    <ol class="list-decimal list-inside text-gray-600 text-sm space-y-2">
                        <li>Buka menu <strong>Pengajuan Surat</strong> di halaman utama.</li>
                        <li>Pilih jenis surat yang ingin diajukan.</li>
                        <li>Isi formulir pengajuan dengan data yang benar dan lengkap.</li>
                        <li>Unggah dokumen pendukung jika diperlukan.</li>
                        <li>Kirim permohonan dan tunggu konfirmasi dari perangkat desa.</li>
                    </ol>
                </div>

                {{-- Pengaduan Warga --}}
                <div class="bg-gray-50 p-8 rounded-2xl shadow-md hover:shadow-xl transition-all">
                    <h3 class="text-xl font-bold mb-4 text-teal-700">💬 Pengaduan Warga</h3>
                    <ol class="list-decimal list-inside text-gray-600 text-sm space-y-2">
                        <li>Buka menu <strong>Pengaduan</strong> di website desa.</li>
                        <li>Isi form pengaduan dengan informasi yang jelas dan sopan.</li>
                        <li>Tambahkan foto atau bukti pendukung (opsional).</li>
                        <li>Kirim laporan, dan sistem akan mengirim notifikasi ke admin desa.</li>
                        <li>Admin desa akan menindaklanjuti laporan Anda dengan transparan.</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    {{-- 🌍 LOKASI DESA --}}
    <section id="lokasi" class="py-24 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
        {{-- Dekorasi latar lembut --}}
        <div class="absolute top-0 left-0 w-40 h-40 bg-teal-100 rounded-full blur-3xl opacity-40"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-blue-100 rounded-full blur-3xl opacity-30"></div>

        <div class="max-w-6xl mx-auto px-6 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">📍 Lokasi Kantor Desa Mangli</h2>
            <p class="text-gray-500 mb-10 max-w-2xl mx-auto">
                Temukan lokasi Kantor Desa Mangli untuk mendapatkan pelayanan langsung dari perangkat desa kami.
            </p>
            <div class="w-full h-[450px] rounded-3xl overflow-hidden shadow-2xl ring-4 ring-white/50">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15838.04516201641!2d109.33547495!3d-7.06656005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fe8fedede024d%3A0x8558615eed528e2e!2sMangli%2C%20Kec.%20Randudongkal%2C%20Kabupaten%20Pemalang%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1762954133502!5m2!1sid!2sid"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

    {{-- ☎️ KONTAK & JAM PELAYANAN --}}
    <section id="kontak" class="py-24 bg-white relative overflow-hidden">
        <div class="absolute top-10 left-10 w-64 h-64 bg-teal-50 rounded-full blur-3xl opacity-40"></div>
        <div class="max-w-6xl mx-auto px-6 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">☎️ Kontak & Jam Pelayanan</h2>
            <p class="text-gray-500 mb-12 max-w-2xl mx-auto">
                Hubungi kami untuk informasi lebih lanjut atau datang langsung sesuai jam operasional desa.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-gray-700">
                <div
                    class="group bg-gray-50 p-8 rounded-2xl shadow-md hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div class="text-4xl text-teal-600 mb-3">📞</div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800 group-hover:text-teal-600 transition">Telepon</h3>
                    <p class="text-sm">+62 123 4567 890</p>
                </div>

                <div
                    class="group bg-gray-50 p-8 rounded-2xl shadow-md hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div class="text-4xl text-teal-600 mb-3">📧</div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800 group-hover:text-teal-600 transition">Email</h3>
                    <p class="text-sm">desamangli@desa.go.id</p>
                </div>

                <div
                    class="group bg-gray-50 p-8 rounded-2xl shadow-md hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div class="text-4xl text-teal-600 mb-3">⏰</div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800 group-hover:text-teal-600 transition">Jam Pelayanan
                    </h3>
                    <p class="text-sm leading-relaxed">
                        Senin - Jumat: 08.00 - 15.00 WIB<br>Sabtu: 08.00 - 12.00 WIB
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- 📰 BERITA / PENGUMUMAN --}}
    <section id="berita" class="py-24 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">📰 Berita & Pengumuman Terbaru</h2>
            <p class="text-gray-500 mb-14 max-w-2xl mx-auto">
                Informasi dan pengumuman terkini seputar kegiatan dan kebijakan Desa Mangli.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div
                    class="group bg-white p-8 rounded-2xl shadow-md hover:-translate-y-2 hover:shadow-xl transition-all text-left">
                    <h3 class="text-xl font-bold mb-2 text-gray-800 group-hover:text-teal-600 transition">Pembangunan
                        Jalan Desa</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        <strong>10 November 2025:</strong> Pembangunan jalan di RT 05 akan dimulai minggu depan.
                    </p>
                </div>

                <div
                    class="group bg-white p-8 rounded-2xl shadow-md hover:-translate-y-2 hover:shadow-xl transition-all text-left">
                    <h3 class="text-xl font-bold mb-2 text-gray-800 group-hover:text-teal-600 transition">Pelatihan
                        Administrasi Desa</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        <strong>5 November 2025:</strong> Pelatihan administrasi surat desa akan diadakan pada 15
                        November 2025.
                    </p>
                </div>

                <div
                    class="group bg-white p-8 rounded-2xl shadow-md hover:-translate-y-2 hover:shadow-xl transition-all text-left">
                    <h3 class="text-xl font-bold mb-2 text-gray-800 group-hover:text-teal-600 transition">Pengaduan
                        Warga</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        <strong>1 November 2025:</strong> Pengaduan terkait kebersihan lingkungan dapat disampaikan
                        melalui website ini.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ⚫ FOOTER --}}
    <footer class="bg-gray-900 text-gray-400 text-center py-8 border-t border-gray-800">
        <p class="text-sm">&copy; 2025 <span class="text-teal-400 font-semibold">Desa Mangli</span>, Kabupaten
            Pemalang. Semua hak dilindungi.</p>
        <p class="text-xs text-gray-500 mt-1">Dibangun dengan ❤️ menggunakan Laravel & TailwindCSS</p>
    </footer>
