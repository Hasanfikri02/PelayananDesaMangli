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

                <a href="{{ route('admin.jenissurat.index') }}"  class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700 transition">
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

                <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gray-700 font-semibold text-yellow-400 transition">
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
                    <h1 class="text-3xl font-bold text-yellow-400">👥 Daftar User</h1>
                    <p class="text-gray-300 text-sm">Kelola seluruh user sistem di sini.</p>
                </div>
                {{-- Tombol create dihapus --}}
            </div>

            {{-- TABEL --}}
            <div class="overflow-x-auto rounded-xl border border-gray-700 shadow-lg">
                <table class="w-full text-sm text-left text-gray-200">
                    <thead class="bg-gray-800 text-yellow-400 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-5 py-4">ID</th>
                            <th class="px-5 py-4">Nama</th>
                            <th class="px-5 py-4">Email</th>
                            <th class="px-5 py-4">Role</th>
                            <th class="px-5 py-4">NIK</th>
                            <th class="px-5 py-4">Alamat</th>
                            <th class="px-5 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($users as $user)
                        <tr class="hover:bg-gray-700 transition">
                            <td class="px-5 py-4">{{ $user->id }}</td>
                            <td class="px-5 py-4 font-medium text-gray-100">{{ $user->name }}</td>
                            <td class="px-5 py-4 text-gray-300">{{ $user->email }}</td>
                            <td class="px-5 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $user->role === 'admin' ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-gray-300">{{ $user->nik ?? '-' }}</td>
                            <td class="px-5 py-4 text-gray-300">{{ $user->alamat ?? '-' }}</td>
                            <td class="px-5 py-4 text-center">
                                <div class="flex justify-center gap-3 text-lg">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-yellow-400 hover:text-yellow-300" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
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
                            <td colspan="7" class="text-center py-5 text-gray-400">Belum ada user.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
</x-app-layout>
