<x-app-layout>
    <div class="flex min-h-screen bg-gray-900 text-gray-100 font-poppins">

        {{-- SIDEBAR --}}
        <aside class="w-64 bg-gradient-to-b from-gray-950 to-gray-800 text-gray-100 flex flex-col shadow-xl">
            <div class="p-6 text-center text-2xl font-bold text-yellow-400 tracking-wide border-b border-gray-700">
                Pelayanan Desa
            </div>

            <!-- Pastikan Alpine.js aktif (sudah otomatis di Breeze) -->
            <nav class="flex-1 p-4 space-y-2 text-sm font-medium" x-data="{ openSensus: false }">

                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-2 bg-gray-800 rounded-lg hover:bg-gray-700 transition">
                    🏠 <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.jenissurat.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700 transition
   {{ request()->routeIs('admin.jenissurat.*') ? 'bg-gray-700 font-semibold text-yellow-400' : '' }}">
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

                    <!-- Submenu -->
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
                    <h1 class="text-3xl font-bold text-yellow-400">Dashboard Utama</h1>
                    <p class="text-gray-300 text-sm">Selamat datang di sistem pelayanan desa 👋</p>
                </div>
                <div class="bg-gray-800 px-4 py-2 rounded-lg shadow flex items-center gap-2">
                    <span class="text-yellow-400 font-semibold">Admin</span>
                    <img src="https://ui-avatars.com/api/?name=Admin&background=1e293b&color=facc15"
                        class="w-8 h-8 rounded-full">
                </div>
            </div>

            {{-- STATISTIK UTAMA --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <div
                    class="bg-gray-800 p-5 rounded-xl border-l-4 border-yellow-400 shadow hover:-translate-y-1 transition">
                    <h3 class="text-sm text-gray-400">Total Pengajuan Surat</h3>
                    <p class="text-3xl font-bold mt-2">{{ $totalPendingProses }}</p>
                </div>
                <div
                    class="bg-gray-800 p-5 rounded-xl border-l-4 border-yellow-400 shadow hover:-translate-y-1 transition">
                    <h3 class="text-sm text-gray-400">Pengaduan Warga</h3>
                    <p class="text-3xl font-bold mt-2">{{ $totalPengaduan }}</p>
                </div>
                <div
                    class="bg-gray-800 p-5 rounded-xl border-l-4 border-yellow-400 shadow hover:-translate-y-1 transition">
                    <h3 class="text-sm text-gray-400">Total Penduduk</h3>
                    <p class="text-3xl font-bold mt-2">3.214</p>
                </div>
                <div
                    class="bg-gray-800 p-5 rounded-xl border-l-4 border-yellow-400 shadow hover:-translate-y-1 transition">
                    <h3 class="text-sm text-gray-400">Jumlah Rumah</h3>
                    <p class="text-3xl font-bold mt-2">872</p>
                </div>
            </div>

            {{-- GRAFIK DATA --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
                <div class="bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-700">
                    <h3 class="text-lg font-semibold text-yellow-400 mb-4">Grafik Pengajuan & Pengaduan</h3>
                    <canvas id="chartPengajuan"></canvas>
                </div>

                {{-- DIAGRAM DATA --}}
                <div class="bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-700">
                    <h3 class="text-lg font-semibold text-yellow-400 mb-4">Grafik Sensus Penduduk</h3>
                    <canvas id="chartSensus"></canvas>
                </div>

            </div>

            {{-- BAGIAN 1: Pengajuan Surat --}}
            <section class="bg-gray-800 p-6 rounded-xl shadow-xl mb-8 border border-gray-700">
                <h2 class="text-xl font-semibold text-yellow-400 mb-4">📄 Pengajuan Surat Terbaru</h2>
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="text-gray-300 uppercase border-b border-gray-700">
                        <tr>
                            <th class="py-3 px-4">No</th>
                            <th class="py-3 px-4">Nama Pemohon</th>
                            <th class="py-3 px-4">Jenis Surat</th>
                            <th class="py-3 px-4">Tanggal</th>
                            <th class="py-3 px-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-200">
                        @forelse ($pengajuanTerbaru as $i => $p)
                            <tr class="hover:bg-gray-700 transition">
                                <td class="py-3 px-4">{{ $i + 1 }}</td>
                                <td class="py-3 px-4">{{ $p->user->name }}</td>
                                <td class="py-3 px-4">{{ $p->jenisSurat->nama_surat }}</td>
                                <td class="py-3 px-4">{{ $p->created_at->format('d M Y') }}</td>
                                <td class="py-3 px-4">
                                    @if ($p->status == 'selesai')
                                        <span
                                            class="bg-green-600 text-white text-xs px-3 py-1 rounded-full">Selesai</span>
                                    @elseif($p->status == 'diproses')
                                        <span
                                            class="bg-blue-600 text-white text-xs px-3 py-1 rounded-full">Diproses</span>
                                    @elseif($p->status == 'pending')
                                        <span
                                            class="bg-yellow-400 text-black text-xs px-3 py-1 rounded-full">Pending</span>
                                    @elseif($p->status == 'ditolak')
                                        <span
                                            class="bg-red-600 text-white text-xs px-3 py-1 rounded-full">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-400">
                                    Belum ada pengajuan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </section>

            {{-- BAGIAN 2: Pengaduan Warga --}}
            <section class="bg-gray-800 p-6 rounded-xl shadow-xl mb-8 border border-gray-700">
                <h2 class="text-xl font-semibold text-yellow-400 mb-4">📢 Pengaduan Warga Terbaru</h2>
                <ul class="space-y-3">
                    @forelse ($pengaduanTerbaru as $p)
                        <li class="bg-gray-700 rounded-lg px-4 py-3 flex justify-between items-center">
                            <span>
                                🧍 <b>{{ $p->user->name }}</b> — {{ $p->judul }}
                            </span>

                            @if ($p->status == 'selesai')
                                <span class="text-xs bg-green-600 px-3 py-1 rounded-full">Selesai</span>
                            @elseif ($p->status == 'diproses')
                                <span class="text-xs bg-yellow-500 text-black px-3 py-1 rounded-full">Diproses</span>
                            @elseif ($p->status == 'pending')
                                <span class="text-xs bg-gray-500 px-3 py-1 rounded-full">Pending</span>
                            @else
                                <span
                                    class="text-xs bg-gray-600 px-3 py-1 rounded-full">{{ ucfirst($p->status) }}</span>
                            @endif
                        </li>
                    @empty
                        <li class="text-gray-400 text-center py-3">Belum ada pengaduan.</li>
                    @endforelse
                </ul>

            </section>

            {{-- BAGIAN 3: Sensus & Data Rumah --}}
            <section class="bg-gray-800 p-6 rounded-xl shadow-xl border border-gray-700">
                <h2 class="text-xl font-semibold text-yellow-400 mb-4">🏠 Data Sensus Penduduk dan Rumah</h2>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="bg-gray-700 p-5 rounded-lg text-center shadow">
                        <h3 class="text-gray-300 text-sm">Jumlah KK</h3>
                        <p class="text-3xl font-bold text-yellow-400 mt-2">1.025</p>
                    </div>
                    <div class="bg-gray-700 p-5 rounded-lg text-center shadow">
                        <h3 class="text-gray-300 text-sm">Total Penduduk</h3>
                        <p class="text-3xl font-bold text-yellow-400 mt-2">3.214</p>
                    </div>
                    <div class="bg-gray-700 p-5 rounded-lg text-center shadow">
                        <h3 class="text-gray-300 text-sm">Total Rumah</h3>
                        <p class="text-3xl font-bold text-yellow-400 mt-2">872</p>
                    </div>
                </div>
            </section>
        </main>
    </div>

    {{-- SCRIPT GRAFIK --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Grafik Pengajuan & Pengaduan
        const ctx = document.getElementById('chartPengajuan').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jumlah'], // cukup satu
                datasets: [{
                        label: 'Pengajuan Surat',
                        data: [{{ $totalPendingProses }}],
                        backgroundColor: 'rgba(255, 205, 86, 0.6)',
                        borderColor: 'rgb(255, 205, 86)',
                        borderWidth: 2,
                        borderRadius: 8
                    },
                    {
                        label: 'Pengaduan Warga',
                        data: [{{ $totalPengaduan }}],
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgb(54, 162, 235)',
                        borderWidth: 2,
                        borderRadius: 8
                    }
                ]
            }
        });


        // Grafik Sensus Penduduk
        const ctx2 = document.getElementById('chartSensus').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [
                        {{ $laki }},
                        {{ $perempuan }}
                    ],
                    backgroundColor: ['#facc15', '#3b82f6'],
                    borderColor: ['#fff', '#fff'],
                    borderWidth: 2
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: '#f1f5f9'
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
