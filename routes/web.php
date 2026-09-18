<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengajuanSuratController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\KategoriPengaduanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Warga\PengaduanWargaController;
use App\Http\Controllers\Warga\SensusWargaController;
use App\Http\Controllers\Warga\UserSuratController;


// Halaman Utama
Route::get('/', function () {
    $surat = \App\Models\JenisSurat::all(); // tampilkan semua surat
    return view('welcome', compact('surat'));
});

// Profile User
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================
// 🛡️ ADMIN ROUTES (Protected)
// ==========================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


    // CRUD Jenis Surat
    Route::get('surat', [JenisSuratController::class, 'index'])->name('jenissurat.index');
    Route::get('surat/create', [JenisSuratController::class, 'create'])->name('jenissurat.create');
    Route::post('surat', [JenisSuratController::class, 'store'])->name('jenissurat.store');
    Route::get('surat/{id}', [JenisSuratController::class, 'show'])->name('jenissurat.show');
    Route::get('surat/{id}/edit', [JenisSuratController::class, 'edit'])->name('jenissurat.edit');
    Route::put('surat/{id}', [JenisSuratController::class, 'update'])->name('jenissurat.update');
    Route::delete('surat/{id}', [JenisSuratController::class, 'destroy'])->name('jenissurat.destroy');

    // Pengajuan Surat
    Route::get('pengajuan', [PengajuanSuratController::class, 'index'])->name('pengajuan.index');
    Route::get('pengajuan/{id}', [PengajuanSuratController::class, 'show'])->name('pengajuan.show');
    Route::post('pengajuan/{id}/update-status', [PengajuanSuratController::class, 'updateStatus'])->name('pengajuan.updateStatus');
    Route::get('pengajuan/{id}/cetak', [PengajuanSuratController::class, 'cetak'])->name('pengajuan.cetak');



    // CRUD Kategori Pengaduan (lengkap)
    Route::get('kategori-pengaduan', [KategoriPengaduanController::class, 'index'])->name('kategori-pengaduan.index');
    Route::get('kategori-pengaduan/create', [KategoriPengaduanController::class, 'create'])->name('kategori-pengaduan.create');
    Route::post('kategori-pengaduan', [KategoriPengaduanController::class, 'store'])->name('kategori-pengaduan.store');
    Route::get('kategori-pengaduan/{id}', [KategoriPengaduanController::class, 'show'])->name('kategori-pengaduan.show'); // Show
    Route::get('kategori-pengaduan/{id}/edit', [KategoriPengaduanController::class, 'edit'])->name('kategori-pengaduan.edit');
    Route::put('kategori-pengaduan/{id}', [KategoriPengaduanController::class, 'update'])->name('kategori-pengaduan.update');
    Route::delete('kategori-pengaduan/{id}', [KategoriPengaduanController::class, 'destroy'])->name('kategori-pengaduan.destroy');

    // Pengaduan Admin
    // Pengaduan Admin
    Route::get('pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('pengaduan/{pengaduan}', [PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::get('pengaduan/{pengaduan}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
    Route::put('pengaduan/{pengaduan}', [PengaduanController::class, 'update'])->name('pengaduan.update');
    Route::delete('pengaduan/{pengaduan}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');

    // ==========================
    // CRUD User Admin
    // ==========================
    Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

    // CRUD Petugas
    Route::get('petugas', [\App\Http\Controllers\PetugasController::class, 'index'])->name('petugas.index');
    Route::get('petugas/create', [\App\Http\Controllers\PetugasController::class, 'create'])->name('petugas.create');
    Route::post('petugas', [\App\Http\Controllers\PetugasController::class, 'store'])->name('petugas.store');
    Route::get('petugas/{id}', [\App\Http\Controllers\PetugasController::class, 'show'])->name('petugas.show');
    Route::get('petugas/{id}/edit', [\App\Http\Controllers\PetugasController::class, 'edit'])->name('petugas.edit');
    Route::put('petugas/{id}', [\App\Http\Controllers\PetugasController::class, 'update'])->name('petugas.update');
    Route::delete('petugas/{id}', [\App\Http\Controllers\PetugasController::class, 'destroy'])->name('petugas.destroy');

    // CRUD Sensus KK (tambahkan di sini)
    Route::get('sensus-kk', [\App\Http\Controllers\SensusKKController::class, 'index'])->name('sensuskk.index');
    Route::get('sensus-kk/create', [\App\Http\Controllers\SensusKKController::class, 'create'])->name('sensuskk.create');
    Route::post('sensus-kk', [\App\Http\Controllers\SensusKKController::class, 'store'])->name('sensuskk.store');
    Route::get('sensus-kk/{id}', [\App\Http\Controllers\SensusKKController::class, 'show'])->name('sensuskk.show');
    Route::get('sensus-kk/{id}/edit', [\App\Http\Controllers\SensusKKController::class, 'edit'])->name('sensuskk.edit');
    Route::put('sensus-kk/{id}', [\App\Http\Controllers\SensusKKController::class, 'update'])->name('sensuskk.update');
    Route::delete('sensus-kk/{id}', [\App\Http\Controllers\SensusKKController::class, 'destroy'])->name('sensuskk.destroy');

    // ==========================
    // CRUD Sensus Penduduk (Admin)
    // ==========================
    Route::get('sensus-penduduk', [\App\Http\Controllers\SensusPendudukController::class, 'index'])->name('sensuspenduduk.index');
    Route::get('sensus-penduduk/create', [\App\Http\Controllers\SensusPendudukController::class, 'create'])->name('sensuspenduduk.create');
    Route::post('sensus-penduduk', [\App\Http\Controllers\SensusPendudukController::class, 'store'])->name('sensuspenduduk.store');
    Route::get('sensus-penduduk/{id}', [\App\Http\Controllers\SensusPendudukController::class, 'show'])->name('sensuspenduduk.show');
    Route::get('sensus-penduduk/{id}/edit', [\App\Http\Controllers\SensusPendudukController::class, 'edit'])->name('sensuspenduduk.edit');
    Route::put('sensus-penduduk/{id}', [\App\Http\Controllers\SensusPendudukController::class, 'update'])->name('sensuspenduduk.update');
    Route::delete('sensus-penduduk/{id}', [\App\Http\Controllers\SensusPendudukController::class, 'destroy'])->name('sensuspenduduk.destroy');

    // ==========================
    // CRUD Sensus Rumah (Admin)
    // ==========================
    Route::get('sensus-rumah', [\App\Http\Controllers\SensusRumahController::class, 'index'])->name('sensusrumah.index');
    Route::get('sensus-rumah/create', [\App\Http\Controllers\SensusRumahController::class, 'create'])->name('sensusrumah.create');
    Route::post('sensus-rumah', [\App\Http\Controllers\SensusRumahController::class, 'store'])->name('sensusrumah.store');
    Route::get('sensus-rumah/{id}', [\App\Http\Controllers\SensusRumahController::class, 'show'])->name('sensusrumah.show');
    Route::get('sensus-rumah/{id}/edit', [\App\Http\Controllers\SensusRumahController::class, 'edit'])->name('sensusrumah.edit');
    Route::put('sensus-rumah/{id}', [\App\Http\Controllers\SensusRumahController::class, 'update'])->name('sensusrumah.update');
    Route::delete('sensus-rumah/{id}', [\App\Http\Controllers\SensusRumahController::class, 'destroy'])->name('sensusrumah.destroy');

    Route::get('pengajuan', [PengajuanSuratController::class, 'index'])->name('pengajuan.index');
    Route::get('pengajuan/{id}', [PengajuanSuratController::class, 'show'])->name('pengajuan.show');
    Route::post('pengajuan/{id}/update-status', [PengajuanSuratController::class, 'updateStatus'])->name('pengajuan.updateStatus');
    Route::get('pengajuan/{id}/cetak', [PengajuanSuratController::class, 'cetak'])->name('pengajuan.cetak'); // cetak PDF
});

