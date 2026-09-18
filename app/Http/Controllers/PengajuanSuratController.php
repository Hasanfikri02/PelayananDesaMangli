<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PengajuanSelesaiNotification;

class PengajuanSuratController extends Controller
{
    // ===================== ADMIN =====================

    // Admin lihat semua pengajuan
    public function index()
    {
        $pengajuan = PengajuanSurat::with('user', 'jenisSurat')->get();
        return view('admin.pengajuan.index', compact('pengajuan'));
    }

    // Admin lihat detail pengajuan
    public function show($id)
    {
        $pengajuan = PengajuanSurat::with('user', 'jenisSurat')->findOrFail($id);
        return view('admin.pengajuan.show', compact('pengajuan'));
    }

    // Update status pengajuan (Hanya Admin)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,ditolak',
            'keterangan_admin' => 'nullable|string'
        ]);

        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->update([
            'status' => $request->status,
            'keterangan_admin' => $request->keterangan_admin
        ]);

        // Kirim notifikasi ke user jika status selesai
        // if($request->status === 'selesai') {
        //     $pengajuan->user->notify(new PengajuanSelesaiNotification($pengajuan));
        // }

        return back()->with('success', 'Status pengajuan berhasil diupdate.');
    }

    // Cetak surat dari template (Hanya Admin)
    public function cetak($id)
    {
        $pengajuan = PengajuanSurat::with('jenisSurat')->findOrFail($id);
        $templatePath = storage_path('app/public/' . $pengajuan->jenisSurat->template_path);

        if (!file_exists($templatePath)) {
            return back()->with('error', 'Template surat tidak ditemukan.');
        }

        $template = new TemplateProcessor($templatePath);

        // Pastikan data_form didecode menjadi array
        $dataForm = is_string($pengajuan->data_form) ? json_decode($pengajuan->data_form, true) : $pengajuan->data_form;

        foreach ($dataForm as $key => $value) {
            $template->setValue($key, $value);
        }

        // Buat folder surat_user jika belum ada
        $folder = storage_path('app/public/surat_user');
        if(!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        $outputPath = $folder . '/surat_' . $pengajuan->id . '.docx';
        $template->saveAs($outputPath);
        $pengajuan->update(['file_hasil' => 'surat_user/surat_' . $pengajuan->id . '.docx']);

        return response()->download($outputPath)->deleteFileAfterSend(true);
    }

    // ===================== USER =====================

    // User lihat pengajuan sendiri
    // public function daftarUser()
    // {
    //     $pengajuan = PengajuanSurat::with('jenisSurat')
    //         ->where('user_id', auth()->id())
    //         ->get();
    //     return view('user.pengajuan.index', compact('pengajuan'));
    // }
}
