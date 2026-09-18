<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSuratController extends Controller
{
    // ===========================
    // 1. INDEX – daftar jenis surat
    // ===========================
    public function index()
    {
        $jenis = JenisSurat::where('is_active', true)->get();

        return view('warga.surat.index', compact('jenis'));
    }

    // ===========================
    // 2. FORM – tampilkan form sesuai jenis
    // ===========================
    public function form($id)
    {
        $jenis = JenisSurat::findOrFail($id);

        // decode JSON
        $formFields = json_decode($jenis->form_fields, true);

        // kalau null atau kosong → isi default
        if (!$formFields) {
            $formFields = [
                ["label" => "Nama Lengkap", "name" => "nama_lengkap"],
                ["label" => "No. KK", "name" => "no_kk"],
                ["label" => "NIK", "name" => "nik"],
                ["label" => "Alamat", "name" => "alamat"],
                ["label" => "RT", "name" => "rt"],
                ["label" => "RW", "name" => "rw"],
                ["label" => "Kode Pos", "name" => "kode_pos"],
                ["label" => "Jenis Permohonan", "name" => "jenis_permohonan"],
            ];
        }

        return view('warga.surat.form', compact('jenis', 'formFields'));
    }



    // ===========================
    // 3. STORE – simpan pengajuan
    // ===========================
    public function store(Request $request, $id)
    {
        $data = $request->except('_token');

        PengajuanSurat::create([
            'user_id' => Auth::id(),
            'jenis_surat_id' => $id,
            'data_form' => json_encode($data),
        ]);

        return redirect()->route('warga.surat.riwayat')
            ->with('success', 'Pengajuan surat berhasil diajukan!');
    }

    // ===========================
    // 4. RIWAYAT – daftar pengajuan user
    // ===========================
    public function riwayat()
    {
        $riwayat = PengajuanSurat::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('warga.surat.riwayat', compact('riwayat'));
    }

    // ===========================
    // 5. DETAIL – detail 1 pengajuan
    // ===========================
    public function detail($id)
    {
        $data = PengajuanSurat::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        return view('warga.surat.detail', compact('data'));
    }
}
