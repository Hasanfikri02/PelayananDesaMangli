<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\KategoriPengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanWargaController extends Controller
{
    /**
     * Tampilkan daftar pengaduan milik warga yang sedang login
     */
    public function index()
    {
        $pengaduan = Pengaduan::with('kategori')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $kategori = KategoriPengaduan::all();

        return view('warga.surat.pengaduan', compact('pengaduan', 'kategori'));
    }



    /**
     * Form pengajuan pengaduan warga
     */
    public function form($id)
    {
        $kategori = KategoriPengaduan::findOrFail($id);
        return view('warga.surat.formpengaduan', compact('kategori'));
    }



    /**
     * Proses simpan pengaduan warga
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori_pengaduan,id',
            'judul' => 'required|string|max:150',
            'isi_pengaduan' => 'required|string',
            'lokasi' => 'nullable|string|max:255',
            'foto_bukti' => 'nullable|image|max:2048',
        ]);

        // Upload foto jika ada
        if ($request->hasFile('foto_bukti')) {
            $validated['foto_bukti'] = $request->file('foto_bukti')->store('bukti', 'public');
        }

        // Auto isi oleh sistem
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'baru';
        $validated['prioritas'] = 'rendah';
        $validated['tanggapan_admin'] = null;

        Pengaduan::create($validated);

        // GANTI KE ROUTE user/
        return redirect()->route('warga.pengaduan.index')->with('success', 'Pengaduan berhasil dikirim!');
    }
}
