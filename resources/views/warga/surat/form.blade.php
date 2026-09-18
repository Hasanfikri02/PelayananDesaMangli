<x-guest-layout>
    <div class="max-w-3xl mx-auto p-6">
        <div class="mt-16 mb-12">
        <h1 class="text-2xl font-bold mb-4">Form Pengajuan {{ $jenis->nama_surat }}</h1>

        <form action="{{ route('warga.surat.kirim') }}" method="POST">
            @csrf

            <input type="hidden" name="jenis_surat_id" value="{{ $jenis->id }}">

            <div class="grid grid-cols-1 gap-4 bg-white p-6 border rounded-lg shadow">

                @foreach($formFields as $field)
                    <div>
                        <label class="font-semibold">{{ $field['label'] }}</label>
                        <input type="text"
                               name="data_form[{{ $field['name'] }}]"
                               class="w-full mt-1 border rounded p-2"
                               required>
                    </div>
                @endforeach

            </div>

            <button class="mt-4 bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                Kirim Pengajuan
            </button>
        </form>

    </div>
</x-guest-layout>