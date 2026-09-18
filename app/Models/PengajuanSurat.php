<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_surat';

    protected $fillable = [
        'user_id',
        'jenis_surat_id',
        'data_form',
        'tanggal_pengajuan',
        'status',
        'keterangan_admin',
        'file_hasil',
    ];

    protected $casts = [
        'data_form' => 'array', // supaya json otomatis jadi array di Laravel
        'tanggal_pengajuan' => 'datetime',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke JenisSurat
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class);
    }
}
