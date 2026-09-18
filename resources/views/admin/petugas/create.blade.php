<x-app-layout>
    <div class="flex min-h-screen bg-gray-900 text-gray-100 font-poppins">

        {{-- SIDEBAR --}}
        <aside class="w-64 bg-gradient-to-b from-gray-950 to-gray-800 text-gray-100 flex flex-col shadow-xl">
            <div class="p-6 text-center text-2xl font-bold text-yellow-400 tracking-wide border-b border-gray-700">
                Pelayanan Desa
            </div>

            <nav class="flex-1 p-4 space-y-2 text-sm font-medium" x-data="{ openSensus: false }">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    🏠 <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.jenissurat.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    📄 <span>Data Surat</span>
                </a>

                <a href="{{ route('admin.pengajuan.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    ✉️ <span>Pengajuan Surat</span>
                </a>
                <a href="{{ route('admin.kategori-pengaduan.index') }}"
   class="flex items-center gap-3 px-4 py-2 rounded-lg transition
          {{ request()->routeIs('admin.kategori-pengaduan.*') ? 'bg-gray-700 text-yellow-400 font-semibold' : 'hover:bg-gray-700 text-gray-100' }}">
    📢 <span>Jenis Pengaduan</span>
</a>


                <a href="{{ route('admin.pengaduan.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    📋 <span>Pengaduan Warga</span>
                </a>

                <!-- Dropdown Sensus -->
                <div class="space-y-1">
                    <button @click="openSensus = !openSensus"
                        class="w-full flex items-center justify-between px-4 py-2 rounded-lg hover:bg-gray-700 transition text-left focus:outline-none">
                        <span class="flex items-center gap-3">
                            🏘️ <span>Data Sensus & Rumah</span>
                        </span>
                        <svg class="w-4 h-4 transform transition-transform duration-200"
                            :class="{ 'rotate-180': openSensus }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="openSensus" x-transition class="pl-10 space-y-1 text-gray-300 text-sm">
                        <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gray-700 font-semibold text-yellow-400 transition">👥 Petugas Sensus</a>
                        <a href="{{ route('admin.sensuspenduduk.index') }}" class="block px-3 py-1 rounded hover:bg-gray-700 transition">👥 Sensus Penduduk</a>
                        <a href="{{ route('admin.sensusrumah.index') }}" class="block px-3 py-1 rounded hover:bg-gray-700 transition">🏡 Sensus Rumah</a>
                        <a href="{{ route('admin.sensuskk.index') }}" class="block px-3 py-1 rounded hover:bg-gray-700 transition">📑 Sensus Kartu Keluarga</a>
                    </div>
                </div>

                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    👥 <span>Data Pengguna</span>
                </a>


            </nav>

            <div class="p-4 text-sm text-gray-400 border-t border-gray-700">
                © 2025 Pelayanan Desa
            </div>
        </aside>

        {{-- KONTEN UTAMA --}}
        <main class="flex-1 p-10 overflow-y-auto bg-gray-900 rounded-tl-3xl">

            {{-- HEADER --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-yellow-400 flex items-center gap-2">👥 Tambah Petugas</h1>
                    <p class="text-gray-300 text-sm">Kelola data petugas desa di sini.</p>
                </div>

            </div>

            {{-- FORM --}}
            <div class="max-w-3xl mx-auto px-6">
                <div class="bg-white/10 backdrop-blur-md border border-gray-700 rounded-2xl shadow-2xl p-10">
                    <form action="{{ route('admin.petugas.store') }}" method="POST">
                        @csrf

                        {{-- Grid 2 Kolom --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            {{-- Nama --}}
                            <div>
                                <label class="block text-gray-200 font-semibold mb-2 flex items-center gap-2">👤 Nama</label>
                                <input type="text" name="nama"
                                    class="w-full border border-gray-600 rounded-lg px-4 py-2 text-gray-100 bg-gray-900/50 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200"
                                    placeholder="Masukkan nama petugas" required>
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="block text-gray-200 font-semibold mb-2 flex items-center gap-2">📧 Email</label>
                                <input type="email" name="email"
                                    class="w-full border border-gray-600 rounded-lg px-4 py-2 text-gray-100 bg-gray-900/50 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200"
                                    placeholder="Masukkan email">
                            </div>

                            {{-- No HP --}}
                            <div>
                                <label class="block text-gray-200 font-semibold mb-2 flex items-center gap-2">📱 No HP</label>
                                <input type="text" name="no_hp"
                                    class="w-full border border-gray-600 rounded-lg px-4 py-2 text-gray-100 bg-gray-900/50 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200"
                                    placeholder="Masukkan nomor HP">
                            </div>

                            {{-- Jabatan --}}
                            <div>
                                <label class="block text-gray-200 font-semibold mb-2 flex items-center gap-2">💼 Jabatan</label>
                                <input type="text" name="jabatan"
                                    class="w-full border border-gray-600 rounded-lg px-4 py-2 text-gray-100 bg-gray-900/50 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200"
                                    placeholder="Masukkan jabatan">
                            </div>

                            {{-- Wilayah --}}
                            <div class="md:col-span-2">
                                <label class="block text-gray-200 font-semibold mb-2 flex items-center gap-2">📍 Wilayah</label>
                                <input type="text" name="wilayah"
                                    class="w-full border border-gray-600 rounded-lg px-4 py-2 text-gray-100 bg-gray-900/50 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200"
                                    placeholder="Masukkan wilayah petugas">
                            </div>
                        </div>

                        {{-- Tombol Kembali & Simpan --}}
                        <div class="mt-10 flex justify-end gap-4">
                            <a href="{{ route('admin.petugas.index') }}"
                               class="px-6 py-2.5 bg-gray-600 text-gray-100 rounded-lg shadow hover:bg-gray-500 transition font-semibold">
                                ← Kembali
                            </a>
                            <button type="submit"
                                class="bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-500 hover:to-indigo-600 text-white font-semibold px-6 py-2.5 rounded-lg shadow-lg hover:shadow-blue-700/50 transition duration-300 ease-in-out">
                                💾 Simpan Petugas
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>
</x-app-layout>
