<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPengaduan extends Model
{
    use HasFactory;

    protected $table = 'kategori_pengaduan';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'is_active',
    ];

    // Relasi one-to-many: satu kategori bisa punya banyak pengaduan
    public function pengaduan()
    {
        return $this->hasMany(\App\Models\Pengaduan::class, 'kategori_id');
    }
}
