<x-app-layout>
    <div class="flex min-h-screen bg-gray-900 text-gray-100 font-poppins">

        {{-- SIDEBAR --}}
        <aside class="w-64 bg-gradient-to-b from-gray-950 to-gray-800 text-gray-100 flex flex-col shadow-xl">
            <div class="p-6 text-center text-2xl font-bold text-yellow-400 tracking-wide border-b border-gray-700">
                Pelayanan Desa
            </div>

            <nav class="flex-1 p-4 space-y-2 text-sm font-medium" x-data="{ openSensus: false }">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    🏠 <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.jenissurat.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    📄 <span>Data Surat</span>
                </a>

                <a href="{{ route('admin.pengajuan.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    ✉️ <span>Pengajuan Surat</span>
                </a>



                <a href="{{ route('admin.kategori-pengaduan.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                          {{ request()->routeIs('admin.kategori-pengaduan.*') ? 'bg-gray-700 text-yellow-400 font-semibold' : 'hover:bg-gray-700 text-gray-100' }}">
                    📢 <span>Jenis Pengaduan</span>
                </a>

                <a href="{{ route('admin.pengaduan.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gray-700 font-semibold text-yellow-400 transition">
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
                    <h1 class="text-3xl font-bold text-yellow-400">📋 Dashboard Pengaduan Warga</h1>
                    <p class="text-gray-300 text-sm">Kelola dan pantau seluruh pengaduan warga di sini.</p>
                </div>
                @if (auth()->user()->role == 'admin')
                    <a href="{{ route('admin.pengaduan.create') }}"
                        class="bg-yellow-400 text-gray-900 px-5 py-2 rounded-lg shadow hover:bg-yellow-300 transition font-semibold">
                        + Tambah Pengaduan
                    </a>
                @endif
            </div>

            {{-- CARD / TILE GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-blue-500 shadow">
                    <h3 class="text-sm text-gray-400">Total Pengaduan</h3>
                    <p class="text-3xl font-bold mt-2">{{ $pengaduan->count() }}</p>
                </div>
                <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-gray-500 shadow">
                    <h3 class="text-sm text-gray-400">Terkirim</h3>
                    <p class="text-3xl font-bold mt-2">{{ $pengaduan->where('status', 'terkirim')->count() }}</p>
                </div>
                <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-yellow-500 shadow">
                    <h3 class="text-sm text-gray-400">Proses</h3>
                    <p class="text-3xl font-bold mt-2">{{ $pengaduan->where('status', 'proses')->count() }}</p>
                </div>
                <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-green-500 shadow">
                    <h3 class="text-sm text-gray-400">Selesai</h3>
                    <p class="text-3xl font-bold mt-2">{{ $pengaduan->where('status', 'selesai')->count() }}</p>
                </div>
            </div>

            {{-- CHARTS --}}
            @php
                $kategori = \App\Models\KategoriPengaduan::with('pengaduan')->get();
            @endphp


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                {{-- Pie Chart --}}
                <div class="bg-gray-800 p-5 rounded-xl shadow">
                    <h3 class="text-lg font-semibold text-yellow-400 mb-4">Proporsi Pengaduan per Status</h3>
                    <canvas id="statusPieChart"></canvas>
                </div>

                {{-- Bar Chart --}}
                <div class="bg-gray-800 p-5 rounded-xl shadow">
                    <h3 class="text-lg font-semibold text-yellow-400 mb-4">Jumlah Pengaduan per Kategori</h3>
                    <canvas id="kategoriBarChart"></canvas>
                </div>
            </div>

            {{-- RECENT ACTIVITY --}}
            <div class="bg-gray-800 p-5 rounded-xl shadow mb-10">
                <h3 class="text-lg font-semibold text-yellow-400 mb-4">Pengaduan Terbaru</h3>
                <ul class="divide-y divide-gray-700">
                    @foreach ($pengaduan->sortByDesc('created_at')->take(5) as $p)
                        <li class="py-3 flex justify-between items-center">
                            <span>{{ $p->judul }} ({{ $p->kategori->nama_kategori }})</span>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-medium
                                {{ $p->status == 'selesai' ? 'bg-green-600 text-white' : ($p->status == 'proses' ? 'bg-yellow-500 text-white' : 'bg-gray-600 text-gray-200') }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- TABEL PENGADUAN --}}
            <div class="overflow-x-auto rounded-xl border border-gray-700 shadow-lg">
                <table class="w-full text-sm text-left text-gray-200">
                    <thead class="bg-gray-800 text-yellow-400 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-5 py-4">Judul</th>
                            <th class="px-5 py-4">Kategori</th>
                            <th class="px-5 py-4">Status</th>
                            <th class="px-5 py-4">Prioritas</th>
                            <th class="px-5 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($pengaduan as $p)
                            <tr class="hover:bg-gray-700 transition">
                                <td class="px-5 py-4 font-medium text-gray-100">{{ $p->judul }}</td>
                                <td class="px-5 py-4 text-gray-400">{{ $p->kategori->nama_kategori }}</td>
                                <td class="px-5 py-4">
                                    @if ($p->status === 'selesai')
                                        <span
                                            class="bg-green-600 text-white px-3 py-1 rounded-full text-xs font-medium">Selesai</span>
                                    @elseif($p->status === 'diproses')
                                        <span
                                            class="bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-medium">Diproses</span>
                                    @elseif($p->status === 'ditolak')
                                        <span
                                            class="bg-red-600 text-white px-3 py-1 rounded-full text-xs font-medium">Ditolak</span>
                                    @else
                                        <span
                                            class="bg-gray-600 text-gray-200 px-3 py-1 rounded-full text-xs font-medium">Terkirim</span>
                                        <!-- untuk status 'baru' -->
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    @if ($p->prioritas === 'tinggi')
                                        <span
                                            class="bg-red-600 text-white px-3 py-1 rounded-full text-xs font-medium">Tinggi</span>
                                    @elseif($p->prioritas === 'sedang')
                                        <span
                                            class="bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-medium">Sedang</span>
                                    @else
                                        <span
                                            class="bg-gray-600 text-gray-200 px-3 py-1 rounded-full text-xs font-medium">Rendah</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <div class="flex justify-center gap-4 text-lg">
                                        <a href="{{ route('admin.pengaduan.show', $p->id) }}"
                                            class="text-blue-400 hover:text-blue-500" title="Lihat">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        @if (auth()->user()->role == 'admin' || auth()->id() == $p->user_id)
                                            <a href="{{ route('admin.pengaduan.edit', $p->id) }}"
                                                class="text-yellow-400 hover:text-yellow-300" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('admin.pengaduan.destroy', $p->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-600"
                                                    title="Hapus">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-gray-400">Belum ada pengaduan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </main>
    </div>

    {{-- Chart.js & FontAwesome --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>

    <script>
        // Pie Chart
        const pieCtx = document.getElementById('statusPieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Terkirim', 'Proses', 'Selesai', 'Ditolak'],
                datasets: [{
                    data: [
                        {{ $pengaduan->where('status', 'baru')->count() }}, // Terkirim
                        {{ $pengaduan->where('status', 'diproses')->count() }}, // Proses
                        {{ $pengaduan->where('status', 'selesai')->count() }}, // Selesai
                        {{ $pengaduan->where('status', 'ditolak')->count() }}
                    ],
                    backgroundColor: ['#6B7280', '#FBBF24', '#16A34A', '#EF4444']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: 'white'
                        }
                    }
                }
            }
        });

        // Bar Chart
        const barCtx = document.getElementById('kategoriBarChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($kategori as $k)
                        '{{ $k->nama_kategori }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Jumlah Pengaduan',
                    data: [
                        @foreach ($kategori as $k)
                            {{ $k->pengaduan->count() }},
                        @endforeach
                    ],
                    backgroundColor: '#3B82F6'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white'
                        }
                    },
                    x: {
                        ticks: {
                            color: 'white'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</x-app-layout>
