<x-guest-layout>
    <div class="max-w-3xl mx-auto p-6 mt-16">

        <h1 class="text-2xl font-bold mb-4">Ajukan Pengaduan: {{ $kategori->nama_kategori }}</h1>

        <form action="{{ route('warga.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="kategori_id" value="{{ $kategori->id }}">

            <div class="grid grid-cols-1 gap-4 bg-white p-6 border rounded-lg shadow">

                <div>
                    <label class="font-semibold">Judul Pengaduan</label>
                    <input type="text" name="judul" class="w-full mt-1 border rounded p-2" required>
                </div>

                <div>
                    <label class="font-semibold">Isi Pengaduan</label>
                    <textarea name="isi_pengaduan" rows="4" class="w-full mt-1 border rounded p-2" required></textarea>
                </div>

                <div>
                    <label class="font-semibold">Lokasi</label>
                    <input type="text" name="lokasi" class="w-full mt-1 border rounded p-2">
                </div>

                <div>
                    <label class="font-semibold">Foto Bukti (opsional)</label>
                    <input type="file" name="foto_bukti" class="w-full mt-1 border rounded p-2">
                </div>

            </div>

            <button class="mt-4 bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                Kirim Pengaduan
            </button>
        </form>

    </div>
</x-guest-layout>
