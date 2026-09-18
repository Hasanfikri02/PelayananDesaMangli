<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;

    protected $table = 'jenis_surat';
    protected $fillable = ['nama_surat', 'deskripsi', 'template_path', 'is_active'];

    public function pengajuanSurat()
    {
        return $this->hasMany(PengajuanSurat::class);
    }
}

