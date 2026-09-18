<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow rounded-lg">

        <h2 class="text-xl font-bold mb-4">Detail Sensus KK</h2>

        <div class="space-y-2">
            <p><strong>Nomor KK:</strong> {{ $sensus->nomor_kk }}</p>
            <p><strong>Kepala Keluarga:</strong> {{ $sensus->kepala_keluarga }}</p>
            <p><strong>Alamat:</strong> {{ $sensus->alamat }}</p>
            <p><strong>RT/RW:</strong> {{ $sensus->rt }}/{{ $sensus->rw }}</p>
            <p><strong>Petugas Pendata:</strong> {{ $sensus->petugas->nama ?? '-' }}</p>
            <p><strong>Tanggal Pendataan:</strong> {{ $sensus->tanggal_pendataan }}</p>
        </div>

        <a href="{{ route('admin.sensuskk.index') }}"
           class="mt-4 inline-block px-4 py-2 bg-gray-600 text-white rounded">
            Kembali
        </a>

    </div>
</x-app-layout>
