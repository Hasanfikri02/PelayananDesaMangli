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

                <a href="{{ route('admin.pengajuan.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gray-700 font-semibold text-yellow-400 transition">
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
        {{-- Konten Utama --}}
        <main class="flex-1 p-8 overflow-y-auto bg-gray-900 rounded-tl-3xl shadow-inner">

            {{-- HEADER --}}
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-yellow-400">📄 Daftar Pengajuan Surat</h1>
                    <p class="text-gray-300 text-sm">Kelola seluruh pengajuan surat dari warga di sini.</p>
                </div>
            </div>

            {{-- NOTIFIKASI --}}
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-600 text-white rounded shadow">
                    {{ session('success') }}
                </div>
            @endif

            {{-- TABEL --}}
            <div class="overflow-x-auto rounded-xl border border-gray-700 shadow-lg">
                <table class="w-full text-sm text-left text-gray-200">
                    <thead class="bg-gray-800 text-yellow-400 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-5 py-4">ID</th>
                            <th class="px-5 py-4">User</th>
                            <th class="px-5 py-4">Jenis Surat</th>
                            <th class="px-5 py-4">Status</th>
                            <th class="px-5 py-4">Tanggal</th>
                            <th class="px-5 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($pengajuan as $p)
                            <tr class="hover:bg-gray-700 transition">
                                <td class="px-5 py-4">{{ $p->id }}</td>
                                <td class="px-5 py-4">{{ $p->user->name }}</td>
                                <td class="px-5 py-4">{{ $p->jenisSurat->nama_surat }}</td>
                                <td class="px-5 py-4">
                                    @if($p->status == 'selesai')
                                        <span class="bg-green-600 text-white px-3 py-1 rounded-full text-xs font-medium">{{ ucfirst($p->status) }}</span>
                                    @elseif($p->status == 'diproses')
                                        <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-medium">{{ ucfirst($p->status) }}</span>
                                    @elseif($p->status == 'pending')
                                        <span class="bg-yellow-400 text-gray-900 px-3 py-1 rounded-full text-xs font-medium">{{ ucfirst($p->status) }}</span>
                                    @elseif($p->status == 'ditolak')
                                        <span class="bg-red-600 text-white px-3 py-1 rounded-full text-xs font-medium">{{ ucfirst($p->status) }}</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">{{ $p->tanggal_pengajuan->format('d/m/Y H:i') }}</td>
                                <td class="px-5 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.pengajuan.show', $p->id) }}" class="px-3 py-1 bg-blue-500 hover:bg-blue-600 rounded text-white text-sm font-medium">Detail</a>
                                        <a href="{{ route('admin.pengajuan.cetak', $p->id) }}" class="px-3 py-1 bg-green-500 hover:bg-green-600 rounded text-white text-sm font-medium">Cetak</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-gray-400">Belum ada pengajuan surat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </main>
    </div>
</x-app-layout>
