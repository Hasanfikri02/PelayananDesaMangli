<x-app-layout>
<div class="max-w-3xl mx-auto py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Detail Pengaduan</h1>

        <div class="mb-4"><strong>Judul:</strong> {{ $pengaduan->judul }}</div>
        <div class="mb-4"><strong>Kategori:</strong> {{ $pengaduan->kategori->nama_kategori }}</div>
        <div class="mb-4"><strong>Isi Pengaduan:</strong> <p>{{ $pengaduan->isi_pengaduan }}</p></div>
        <div class="mb-4"><strong>Lokasi:</strong> {{ $pengaduan->lokasi ?? '-' }}</div>
        <div class="mb-4"><strong>Status:</strong> {{ ucfirst($pengaduan->status) }}</div>
        <div class="mb-4"><strong>Prioritas:</strong> {{ ucfirst($pengaduan->prioritas) }}</div>
        <div class="mb-4"><strong>Foto Bukti:</strong>
            @if($pengaduan->foto_bukti)
                <img src="{{ asset('storage/'.$pengaduan->foto_bukti) }}" class="mt-2 w-64 h-auto border rounded">
            @else - @endif
        </div>
        <div class="mb-4"><strong>Tanggapan Admin:</strong> <p>{{ $pengaduan->tanggapan_admin ?? '-' }}</p></div>

        <div class="flex justify-end">
            <a href="{{ route('admin.pengaduan.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Kembali</a>
        </div>
    </div>
</div>
</x-app-layout>
