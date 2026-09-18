<?php

namespace App\Http\Controllers;

use App\Models\SensusKK;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SensusKKController extends Controller
{
    public function index(Request $request)
    {
        // Query utama Sensus KK
        $sensusQuery = SensusKK::with('petugas');

        // Filter berdasarkan Petugas jika ada
        if ($request->filled('petugas_id')) {
            $sensusQuery->where('petugas_id', $request->petugas_id);
        }

        // Search berdasarkan nomor KK atau kepala keluarga
        if ($request->filled('search')) {
            $search = $request->search;
            $sensusQuery->where(function($q) use ($search) {
                $q->where('nomor_kk', 'like', "%$search%")
                  ->orWhere('kepala_keluarga', 'like', "%$search%");
            });
        }

        $sensus = $sensusQuery->latest()->get();

        // Statistik
        $totalKK = $sensus->count();
        $kkPerRT = $sensus->groupBy(fn($item) => $item->rt.'/'.$item->rw)->map->count();
        $kkPerPetugas = $sensus->groupBy('petugas_id')->map->count();
        $kkPerTanggal = $sensus->groupBy(function($item) {
    return Carbon::parse($item->tanggal_pendataan)->format('Y-m-d');
})->map->count();

        // Semua Petugas untuk filter dropdown
        $allPetugas = Petugas::all();

        return view('admin.sensuskk.index', compact(
            'sensus','totalKK','kkPerRT','kkPerPetugas','kkPerTanggal','allPetugas'
        ));
    }

    public function create()
    {
        $petugas = Petugas::all();
        return view('admin.sensuskk.create', compact('petugas'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'nomor_kk' => 'required|string|max:20|unique:sensus_kk,nomor_kk',
            'kepala_keluarga' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'rt' => 'nullable|integer',
            'rw' => 'nullable|integer',
            'petugas_id' => 'required|exists:petugas,id',
            'tanggal_pendataan' => 'nullable|date', // optional
        ]);

        // create record dan isi tanggal_pendataan otomatis jika null
        SensusKK::create([
            'nomor_kk' => $request->nomor_kk,
            'kepala_keluarga' => $request->kepala_keluarga,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'petugas_id' => $request->petugas_id,
            'tanggal_pendataan' => $request->tanggal_pendataan ?? now(), // otomatis hari ini jika kosong
        ]);

        return redirect()->route('admin.sensuskk.index')
            ->with('success', 'Data Sensus KK berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $sensus = SensusKK::findOrFail($id);
        return view('admin.sensuskk.show', compact('sensus'));
    }

    public function edit(string $id)
    {
        $sensus = SensusKK::findOrFail($id);
        $petugas = Petugas::all(); // dibutuhkan untuk dropdown
        return view('admin.sensuskk.edit', compact('sensus','petugas'));
    }

    public function update(Request $request, string $id)
    {
        $sensus = SensusKK::findOrFail($id);

        $request->validate([
            'nomor_kk' => 'required|string|max:20|unique:sensus_kk,nomor_kk,' . $sensus->id,
            'kepala_keluarga' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'rt' => 'nullable|integer',
            'rw' => 'nullable|integer',
            'petugas_id' => 'required|exists:petugas,id',
            'tanggal_pendataan' => 'nullable|date',
        ]);

        $sensus->update([
            'nomor_kk' => $request->nomor_kk,
            'kepala_keluarga' => $request->kepala_keluarga,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'petugas_id' => $request->petugas_id,
            'tanggal_pendataan' => $request->tanggal_pendataan ?? $sensus->tanggal_pendataan,
        ]);

        return redirect()->route('admin.sensuskk.index')
            ->with('success', 'Data Sensus KK berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $sensus = SensusKK::findOrFail($id);
        $sensus->delete();

        return redirect()->route('admin.sensuskk.index')
            ->with('success', 'Data Sensus KK berhasil dihapus.');
    }
}
