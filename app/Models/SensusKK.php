<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensusKK extends Model
{
    use HasFactory;

    protected $table = 'sensus_kk';

    protected $fillable = [
        'nomor_kk',
        'kepala_keluarga',
        'alamat',
        'rt',
        'rw',
        'tanggal_pendataan',
        'petugas_id',
    ];

    // Relasi ke petugas
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }
}
