<x-app-layout>
    <div class="flex min-h-screen bg-gray-900 text-gray-100 font-poppins">

        {{-- SIDEBAR --}}
        <aside class="w-64 bg-gradient-to-b from-gray-950 to-gray-800 text-gray-100 flex flex-col shadow-xl">
            <div class="p-6 text-center text-2xl font-bold text-yellow-400 tracking-wide border-b border-gray-700">
                Pelayanan Desa
            </div>

            <nav class="flex-1 p-4 space-y-2 text-sm font-medium" x-data="{ openSensus: false }">
                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-yellow-400 font-semibold' : 'hover:bg-gray-700' }} transition">
                    🏠 <span>Dashboard</span>
                </a>

                {{-- Data Surat --}}
                <a href="{{ route('admin.jenissurat.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('admin.jenissurat.*') ? 'bg-gray-700 text-yellow-400 font-semibold' : 'hover:bg-gray-700' }} transition">
                    📄 <span>Data Surat</span>
                </a>

                {{-- Placeholder menu lain --}}
                <a href="{{ route('admin.pengajuan.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    ✉️ <span>Pengajuan Surat</span>
                </a>


                <a href="{{ route('admin.kategori-pengaduan.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gray-700 font-semibold text-yellow-400 transition">
                    📢 <span>Jenis Pengaduan</span>
                </a>

                <a href="{{ route('admin.pengaduan.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700 transition">
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
                            :class="{ 'rotate-180': openSensus }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="openSensus" x-transition class="pl-10 space-y-1 text-gray-300 text-sm">
                        <a href="{{ route('admin.petugas.index') }}"
                            class="block px-3 py-1 rounded hover:bg-gray-700 transition">👥 Petugas Sensus</a>
                        <a href="{{ route('admin.sensuspenduduk.index') }}"
                            class="block px-3 py-1 rounded hover:bg-gray-700 transition">👥 Sensus Penduduk</a>
                        <a href="{{ route('admin.sensusrumah.index') }}"
                            class="block px-3 py-1 rounded hover:bg-gray-700 transition">🏡 Sensus Rumah</a>
                        <a href="{{ route('admin.sensuskk.index') }}"
                            class="block px-3 py-1 rounded hover:bg-gray-700 transition">📑 Sensus Kartu Keluarga</a>
                    </div>
                </div>

                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700 transition">
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
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-yellow-400">📄 Kategori Pengaduan</h1>
                    <p class="text-gray-300 text-sm">Kelola seluruh kategori pengaduan warga di sini.</p>
                </div>
            </div>

            <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white shadow rounded-lg p-6">
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.kategori-pengaduan.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block font-medium text-gray-700">Nama Kategori</label>
                        <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-blue-500 focus:border-blue-500">{{ old('deskripsi') }}</textarea>

                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Status Aktif</label>
                        <select name="is_active"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-blue-500 focus:border-blue-500">

                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="flex space-x-2">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                        <a href="{{ route('admin.kategori-pengaduan.index') }}"
                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Batal</a>
                    </div>
                </form>
            </div>
</x-app-layout>
