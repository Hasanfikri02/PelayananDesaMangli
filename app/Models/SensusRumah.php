<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensusRumah extends Model
{
    use HasFactory;

    protected $table = 'sensus_rumah';

    protected $fillable = [
        'kode_rumah',
        'alamat',
        'jumlah_penghuni',
        'kepemilikan_rumah',
        'bahan_bangunan',
        'sumber_air',
        'sumber_listrik',
        'kk_id',
    ];

    // Relasi ke KK
    public function kk()
    {
        return $this->belongsTo(SensusKK::class, 'kk_id');
    }

    // Optional: hitung jumlah penduduk otomatis lewat KK
    public function jumlahPenduduk()
    {
        return $this->kk ? $this->kk->penduduk()->count() : 0;
    }
}
