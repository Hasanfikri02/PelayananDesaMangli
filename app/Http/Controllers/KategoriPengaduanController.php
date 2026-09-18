<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriPengaduan;

class KategoriPengaduanController extends Controller
{
    public function index()
    {
        $kategori = KategoriPengaduan::all();
        return view('admin.kategori_pengaduan.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori_pengaduan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        KategoriPengaduan::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.kategori-pengaduan.index')
                         ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $kategori = KategoriPengaduan::findOrFail($id);
        return view('admin.kategori_pengaduan.show', compact('kategori'));
    }

    public function edit(string $id)
    {
        $kategori = KategoriPengaduan::findOrFail($id);
        return view('admin.kategori_pengaduan.edit', compact('kategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $kategori = KategoriPengaduan::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.kategori-pengaduan.index')
                         ->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy(string $id)
    {
        $kategori = KategoriPengaduan::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.kategori-pengaduan.index')
                         ->with('success', 'Kategori berhasil dihapus.');
    }
}
