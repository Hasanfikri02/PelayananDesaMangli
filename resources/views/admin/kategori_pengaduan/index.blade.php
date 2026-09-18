<x-app-layout>
    <div class="flex min-h-screen bg-gray-900 text-gray-100 font-poppins">

        {{-- SIDEBAR --}}
<aside class="w-64 bg-gradient-to-b from-gray-950 to-gray-800 text-gray-100 flex flex-col shadow-xl">
    <div class="p-6 text-center text-2xl font-bold text-yellow-400 tracking-wide border-b border-gray-700">
        Pelayanan Desa
    </div>

    <nav class="flex-1 p-4 space-y-2 text-sm font-medium" x-data="{ openSensus: false }">
        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-yellow-400 font-semibold' : 'hover:bg-gray-700' }} transition">
            🏠 <span>Dashboard</span>
        </a>

        {{-- Data Surat --}}
        <a href="{{ route('admin.jenissurat.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('admin.jenissurat.*') ? 'bg-gray-700 text-yellow-400 font-semibold' : 'hover:bg-gray-700' }} transition">
            📄 <span>Data Surat</span>
        </a>

        {{-- Placeholder menu lain --}}
        <a href="{{ route('admin.pengajuan.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700 transition">
            ✉️ <span>Pengajuan Surat</span>
        </a>


        <a href="{{ route('admin.kategori-pengaduan.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gray-700 font-semibold text-yellow-400 transition">
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
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-yellow-400">📄 Kategori Pengaduan</h1>
                    <p class="text-gray-300 text-sm">Kelola seluruh kategori pengaduan warga di sini.</p>
                </div>
                <a href="{{ route('admin.kategori-pengaduan.create') }}"
                   class="bg-yellow-400 text-gray-900 px-5 py-2 rounded-lg shadow hover:bg-yellow-300 transition font-semibold">
                    + Tambah Kategori
                </a>
            </div>

            {{-- STATISTIK --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-yellow-400 shadow">
                    <h3 class="text-sm text-gray-400">Total Kategori</h3>
                    <p class="text-3xl font-bold mt-2">{{ $kategori->count() }}</p>
                </div>
                <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-green-500 shadow">
                    <h3 class="text-sm text-gray-400">Kategori Aktif</h3>
                    <p class="text-3xl font-bold mt-2">{{ $kategori->where('is_active', true)->count() }}</p>
                </div>
                <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-red-500 shadow">
                    <h3 class="text-sm text-gray-400">Kategori Nonaktif</h3>
                    <p class="text-3xl font-bold mt-2">{{ $kategori->where('is_active', false)->count() }}</p>
                </div>
                <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-blue-500 shadow">
                    <h3 class="text-sm text-gray-400">Total Penggunaan</h3>
                    <p class="text-3xl font-bold mt-2">{{ rand(20, 99) }}</p>
                </div>
            </div>

            {{-- FILTER --}}
            <form method="GET" action="{{ route('admin.kategori-pengaduan.index') }}" class="flex flex-wrap items-center justify-between mb-6 gap-4">
                <select name="status" class="border border-gray-700 bg-gray-800 text-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-yellow-400 focus:outline-none w-40">
                    <option value="">Semua Status</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <input type="text" name="search" placeholder="Cari kategori..."
                           value="{{ request('search') }}"
                           class="w-56 sm:w-64 md:w-72 px-4 py-2 border border-gray-700 bg-gray-800 text-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                    <button type="submit" class="bg-yellow-400 text-gray-900 px-4 py-2 rounded-lg font-semibold hover:bg-yellow-300 transition">
                        Cari
                    </button>
                    <a href="{{ route('admin.kategori-pengaduan.index') }}" class="bg-gray-700 text-gray-300 px-3 py-2 rounded-lg hover:bg-gray-600 transition">
                        Reset
                    </a>
                </div>
            </form>

            {{-- TABEL --}}
            <div class="overflow-x-auto rounded-xl border border-gray-700 shadow-lg">
                <table class="w-full text-sm text-left text-gray-200">
                    <thead class="bg-gray-800 text-yellow-400 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-5 py-4">No</th>
                            <th class="px-5 py-4">Nama Kategori</th>
                            <th class="px-5 py-4">Deskripsi</th>
                            <th class="px-5 py-4">Status</th>
                            <th class="px-5 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse ($kategori as $key => $item)
                            <tr class="hover:bg-gray-700 transition">
                                <td class="px-5 py-4">{{ $key + 1 }}</td>
                                <td class="px-5 py-4 font-medium text-gray-100">{{ $item->nama_kategori }}</td>
                                <td class="px-5 py-4 text-gray-400">{{ $item->deskripsi ?? '-' }}</td>
                                <td class="px-5 py-4">
                                    @if($item->is_active)
                                        <span class="bg-green-600 text-white px-3 py-1 rounded-full text-xs font-medium">Aktif</span>
                                    @else
                                        <span class="bg-gray-600 text-gray-200 px-3 py-1 rounded-full text-xs font-medium">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <div class="flex justify-center gap-4 text-lg">
                                        <a href="{{ route('admin.kategori-pengaduan.show', $item->id) }}" class="text-blue-400 hover:text-blue-500" title="Lihat">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.kategori-pengaduan.edit', $item->id) }}" class="text-yellow-400 hover:text-yellow-300" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.kategori-pengaduan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-600" title="Hapus">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-gray-400">Belum ada kategori pengaduan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
</x-app-layout>
