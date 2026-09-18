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
                    <h1 class="text-3xl font-bold text-yellow-400">📄 Detail Pengajuan</h1>
                    <p class="text-gray-300 text-sm">Kelola seluruh pengajuan surat dari warga di sini.</p>
                </div>
            </div>

    <div class="max-w-3xl mx-auto p-6 ">
        <h2 class="text-2xl font-bold mb-4 text-white">Detail Pengajuan</h2>

        <div class="mb-4 text-white">
            <p><strong>User:</strong> {{ $pengajuan->user->name }}</p>
            <p><strong>Jenis Surat:</strong> {{ $pengajuan->jenisSurat->nama_surat }}</p>
            <p><strong>Status:</strong> {{ ucfirst($pengajuan->status) }}</p>
            <p><strong>Tanggal Pengajuan:</strong> {{ $pengajuan->tanggal_pengajuan->format('d/m/Y H:i') }}</p>
            <p><strong>Keterangan Admin:</strong> {{ $pengajuan->keterangan_admin ?? '-' }}</p>
        </div>

        <h3 class="font-semibold mb-2 text-white">Data Form</h3>
        <ul class="mb-4 border p-4 rounded bg-gray-50 text-gray-900">
            @foreach($pengajuan->data_form as $key => $value)
                <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
            @endforeach
        </ul>

        <form action="{{ route('admin.pengajuan.updateStatus', $pengajuan->id) }}" method="POST" class="mb-4">
            @csrf
            <label class="block mb-1 text-white">Ubah Status:</label>
            <select name="status" class="border px-2 py-1 mb-2 text-gray-900">
                <option value="pending" {{ $pengajuan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="diproses" {{ $pengajuan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ $pengajuan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="ditolak" {{ $pengajuan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <textarea name="keterangan_admin" class="border w-full p-2 mb-2 text-gray-900" placeholder="Keterangan admin">{{ $pengajuan->keterangan_admin }}</textarea>
            <button type="submit" class="px-3 py-1 bg-blue-500 text-white rounded">Update Status</button>
        </form>

        @if($pengajuan->file_hasil)
            <a href="{{ asset('storage/' . $pengajuan->file_hasil) }}" class="px-3 py-1 bg-green-500 text-white rounded" target="_blank">Download Surat</a>
        @endif
    </div>
</x-app-layout>
