<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use App\Models\Pengaduan;
use App\Models\SensusPenduduk;

class SensusWargaController extends Controller
{
    public function index()
    {
        // --- Data Grafik Pengajuan & Pengaduan ---
        $totalPendingProses = PengajuanSurat::whereIn('status', ['pending', 'diproses'])->count();
        $totalPengaduan = Pengaduan::count();

        // --- Data Sensus Graph (diagram donut) ---
        $laki = SensusPenduduk::where('jenis_kelamin', 'L')->count();
        $perempuan = SensusPenduduk::where('jenis_kelamin', 'P')->count();

        return view('warga.surat.sensuswarga', compact(
            'totalPendingProses',
            'totalPengaduan',
            'laki',
            'perempuan'
        ));
    }
}
