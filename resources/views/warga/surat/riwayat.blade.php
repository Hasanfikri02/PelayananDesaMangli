<x-guest-layout>
    <div class="max-w-6xl mx-auto p-6">

        <h1 class="text-2xl font-bold mb-4">Riwayat Pengajuan Surat</h1>

        <table class="w-full border bg-white rounded shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Jenis Surat</th>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($riwayat as $r)
                    <tr class="border-t">
                        <td class="p-3">{{ $r->jenisSurat->nama_surat }}</td>
                        <td class="p-3">{{ $r->tanggal_pengajuan->format('d M Y - H:i') }}</td>
                        <td class="p-3 capitalize">{{ $r->status }}</td>
                        <td class="p-3">
                            <a href="{{ route('warga.surat.detail', $r->id) }}"
                               class="text-blue-600 hover:underline">
                                Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</x-guest-layout>
