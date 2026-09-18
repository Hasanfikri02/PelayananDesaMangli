<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\KategoriPengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /**
     * Tampilkan semua pengaduan user/admin
     */
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $pengaduan = Pengaduan::with(['user', 'kategori'])->latest()->get();
        } else {
            $pengaduan = Pengaduan::with('kategori')->where('user_id', auth()->id())->latest()->get();
        }

        return view('admin.pengaduan.index', compact('pengaduan'));
    }

    /**
     * Form tambah pengaduan baru
     */
    public function create()
    {
        $kategori = KategoriPengaduan::all();
        return view('admin.pengaduan.create', compact('kategori'));
    }

    /**
     * Simpan pengaduan baru
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

        if ($request->hasFile('foto_bukti')) {
            $validated['foto_bukti'] = $request->file('foto_bukti')->store('bukti', 'public');
        }

        $validated['user_id'] = auth()->id();

        Pengaduan::create($validated);

        return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan berhasil dibuat!');
    }

    /**
     * Tampilkan detail pengaduan
     */
    public function show(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    /**
     * Form edit pengaduan
     */
    public function edit(Pengaduan $pengaduan)
    {
        $kategori = KategoriPengaduan::all();
        return view('admin.pengaduan.edit', compact('pengaduan', 'kategori'));
    }

    /**
     * Update pengaduan
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori_pengaduan,id',
            'judul' => 'required|string|max:150',
            'isi_pengaduan' => 'required|string',
            'lokasi' => 'nullable|string|max:255',
            'foto_bukti' => 'nullable|image|max:2048',
            'status' => 'required|in:baru,diproses,selesai,ditolak',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'tanggapan_admin' => 'nullable|string',
        ]);

        if ($request->hasFile('foto_bukti')) {
            $validated['foto_bukti'] = $request->file('foto_bukti')->store('bukti', 'public');
        }

        $pengaduan->update($validated);
        return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan berhasil dibuat!');

    }

    /**
     * Hapus pengaduan
     */
    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();
        return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan berhasil dihapus!');
    }
}
