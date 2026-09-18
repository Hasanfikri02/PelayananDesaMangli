<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use App\Models\Pengaduan;
use App\Models\SensusPenduduk;

class DashboardController extends Controller
{
    public function index()
    {
        // 📌 Hitung pengajuan surat
        $totalPendingProses = PengajuanSurat::whereIn('status', ['pending', 'diproses'])->count();
        $totalSelesai = PengajuanSurat::where('status', 'selesai')->count();
        $totalDitolak = PengajuanSurat::where('status', 'ditolak')->count();
        $totalSemua = PengajuanSurat::count();

        // 📌 Hitung pengaduan warga: terkirim(baru) + diproses
        $totalPengaduan = Pengaduan::whereIn('status', ['baru', 'diproses'])->count();

        // --- Sensus Penduduk ---
        $laki = SensusPenduduk::where('jenis_kelamin', 'L')->count();
        $perempuan = SensusPenduduk::where('jenis_kelamin', 'P')->count();

        // --- Pengajuan terbaru ---
        $pengajuanTerbaru = PengajuanSurat::with(['user', 'jenisSurat'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // --- Pengaduan terbaru ---
        $pengaduanTerbaru = Pengaduan::with(['user', 'kategori'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalPendingProses',
            'totalPengaduan',
            'laki',
            'perempuan',
            'pengajuanTerbaru',
            'pengaduanTerbaru'
        ));
    }
}
