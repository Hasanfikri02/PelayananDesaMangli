<x-guest-layout>
    <div class="max-w-4xl mx-auto p-6">

        <h1 class="text-2xl font-bold mb-4">Detail Pengajuan Surat</h1>

        <div class="bg-white p-6 border rounded shadow">
            <p><strong>Jenis Surat:</strong> {{ $data->jenisSurat->nama_surat }}</p>
            <p><strong>Status:</strong> <span class="capitalize">{{ $data->status }}</span></p>
            <p><strong>Tanggal Pengajuan:</strong> {{ $data->tanggal_pengajuan->format('d M Y - H:i') }}</p>

            <hr class="my-4">

            <h3 class="font-semibold mb-2">Data Pengajuan</h3>

            <ul class="list-disc ml-5">
                @foreach(json_decode($data->data_form, true) as $key => $value)
                    <li><strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</li>
                @endforeach
            </ul>

            @if($data->file_hasil)
                <a href="{{ asset('storage/'.$data->file_hasil) }}"
                   class="inline-block mt-6 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Download Surat
                </a>
            @endif
        </div>

    </div>
</x-guest-layout>
