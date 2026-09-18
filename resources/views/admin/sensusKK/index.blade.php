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
                        <a href="{{ route('admin.sensusrumah.index') }}" class="block px-3 py-1 rounded hover:bg-gray-700 transition">🏡 Sensus Rumah</a>
                        <a href="{{ route('admin.sensuskk.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gray-700 font-semibold text-yellow-400 transition">📑 Sensus Kartu Keluarga</a>
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

        <main class="flex-1 p-8 overflow-y-auto bg-gray-900 rounded-tl-3xl shadow-inner">

            {{-- HEADER --}}
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-yellow-400">📑 Data Sensus KK</h1>
                    <p class="text-gray-300 text-sm">Kelola data seluruh Kartu Keluarga di desa.</p>
                </div>
                <a href="{{ route('admin.sensuskk.create') }}"
                   class="bg-yellow-400 text-gray-900 px-5 py-2 rounded-lg shadow hover:bg-yellow-300 transition font-semibold">
                    + Tambah Data KK
                </a>
            </div>

            {{-- NOTIFIKASI --}}
            @if(session('success'))
                <div class="p-4 mb-6 bg-green-600 text-white rounded-lg shadow">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Filter/Search --}}
        <form class="mb-6 flex flex-wrap gap-3" method="GET">
            <input type="text" name="search" placeholder="Cari Nomor KK / Kepala Keluarga"
                   class="px-4 py-2 rounded-lg bg-gray-800 text-gray-100 focus:outline-none"
                   value="{{ request('search') }}">
            <select name="petugas_id" class="px-4 py-2 rounded-lg bg-gray-800 text-gray-100">
                <option value="">-- Filter Petugas --</option>
                @foreach($allPetugas as $petugas)
                    <option value="{{ $petugas->id }}" {{ request('petugas_id') == $petugas->id ? 'selected' : '' }}>
                        {{ $petugas->nama }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg font-semibold hover:bg-yellow-300 transition">Filter</button>
        </form>

        {{-- STATISTIK --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-yellow-400 shadow">
                <p class="text-gray-400 text-sm">Total KK</p>
                <p class="text-yellow-400 text-xl font-bold">{{ $totalKK }}</p>
            </div>
        </div>

        {{-- GRAFIK --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            {{-- KK per RT/RW --}}
            <div class="bg-gray-800 p-5 rounded-xl shadow">
                <p class="text-gray-400 text-sm mb-2">KK per RT/RW</p>
                <canvas id="rtChart"></canvas>
            </div>

            {{-- KK per Petugas --}}
            <div class="bg-gray-800 p-5 rounded-xl shadow">
                <p class="text-gray-400 text-sm mb-2">KK per Petugas</p>
                <canvas id="petugasChart"></canvas>
            </div>

            {{-- KK per Tanggal --}}
            <div class="bg-gray-800 p-5 rounded-xl shadow">
                <p class="text-gray-400 text-sm mb-2">KK per Tanggal</p>
                <canvas id="tanggalChart"></canvas>
            </div>
        </div>

            {{-- TABEL --}}
            <div class="overflow-x-auto rounded-xl border border-gray-700 shadow-lg">
                <table class="w-full text-sm text-left text-gray-200">
                    <thead class="bg-gray-800 text-yellow-400 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-5 py-4">Nomor KK</th>
                            <th class="px-5 py-4">Kepala Keluarga</th>
                            <th class="px-5 py-4">Alamat</th>
                            <th class="px-5 py-4">RT/RW</th>
                            <th class="px-5 py-4">Tanggal Pendataan</th>
                            <th class="px-5 py-4">Petugas Pendata</th>
                            <th class="px-5 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-700">
                        @forelse ($sensus as $s)
                            <tr class="hover:bg-gray-700 transition">
                                <td class="px-5 py-4 font-medium text-gray-100">{{ $s->nomor_kk }}</td>
                                <td class="px-5 py-4 text-gray-300">{{ $s->kepala_keluarga }}</td>
                                <td class="px-5 py-4 text-gray-300">{{ $s->alamat }}</td>
                                <td class="px-5 py-4 text-gray-300">{{ $s->rt }}/{{ $s->rw }}</td>
                                <td class="px-5 py-4 text-gray-300">{{ $s->tanggal_pendataan }}</td>
                                <td class="px-5 py-4 text-gray-300">{{ $s->petugas->nama ?? '-' }}</td>

                                <td class="px-5 py-4 text-center">
                                    <div class="flex justify-center gap-4 text-lg">

                                        {{-- SHOW --}}
                                        <a href="{{ route('admin.sensuskk.show', $s->id) }}"
                                           class="text-blue-400 hover:text-blue-500"
                                           title="Detail">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.sensuskk.edit', $s->id) }}"
                                           class="text-yellow-400 hover:text-yellow-300"
                                           title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        {{-- DELETE --}}
                                        <form action="{{ route('admin.sensuskk.destroy', $s->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-500 hover:text-red-600"
                                                    title="Hapus">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-gray-400">
                                    Belum ada data sensus KK.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // KK per RT/RW
    new Chart(document.getElementById('rtChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($kkPerRT->keys()) !!},
            datasets: [{
                label: 'Jumlah KK',
                data: {!! json_encode($kkPerRT->values()) !!},
                backgroundColor: '#3b82f6'
            }]
        },
        options: { responsive:true, scales: { y:{beginAtZero:true,ticks:{color:'#fff'}}, x:{ticks:{color:'#fff'}} } }
    });

    // KK per Petugas
    new Chart(document.getElementById('petugasChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($kkPerPetugas->keys()->map(fn($id)=>\App\Models\Petugas::find($id)->nama ?? '')) !!},
            datasets: [{
                label: 'Jumlah KK',
                data: {!! json_encode($kkPerPetugas->values()) !!},
                backgroundColor: '#facc15'
            }]
        },
        options: { responsive:true, scales: { y:{beginAtZero:true,ticks:{color:'#fff'}}, x:{ticks:{color:'#fff'}} } }
    });

    // KK per Tanggal
    new Chart(document.getElementById('tanggalChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($kkPerTanggal->keys()) !!},
            datasets: [{
                label: 'Jumlah KK',
                data: {!! json_encode($kkPerTanggal->values()) !!},
                borderColor: '#22c55e',
                backgroundColor: 'rgba(34,197,94,0.3)',
                fill:true,
            }]
        },
        options: { responsive:true, scales: { y:{beginAtZero:true,ticks:{color:'#fff'}}, x:{ticks:{color:'#fff'}} } }
    });
</script>
</x-app-layout>
