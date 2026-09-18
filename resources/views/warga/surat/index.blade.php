<x-guest-layout>
    <div class="pt-28 max-w-6xl mx-auto px-6 py-10">

        <div class="text-center mt-16 mb-12">
            <h1 class="text-4xl font-extrabold text-gray-800 mb-2">Pengajuan Surat Desa</h1>
            <p class="text-gray-600 text-lg">Silakan pilih jenis surat sesuai kebutuhan kamu.</p>
        </div>


        {{-- Grid Surat --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

            @foreach ($jenis as $j)
                <div
                    class="bg-white/90 backdrop-blur-md shadow-lg border border-gray-200 rounded-2xl p-6
                            transition-all duration-300 hover:shadow-2xl hover:scale-[1.02]
                            flex flex-col justify-between min-h-[260px]">

                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-3 leading-tight">
                            {{ $j->nama_surat }}
                        </h2>

                        <p class="text-gray-600 text-sm mb-6 leading-relaxed line-clamp-4">
                            {{ $j->deskripsi }}
                        </p>
                    </div>

                    <a href="{{ route('warga.surat.form', $j->id) }}"
                        class="mt-auto w-full text-center bg-blue-600 text-white py-2.5 rounded-xl font-semibold 
                               hover:bg-blue-700 transition shadow-sm">
                        Ajukan Surat
                    </a>

                </div>
            @endforeach

        </div>

    </div>
</x-guest-layout>
