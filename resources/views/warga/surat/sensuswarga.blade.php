<x-guest-layout>
    <div class="pt-28 max-w-6xl mx-auto px-6 py-10">



        <div class="text-center mt-16 mb-12">
            <h1 class="text-4xl font-extrabold text-gray-800 mb-2">Sensus & Statistik Warga</h1>
            <p class="text-gray-600 text-lg">Informasi grafik pengajuan, pengaduan & sensus penduduk di Desa Mangli.</p>
        </div>

        {{-- GRAFIK DATA --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
            <div class="bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-700">
                <h3 class="text-lg font-semibold text-yellow-400 mb-4">Grafik Pengajuan & Pengaduan</h3>
                <canvas id="chartPengajuan"></canvas>
            </div>

            {{-- DIAGRAM DATA --}}
            <div class="bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-700">
                <h3 class="text-lg font-semibold text-yellow-400 mb-4">Grafik Sensus Penduduk</h3>
                <canvas id="chartSensus"></canvas>
            </div>
        </div>

    </div>

    {{-- SCRIPT GRAFIK --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Grafik Pengajuan & Pengaduan
        const ctx = document.getElementById('chartPengajuan').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jumlah'], // cukup satu
                datasets: [{
                        label: 'Pengajuan Surat',
                        data: [{{ $totalPendingProses }}],
                        backgroundColor: 'rgba(255, 205, 86, 0.6)',
                        borderColor: 'rgb(255, 205, 86)',
                        borderWidth: 2,
                        borderRadius: 8
                    },
                    {
                        label: 'Pengaduan Warga',
                        data: [{{ $totalPengaduan }}],
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgb(54, 162, 235)',
                        borderWidth: 2,
                        borderRadius: 8
                    }
                ]
            }
        });
 

        // Grafik Sensus Penduduk
        const ctx2 = document.getElementById('chartSensus').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [
                        {{ $laki }},
                        {{ $perempuan }}
                    ],
                    backgroundColor: ['#facc15', '#3b82f6'],
                    borderColor: ['#fff', '#fff'],
                    borderWidth: 2
                }]
            }
        });
    </script>

    </div>
</x-guest-layout>
