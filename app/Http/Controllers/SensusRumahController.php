<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensusRumah;
use App\Models\SensusKK;

class SensusRumahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua rumah beserta KK
        $rumahQuery = SensusRumah::with('kk');

        // Filter berdasarkan KK jika ada
        if ($request->filled('kk')) {
            $rumahQuery->where('kk_id', $request->kk);
        }

        // Search berdasarkan kode rumah atau alamat
        if ($request->filled('search')) {
            $search = $request->search;
            $rumahQuery->where(function($q) use ($search) {
                $q->where('kode_rumah', 'like', "%$search%")
                  ->orWhere('alamat', 'like', "%$search%");
            });
        }

        $rumah = $rumahQuery->get();

        // Ambil semua KK untuk filter dropdown
        $allKK = SensusKK::all();
        // ===============================
        // Statistik
        // ===============================
        $totalRumah = $rumah->count();
        $milikSendiri = $rumah->where('kepemilikan_rumah', 'milik sendiri')->count();
        $sewa = $rumah->where('kepemilikan_rumah', 'sewa')->count();
        $kontrak = $rumah->where('kepemilikan_rumah', 'kontrak')->count();
        $lainnya = $rumah->where('kepemilikan_rumah', 'lainnya')->count();

        $totalPenghuni = $rumah->sum('jumlah_penghuni');
        $rataPenghuni = $rumah->avg('jumlah_penghuni');

        $rumahKosong = $rumah->where('jumlah_penghuni', 0)->count();
        $rumahPadat = $rumah->where('jumlah_penghuni', '>', 5)->count();
        return view('admin.rumah.index', compact(
            'rumah', 'allKK',
            'totalRumah', 'milikSendiri', 'sewa', 'kontrak', 'lainnya',
            'totalPenghuni', 'rataPenghuni', 'rumahKosong', 'rumahPadat'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kk = SensusKK::all(); // Untuk select box KK
        return view('admin.rumah.create', compact('kk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_rumah' => 'required|unique:sensus_rumah,kode_rumah|max:30',
            'alamat' => 'required|string|max:255',
            'jumlah_penghuni' => 'required|integer|min:0',
            'kepemilikan_rumah' => 'required|in:milik sendiri,sewa,kontrak,lainnya',
            'bahan_bangunan' => 'nullable|string|max:100',
            'sumber_air' => 'nullable|string|max:100',
            'sumber_listrik' => 'nullable|string|max:100',
            'kk_id' => 'required|exists:sensus_kk,id',
        ]);

        SensusRumah::create($request->all());

        return redirect()->route('admin.sensusrumah.index')
                         ->with('success', 'Data rumah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rumah = SensusRumah::with('kk')->findOrFail($id);
        return view('admin.rumah.show', compact('rumah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rumah = SensusRumah::findOrFail($id);
        $kk = SensusKK::all();
        return view('admin.rumah.edit', compact('rumah', 'kk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rumah = SensusRumah::findOrFail($id);

        $request->validate([
            'kode_rumah' => 'required|unique:sensus_rumah,kode_rumah,' . $id . '|max:30',
            'alamat' => 'required|string|max:255',
            'jumlah_penghuni' => 'required|integer|min:0',
            'kepemilikan_rumah' => 'required|in:milik sendiri,sewa,kontrak,lainnya',
            'bahan_bangunan' => 'nullable|string|max:100',
            'sumber_air' => 'nullable|string|max:100',
            'sumber_listrik' => 'nullable|string|max:100',
            'kk_id' => 'required|exists:sensus_kk,id',
        ]);

        $rumah->update($request->all());

        return redirect()->route('admin.sensusrumah.index')
                         ->with('success', 'Data rumah berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rumah = SensusRumah::findOrFail($id);
        $rumah->delete();

        return redirect()->route('admin.sensusrumah.index')
                         ->with('success', 'Data rumah berhasil dihapus');
    }
}
