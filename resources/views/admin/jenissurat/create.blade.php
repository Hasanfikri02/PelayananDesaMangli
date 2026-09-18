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
            <a href="{{ route('admin.jenissurat.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gray-700 font-semibold text-yellow-400 transition">
                📄 <span>Data Surat</span>
            </a>
            <a href="{{ route('admin.pengajuan.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                ✉️ <span>Pengajuan Surat</span>
            </a>
            <a href="{{ route('admin.kategori-pengaduan.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                {{ request()->routeIs('admin.kategori-pengaduan.*') ? 'bg-gray-700 text-yellow-400 font-semibold' : 'hover:bg-gray-700 text-gray-100' }}">
                📢 <span>Jenis Pengaduan</span>
            </a>
            <a href="{{ route('admin.pengaduan.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                📋 <span>Pengaduan Warga</span>
            </a>

            {{-- Dropdown Sensus --}}
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
    <main class="flex-1 p-8 overflow-y-auto bg-gray-900 rounded-tl-3xl shadow-inner">

        {{-- HEADER --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-yellow-400 flex items-center gap-2">📄 Edit Jenis Surat</h1>
                <p class="text-gray-300 text-sm">Kelola isi jenis surat administrasi desa di sini.</p>
            </div>
        </div>


        {{-- FORM --}}
        <div class="max-w-6xl mx-auto px-6">
            <div class="bg-white/10 dark:bg-gray-800/60 rounded-2xl shadow-2xl p-10 border border-gray-700 backdrop-blur-md">
                <form action="{{ route('admin.jenissurat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Grid 2 Kolom --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Nama Surat --}}
                        <div>
                            <label class="block text-gray-200 font-semibold mb-2 flex items-center gap-2">
                                📄 Nama Surat
                            </label>
                            <input type="text" name="nama_surat"
                                class="w-full border border-gray-600 rounded-lg px-4 py-2 text-gray-100 bg-gray-900/50 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200"
                                placeholder="Contoh: Surat Keterangan Usaha" required>
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="block text-gray-200 font-semibold mb-2 flex items-center gap-2">
                                ⚙️ Status Surat
                            </label>
                            <select name="is_active"
                                class="w-full border border-gray-600 rounded-lg px-4 py-2 bg-gray-900/50 text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200">
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mt-8">
                        <label class="block text-gray-200 font-semibold mb-2 flex items-center gap-2">
                            📝 Deskripsi
                        </label>
                        <textarea name="deskripsi" rows="4"
                            class="w-full border border-gray-600 rounded-lg px-4 py-2 text-gray-100 bg-gray-900/50 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200"
                            placeholder="Tuliskan deskripsi singkat jenis surat ini..."></textarea>
                    </div>

                    {{-- Template File --}}
                    <div class="mt-8">
                        <label class="block text-gray-200 font-semibold mb-2 flex items-center gap-2">
                            📎 Template (PDF/DOC/DOCX)
                        </label>
                        <input type="file" name="template_path"
                            class="w-full border border-gray-600 rounded-lg px-4 py-2 bg-gray-900/50 text-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 focus:outline-none transition duration-200">
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="mt-10 text-right">
                        <button type="submit"
                            class="bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-500 hover:to-indigo-600 text-white font-semibold px-6 py-2.5 rounded-lg shadow-lg hover:shadow-blue-700/50 transition duration-300 ease-in-out">
                            💾 Simpan Jenis Surat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
