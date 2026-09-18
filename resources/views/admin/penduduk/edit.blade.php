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

        <a href="{{ route('admin.kategori-pengaduan.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700 transition">
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
                        <a href="{{ route('admin.sensuspenduduk.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gray-700 font-semibold text-yellow-400 transition">👥 Sensus Penduduk</a>
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
                <h1 class="text-3xl font-bold text-yellow-400 flex items-center gap-2">👤 Edit Penduduk</h1>
                <p class="text-gray-300 text-sm">Kelola data penduduk desa di sini.</p>
                <a href="{{ route('admin.sensuspenduduk.index') }}" class="text-blue-400 mt-2 inline-block hover:underline">← Kembali</a>
            </div>
        </div>

        {{-- FORM --}}
        <div class="py-6">
            <div class="max-w-3xl mx-auto bg-white/10 backdrop-blur-md border border-gray-700 rounded-2xl shadow-lg p-8">

                {{-- Error Validation --}}
                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-200 text-red-800 rounded">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>- {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.sensuspenduduk.update', $penduduk->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- NIK --}}
                    <div class="mb-6">
                        <label class="block text-gray-200 font-semibold mb-2">NIK</label>
                        <input type="text" name="nik" value="{{ old('nik', $penduduk->nik) }}"
                            class="w-full px-4 py-2 border border-gray-600 rounded-xl bg-gray-800 text-gray-100 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition">
                    </div>

                    {{-- Nama --}}
                    <div class="mb-6">
                        <label class="block text-gray-200 font-semibold mb-2">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama', $penduduk->nama) }}"
                            class="w-full px-4 py-2 border border-gray-600 rounded-xl bg-gray-800 text-gray-100 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition">
                    </div>

                    {{-- Tempat Lahir --}}
                    <div class="mb-6">
                        <label class="block text-gray-200 font-semibold mb-2">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $penduduk->tempat_lahir) }}"
                            class="w-full px-4 py-2 border border-gray-600 rounded-xl bg-gray-800 text-gray-100 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition">
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="mb-6">
                        <label class="block text-gray-200 font-semibold mb-2">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir) }}"
                            class="w-full px-4 py-2 border border-gray-600 rounded-xl bg-gray-800 text-gray-100 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition">
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="mb-6">
                        <label class="block text-gray-200 font-semibold mb-2">Jenis Kelamin</label>
                        <select name="jenis_kelamin"
                            class="w-full px-4 py-2 border border-gray-600 rounded-xl bg-gray-800 text-gray-100 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition">
                            <option value="">-- Pilih --</option>
                            <option value="L" {{ old('jenis_kelamin', $penduduk->jenis_kelamin)=='L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $penduduk->jenis_kelamin)=='P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    {{-- Agama --}}
                    <div class="mb-6">
                        <label class="block text-gray-200 font-semibold mb-2">Agama</label>
                        <input type="text" name="agama" value="{{ old('agama', $penduduk->agama) }}"
                            class="w-full px-4 py-2 border border-gray-600 rounded-xl bg-gray-800 text-gray-100 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition">
                    </div>

                    {{-- Pendidikan --}}
                    <div class="mb-6">
                        <label class="block text-gray-200 font-semibold mb-2">Pendidikan</label>
                        <input type="text" name="pendidikan" value="{{ old('pendidikan', $penduduk->pendidikan) }}"
                            class="w-full px-4 py-2 border border-gray-600 rounded-xl bg-gray-800 text-gray-100 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition">
                    </div>

                    {{-- Pekerjaan --}}
                    <div class="mb-6">
                        <label class="block text-gray-200 font-semibold mb-2">Pekerjaan</label>
                        <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $penduduk->pekerjaan) }}"
                            class="w-full px-4 py-2 border border-gray-600 rounded-xl bg-gray-800 text-gray-100 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition">
                    </div>

                    {{-- Status Perkawinan --}}
                    <div class="mb-6">
                        <label class="block text-gray-200 font-semibold mb-2">Status Perkawinan</label>
                        <select name="status_perkawinan"
                            class="w-full px-4 py-2 border border-gray-600 rounded-xl bg-gray-800 text-gray-100 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition">
                            <option value="">-- Pilih --</option>
                            <option value="Belum Kawin" {{ old('status_perkawinan', $penduduk->status_perkawinan)=='Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                            <option value="Kawin" {{ old('status_perkawinan', $penduduk->status_perkawinan)=='Kawin' ? 'selected' : '' }}>Kawin</option>
                            <option value="Cerai" {{ old('status_perkawinan', $penduduk->status_perkawinan)=='Cerai' ? 'selected' : '' }}>Cerai</option>
                        </select>
                    </div>

                    {{-- Hubungan Keluarga --}}
                    <div class="mb-6">
                        <label class="block text-gray-200 font-semibold mb-2">Hubungan Keluarga</label>
                        <input type="text" name="hubungan_keluarga" value="{{ old('hubungan_keluarga', $penduduk->hubungan_keluarga) }}"
                            class="w-full px-4 py-2 border border-gray-600 rounded-xl bg-gray-800 text-gray-100 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition">
                    </div>

                    {{-- Kepala Keluarga --}}
                    <div class="mb-6">
                        <label class="block text-gray-200 font-semibold mb-2">Kepala Keluarga (KK)</label>
                        <select name="kk_id"
                            class="w-full px-4 py-2 border border-gray-600 rounded-xl bg-gray-800 text-gray-100 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition">
                            <option value="">-- Pilih KK --</option>
                            @foreach($kk as $k)
                                <option value="{{ $k->id }}" {{ old('kk_id', $penduduk->kk_id)==$k->id ? 'selected' : '' }}>
                                    {{ $k->kepala_keluarga }} - {{ $k->alamat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Button --}}
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold px-6 py-2 rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105">
                            Update Penduduk
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>
</div>
</x-app-layout>
