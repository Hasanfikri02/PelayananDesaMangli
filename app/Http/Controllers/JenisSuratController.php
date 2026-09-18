<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\JenisSurat;
use App\Models\PengajuanSurat;
use App\Notifications\SuratDisetujuiNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class JenisSuratController extends Controller
{
    /**
     * Menampilkan daftar semua jenis surat (khusus admin).
     */
    public function index()
    {
        $surat = JenisSurat::all();
        return view('admin.jenissurat.index', compact('surat'));

    }

    /**
     * Menampilkan form tambah surat baru (admin).
     */
    public function create()
    {
        return view('admin.jenissurat.create');
    }

    /**
     * Menyimpan data surat baru ke database (admin).
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_surat' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'template_path' => 'nullable|file|mimes:doc,docx,pdf'
        ]);

        $path = null;
        if ($request->hasFile('template_path')) {
            $path = $request->file('template_path')->store('templates', 'public');
        }

        JenisSurat::create([
            'nama_surat' => $request->nama_surat,
            'deskripsi' => $request->deskripsi,
            'template_path' => $path,
            'is_active' => true,
        ]);

        return redirect()->route('admin.jenissurat.index')->with('success', 'Jenis surat baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail surat.
     */
   public function show($id)
{
    $surat = JenisSurat::findOrFail($id);
    return view('admin.jenissurat.show', ['item' => $surat]);
}

// Menampilkan form edit jenis surat
public function edit($id)
{
    $item = JenisSurat::findOrFail($id);
    return view('admin.jenissurat.edit', compact('item'));
}

// Memproses update jenis surat
public function update(Request $request, $id)
{
    $item = JenisSurat::findOrFail($id);

    $request->validate([
        'nama_surat' => 'required|string|max:100',
        'deskripsi' => 'nullable|string',
        'is_active' => 'required|boolean',
        'template_path' => 'nullable|file|mimes:doc,docx,pdf'
    ]);

    $item->nama_surat = $request->nama_surat;
    $item->deskripsi = $request->deskripsi;
    $item->is_active = $request->is_active;

    if ($request->hasFile('template_path')) {
        $path = $request->file('template_path')->store('templates', 'public');
        $item->template_path = $path;
    }

    $item->save();

    return redirect()->route('admin.jenissurat.index')->with('success', 'Jenis surat berhasil diupdate.');
}


    /**
     * Admin menyetujui surat dan kirim notifikasi ke user.
     */
    public function setujui($id, $userId)
    {
        $jenisSurat = JenisSurat::findOrFail($id);
        $user = User::findOrFail($userId);

        // kirim notifikasi ke user
        $user->notify(new SuratDisetujuiNotification($jenisSurat));

        return back()->with('success', 'Notifikasi berhasil dikirim ke user.');
    }

    /**
     * Menghapus surat (admin).
     */
    public function destroy($id)
    {
        $surat = JenisSurat::findOrFail($id);
        $surat->delete();

        return redirect()->route('admin.jenissurat.index')->with('success', 'Surat berhasil dihapus.');
    }

    /**
     * Menampilkan daftar surat untuk user.
     */
    public function daftarSurat()
    {
        $surat = JenisSurat::where('is_active', true)->get();
        return view('user.surat.index', compact('surat'));
    }

    /**
     * Form pengajuan surat oleh user.
     */
    public function ajukan($id)
    {
        $surat = JenisSurat::findOrFail($id);
        return view('user.surat.ajukan', compact('surat'));
    }

    /**
     * Simpan pengajuan surat ke database.
     */
    public function kirimPengajuan(Request $request)
    {
        $request->validate([
            'jenis_surat_id' => 'required|exists:jenis_surat,id',
            'data_form' => 'required|array',
        ]);

        PengajuanSurat::create([
            'user_id' => auth()->id(),
            'jenis_surat_id' => $request->jenis_surat_id,
            'data_form' => $request->data_form,
        ]);

        return redirect()->route('warga.surat.index')->with('success', 'Pengajuan surat berhasil dikirim.');
    }

    /**
     * Admin mencetak surat berdasarkan template yang diisi.
     */
    public function cetak($id)
    {
        $pengajuan = PengajuanSurat::with('jenisSurat', 'user')->findOrFail($id);
        $templatePath = storage_path('app/public/' . $pengajuan->jenisSurat->template_path);

        if (!file_exists($templatePath)) {
            return back()->with('error', 'Template surat tidak ditemukan.');
        }

        $template = new TemplateProcessor($templatePath);

        // Ganti placeholder di template dengan data dari form
        foreach ($pengajuan->data_form as $key => $value) {
            $template->setValue($key, $value);
        }

        $outputPath = storage_path('app/public/surat_user/surat_' . $pengajuan->id . '.docx');
        $template->saveAs($outputPath);

        $pengajuan->update(['file_hasil' => 'surat_user/surat_' . $pengajuan->id . '.docx']);

        return response()->download($outputPath)->deleteFileAfterSend(true);
    }
}
