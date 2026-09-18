<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensusPenduduk;
use App\Models\SensusKK;
use Carbon\Carbon;

class SensusPendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Mulai query penduduk dengan relasi KK
    $pendudukQuery = SensusPenduduk::with('kk');

    // Filter search nama atau NIK
    if ($request->filled('search')) {
        $search = $request->search;
        $pendudukQuery->where(function($q) use ($search) {
            $q->where('nama', 'like', "%$search%")
              ->orWhere('nik', 'like', "%$search%");
        });
    }

    // Filter berdasarkan Kepala Keluarga
    if ($request->filled('kk')) {
        $pendudukQuery->where('kk_id', $request->kk);
    }

    // Ambil hasil query
    $penduduk = $pendudukQuery->get();

    // Hitung umur setiap penduduk
    $penduduk->map(function($p) {
        $p->umur = $p->tanggal_lahir ? \Carbon\Carbon::parse($p->tanggal_lahir)->age : null;
        return $p;
    });

    // Statistik
    $anak = $penduduk->whereBetween('umur', [0,12])->count();
    $remaja = $penduduk->whereBetween('umur', [13,18])->count();
    $dewasa = $penduduk->whereBetween('umur', [19,59])->count();
    $lansia = $penduduk->where('umur', '>=', 60)->count();
    $total_kk = $penduduk->pluck('kk_id')->unique()->count();
    $laki = $penduduk->where('jenis_kelamin','L')->count();
    $perempuan = $penduduk->where('jenis_kelamin','P')->count();

    // Ambil semua KK untuk filter di view
    $allKK = \App\Models\SensusKK::all();

    // Kirim ke view
    return view('admin.penduduk.index', compact(
        'penduduk','anak','remaja','dewasa','lansia','total_kk','laki','perempuan','allKK'
    ));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kk = SensusKK::all(); // Ambil semua KK untuk select box
        return view('admin.penduduk.create', compact('kk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:sensus_penduduk,nik|max:20',
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'kk_id' => 'required|exists:sensus_kk,id',
            'tanggal_lahir' => 'required|date',
        ]);

        SensusPenduduk::create($request->all());

        return redirect()->route('admin.sensuspenduduk.index')
                         ->with('success', 'Data penduduk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penduduk = SensusPenduduk::with('kk')->findOrFail($id);
        $penduduk->umur = $penduduk->tanggal_lahir ? Carbon::parse($penduduk->tanggal_lahir)->age : null;
        return view('admin.penduduk.show', compact('penduduk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penduduk = SensusPenduduk::findOrFail($id);
        $kk = SensusKK::all();
        return view('admin.penduduk.edit', compact('penduduk', 'kk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penduduk = SensusPenduduk::findOrFail($id);

        $request->validate([
            'nik' => 'required|unique:sensus_penduduk,nik,'.$id.'|max:20',
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'kk_id' => 'required|exists:sensus_kk,id',
            'tanggal_lahir' => 'required|date',
        ]);

        $penduduk->update($request->all());

        return redirect()->route('admin.sensuspenduduk.index')
                         ->with('success', 'Data penduduk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penduduk = SensusPenduduk::findOrFail($id);
        $penduduk->delete();

        return redirect()->route('admin.sensuspenduduk.index')
                         ->with('success', 'Data penduduk berhasil dihapus');
    }
}
