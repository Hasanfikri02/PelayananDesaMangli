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
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-yellow-400">🏡 Daftar Rumah</h1>
                    <p class="text-gray-300 text-sm">Kelola seluruh data rumah di desa.</p>
                </div>
                <a href="{{ route('admin.sensusrumah.create') }}"
                   class="bg-yellow-400 text-gray-900 px-5 py-2 rounded-lg shadow hover:bg-yellow-300 transition font-semibold">
                   + Tambah Rumah
                </a>
            </div>

            {{-- PESAN SUKSES --}}
            @if(session('success'))
                <div class="bg-green-600 bg-opacity-20 text-green-400 p-3 mb-6 rounded shadow">
                    {{ session('success') }}
                </div>
            @endif


            {{-- STATISTIK --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-yellow-400 shadow">
                    <p class="text-gray-400 text-sm">Total Rumah</p>
                    <p class="text-yellow-400 text-xl font-bold">{{ $totalRumah ?? 0 }}</p>
                </div>
                <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-red-400 shadow">
                    <p class="text-gray-400 text-sm">Milik Sendiri</p>
                    <p class="text-yellow-400 text-xl font-bold">{{ $milikSendiri ?? 0 }}</p>
                </div>
                <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-green-400 shadow">
                    <p class="text-gray-400 text-sm">Sewa</p>
                    <p class="text-yellow-400 text-xl font-bold">{{ $sewa ?? 0 }}</p>
                </div>
                <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-blue-400 shadow">
                    <p class="text-gray-400 text-sm">Kontrak</p>
                    <p class="text-yellow-400 text-xl font-bold">{{ $kontrak ?? 0 }}</p>
                </div>
                <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-pink-400 shadow">
                    <p class="text-gray-400 text-sm">Lainnya</p>
                    <p class="text-yellow-400 text-xl font-bold">{{ $lainnya ?? 0 }}</p>
                </div>
                <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-purple-400 shadow">
                    <p class="text-gray-400 text-sm">Total Penghuni</p>
                    <p class="text-yellow-400 text-xl font-bold">{{ $totalPenghuni ?? 0 }}</p>
                </div>
                <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-orange-400 shadow">
                    <p class="text-gray-400 text-sm">Rata-rata Penghuni/Rumah</p>
                    <p class="text-yellow-400 text-xl font-bold">{{ number_format($rataPenghuni, 2) ?? 0 }}</p>
                </div>
                <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-brown-400 shadow">
                    <p class="text-gray-400 text-sm">Rumah Kosong</p>
                    <p class="text-yellow-400 text-xl font-bold">{{ $rumahKosong ?? 0 }}</p>
                </div>
                <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-fuchsia-400 shadow">
                    <p class="text-gray-400 text-sm">Rumah Padat (>5 penghuni)</p>
                    <p class="text-yellow-400 text-xl font-bold">{{ $rumahPadat ?? 0 }}</p>
                </div>
            </div>

            {{-- GRAFIK --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
    {{-- Grafik Kepemilikan Rumah --}}
    <div class="bg-gray-800 p-5 rounded-xl shadow">
        <p class="text-gray-400 text-sm mb-2">Jumlah Rumah Berdasarkan Kepemilikan</p>
        <canvas id="kepemilikanChart"></canvas>
    </div>

    {{-- Grafik Rumah Kosong vs Padat --}}
    <div class="bg-gray-800 p-5 rounded-xl shadow">
        <p class="text-gray-400 text-sm mb-2">Rumah Kosong vs Rumah Padat (>5 penghuni)</p>
        <canvas id="kepadatanChart"></canvas>
    </div>
</div>


            {{-- TABEL --}}
            <div class="overflow-x-auto rounded-xl border border-gray-700 shadow-lg">
                <table class="w-full text-sm text-left text-gray-200">
                    <thead class="bg-gray-800 text-yellow-400 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-5 py-4">No</th>
                            <th class="px-5 py-4">Kode Rumah</th>
                            <th class="px-5 py-4">Alamat</th>
                            <th class="px-5 py-4">KK</th>
                            <th class="px-5 py-4">Jumlah Penghuni</th>
                            <th class="px-5 py-4">Kepemilikan</th>
                            <th class="px-5 py-4">Bahan Bangunan</th>
                            <th class="px-5 py-4">Sumber Air</th>
                            <th class="px-5 py-4">Sumber Listrik</th>
                            <th class="px-5 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse ($rumah as $key => $r)
                            <tr class="hover:bg-gray-700 transition">
                                <td class="px-5 py-4">{{ $key + 1 }}</td>
                                <td class="px-5 py-4">{{ $r->kode_rumah }}</td>
                                <td class="px-5 py-4">{{ $r->alamat }}</td>
                                <td class="px-5 py-4">{{ $r->kk->kepala_keluarga ?? '-' }}</td>
                                <td class="px-5 py-4">{{ $r->jumlah_penghuni }}</td>
                                <td class="px-5 py-4">{{ ucfirst($r->kepemilikan_rumah) }}</td>
                                <td class="px-5 py-4">{{ $r->bahan_bangunan ?? '-' }}</td>
                                <td class="px-5 py-4">{{ $r->sumber_air ?? '-' }}</td>
                                <td class="px-5 py-4">{{ $r->sumber_listrik ?? '-' }}</td>
                                <td class="px-5 py-4 text-center">
                                    <div class="flex justify-center gap-4 text-lg">
                                        <a href="{{ route('admin.sensusrumah.show', $r->id) }}" class="text-blue-400 hover:text-blue-500" title="Lihat">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.sensusrumah.edit', $r->id) }}" class="text-yellow-400 hover:text-yellow-300" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.sensusrumah.destroy', $r->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus rumah ini?')">
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
                                <td colspan="10" class="text-center py-5 text-gray-400">Belum ada data rumah.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
    {{-- SCRIPT CHART.JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Grafik Kepemilikan
    const ctx1 = document.getElementById('kepemilikanChart').getContext('2d');
    new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Milik Sendiri', 'Sewa', 'Kontrak', 'Lainnya'],
            datasets: [{
                data: [
                    {{ $milikSendiri ?? 0 }},
                    {{ $sewa ?? 0 }},
                    {{ $kontrak ?? 0 }},
                    {{ $lainnya ?? 0 }}
                ],
                backgroundColor: ['#facc15', '#22c55e', '#3b82f6', '#ec4899'],
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom', labels: { color: '#fff' } } }
        }
    });

    // Grafik Rumah Kosong vs Padat
    const ctx2 = document.getElementById('kepadatanChart').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Rumah Kosong', 'Rumah Padat'],
            datasets: [{
                label: 'Jumlah Rumah',
                data: [
                    {{ $rumahKosong ?? 0 }},
                    {{ $rumahPadat ?? 0 }}
                ],
                backgroundColor: ['#f87171', '#a78bfa'],
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { color: '#fff' } },
                x: { ticks: { color: '#fff' } }
            }
        }
    });
</script>
</x-app-layout>