// ==========================
// 👤 USER ROUTES (Protected)
// ==========================
Route::middleware(['auth'])->prefix('warga')->name('warga.')->group(function () {
    Route::get('surat', [JenisSuratController::class, 'daftarSurat'])->name('surat.index');
    Route::get('surat/ajukan/{id}', [JenisSuratController::class, 'ajukan'])->name('surat.ajukan');
    Route::post('surat/kirim', [JenisSuratController::class, 'kirimPengajuan'])->name('surat.kirim');


    // 📌 Pengaduan Warga
    // 📌 Pengaduan Warga
    Route::get('pengaduan', [PengaduanWargaController::class, 'index'])->name('pengaduan.index');
    Route::get('pengaduan/form/{id}', [PengaduanWargaController::class, 'form'])->name('pengaduan.form');
    Route::post('pengaduan', [PengaduanWargaController::class, 'store'])->name('pengaduan.store');

    // Route::get('pengaduan/{id}', [PengaduanWargaController::class, 'show'])->name('pengaduan.show');
    // Lihat daftar surat
    // 📌 1. Daftar Jenis Surat
    Route::get('surat', [UserSuratController::class, 'index'])->name('surat.index');

    // 📌 2. Form pengajuan sesuai jenis surat
    Route::get('surat/form/{id}', [UserSuratController::class, 'form'])->name('surat.form');

    // 📌 3. Kirim pengajuan
    Route::post('surat/form/{id}', [UserSuratController::class, 'store'])->name('surat.store');

    // 📌 4. Riwayat pengajuan
    Route::get('surat/riwayat', [UserSuratController::class, 'riwayat'])->name('surat.riwayat');

    // 📌 5. Detail pengajuan
    Route::get('surat/detail/{id}', [UserSuratController::class, 'detail'])->name('surat.detail');

    // HALAMAN SESNSUS PENDUDUK
    // Halaman Sensus Warga
    Route::get('/sensus-warga', [SensusWargaController::class, 'index'])
        ->name('sensuswarga');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});






require __DIR__ . '/auth.php';
