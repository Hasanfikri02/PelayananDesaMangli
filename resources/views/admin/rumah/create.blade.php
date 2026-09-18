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

        {{-- KONTEN UTAMA --}}
        <main class="flex-1 p-8 overflow-y-auto bg-gray-900 rounded-tl-3xl shadow-inner">

            {{-- HEADER --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-yellow-400 flex items-center gap-2">🏡 Tambah Rumah</h1>
                    <p class="text-gray-300 text-sm">Tambahkan data rumah baru ke sistem sensus desa.</p>
                </div>
            </div>

            {{-- FORM --}}
            <div class="max-w-6xl mx-auto px-6">
                <div class="bg-white/10 rounded-2xl shadow-2xl p-10 border border-gray-700 backdrop-blur-md">

                    <a href="{{ route('admin.sensusrumah.index') }}" class="text-blue-400 mb-6 inline-block">← Kembali</a>

                    <form action="{{ route('admin.sensusrumah.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-200 font-semibold mb-2">Kode Rumah</label>
                                <input type="text" name="kode_rumah" required
                                    class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-900/50 text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition duration-200">
                            </div>

                            <div>
                                <label class="block text-gray-200 font-semibold mb-2">Alamat</label>
                                <input type="text" name="alamat" required
                                    class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-900/50 text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition duration-200">
                            </div>

                            <div>
                                <label class="block text-gray-200 font-semibold mb-2">Jumlah Penghuni</label>
                                <input type="number" name="jumlah_penghuni" min="0" value="0"
                                    class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-900/50 text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition duration-200">
                            </div>

                            <div>
                                <label class="block text-gray-200 font-semibold mb-2">Kepemilikan Rumah</label>
                                <select name="kepemilikan_rumah"
                                    class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-900/50 text-gray-100 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition duration-200">
                                    <option value="milik sendiri">Milik Sendiri</option>
                                    <option value="sewa">Sewa</option>
                                    <option value="kontrak">Kontrak</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-gray-200 font-semibold mb-2">Bahan Bangunan</label>
                                <input type="text" name="bahan_bangunan"
                                    class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-900/50 text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition duration-200">
                            </div>

                            <div>
                                <label class="block text-gray-200 font-semibold mb-2">Sumber Air</label>
                                <input type="text" name="sumber_air"
                                    class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-900/50 text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition duration-200">
                            </div>

                            <div>
                                <label class="block text-gray-200 font-semibold mb-2">Sumber Listrik</label>
                                <input type="text" name="sumber_listrik"
                                    class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-900/50 text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition duration-200">
                            </div>

                            <div>
                                <label class="block text-gray-200 font-semibold mb-2">Kepala Keluarga (KK)</label>
                                <select name="kk_id" required
                                    class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-900/50 text-gray-100 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition duration-200">
                                    <option value="">-- Pilih KK --</option>
                                    @foreach($kk as $k)
                                        <option value="{{ $k->id }}">{{ $k->kepala_keluarga }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="mt-8 text-right">
                            <button type="submit"
                                class="bg-gradient-to-r from-yellow-400 to-yellow-300 hover:from-yellow-300 hover:to-yellow-200 text-gray-900 font-semibold px-6 py-2.5 rounded-lg shadow-lg hover:shadow-yellow-400/50 transition duration-300 ease-in-out">
                                💾 Simpan Rumah
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>
</x-app-layout>
