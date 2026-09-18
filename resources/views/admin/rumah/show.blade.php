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

                <a href="{{ route('admin.jenissurat.index') }}" class="block px-3 py-1 rounded hover:bg-gray-700 transition">
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
                        <a href="{{ route('admin.petugas.index') }}" class="block px-3 py-1 rounded hover:bg-gray-700 transition">👥 Petugas Sensus</a>
                        <a href="{{ route('admin.sensuspenduduk.index') }}" class="block px-3 py-1 rounded hover:bg-gray-700 transition">👥 Sensus Penduduk</a>
                        <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gray-700 font-semibold text-yellow-400 transition">🏡 Sensus Rumah</a>
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


        <main class="flex-1 p-8 overflow-y-auto bg-gray-900 rounded-tl-3xl shadow-inner">
            <h1 class="text-3xl font-bold text-yellow-400 mb-6">🏠 Detail Rumah</h1>

            <div class="bg-gray-800 p-6 rounded-xl shadow-lg space-y-4">
                <div>
                    <h2 class="text-gray-300 font-semibold">Kode Rumah:</h2>
                    <p class="text-yellow-400">{{ $rumah->kode_rumah }}</p>
                </div>
                <div>
                    <h2 class="text-gray-300 font-semibold">Alamat:</h2>
                    <p class="text-yellow-400">{{ $rumah->alamat }}</p>
                </div>
                <div>
                    <h2 class="text-gray-300 font-semibold">Jumlah Penghuni:</h2>
                    <p class="text-yellow-400">{{ $rumah->jumlah_penghuni }}</p>
                </div>
                <div>
                    <h2 class="text-gray-300 font-semibold">Kepemilikan Rumah:</h2>
                    <p class="text-yellow-400">{{ ucfirst($rumah->kepemilikan_rumah) }}</p>
                </div>
                <div>
                    <h2 class="text-gray-300 font-semibold">Bahan Bangunan:</h2>
                    <p class="text-yellow-400">{{ $rumah->bahan_bangunan ?? '-' }}</p>
                </div>
                <div>
                    <h2 class="text-gray-300 font-semibold">Sumber Air:</h2>
                    <p class="text-yellow-400">{{ $rumah->sumber_air ?? '-' }}</p>
                </div>
                <div>
                    <h2 class="text-gray-300 font-semibold">Sumber Listrik:</h2>
                    <p class="text-yellow-400">{{ $rumah->sumber_listrik ?? '-' }}</p>
                </div>
                <div>
                    <h2 class="text-gray-300 font-semibold">Kepala Keluarga:</h2>
                    <p class="text-yellow-400">{{ $rumah->kk->kepala_keluarga ?? '-' }}</p>
                </div>

                <div class="mt-6 flex gap-4">
                    <a href="{{ route('admin.sensusrumah.edit', $rumah->id) }}"
                       class="bg-yellow-400 text-gray-900 px-4 py-2 rounded-lg hover:bg-yellow-300 transition font-semibold">Edit</a>
                    <a href="{{ route('admin.sensusrumah.index') }}"
                       class="bg-gray-700 text-gray-100 px-4 py-2 rounded-lg hover:bg-gray-600 transition font-semibold">Kembali</a>
                </div>
            </div>

        </main>
    </div>
</x-app-layout>
