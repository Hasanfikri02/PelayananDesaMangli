<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Penduduk
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <a href="{{ route('admin.sensuspenduduk.index') }}" class="text-blue-500 mb-4 inline-block">← Kembali</a>

                <div class="bg-gray-100 p-4 rounded shadow space-y-2">
                    <p><strong>NIK:</strong> {{ $penduduk->nik }}</p>
                    <p><strong>Nama:</strong> {{ $penduduk->nama }}</p>
                    <p><strong>Jenis Kelamin:</strong> {{ $penduduk->jenis_kelamin }}</p>
                    <p><strong>Tempat Lahir:</strong> {{ $penduduk->tempat_lahir }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ $penduduk->tanggal_lahir }}</p>
                    <p><strong>Agama:</strong> {{ $penduduk->agama }}</p>
                    <p><strong>Pendidikan:</strong> {{ $penduduk->pendidikan }}</p>
                    <p><strong>Pekerjaan:</strong> {{ $penduduk->pekerjaan }}</p>
                    <p><strong>Status Perkawinan:</strong> {{ $penduduk->status_perkawinan }}</p>
                    <p><strong>Hubungan Keluarga:</strong> {{ $penduduk->hubungan_keluarga }}</p>
                    <p><strong>Kepala Keluarga:</strong> {{ $penduduk->kk->kepala_keluarga ?? '-' }}</p>
                    <p><strong>Alamat:</strong> {{ $penduduk->kk->alamat ?? '-' }}</p>
                    <p><strong>RT/RW:</strong> {{ $penduduk->kk->rt ?? '-' }}/{{ $penduduk->kk->rw ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
