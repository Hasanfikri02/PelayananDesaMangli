<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Petugas extends Model
{
    use HasFactory;

    protected $table = 'petugas';

    // Kolom yang boleh diisi massal (fillable)
    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'jabatan',
        'wilayah',
    ];

    // Relasi ke sensus_kk (1 petugas bisa mendata banyak KK)
    public function sensusKK()
    {
        return $this->hasMany(SensusKK::class, 'petugas_id');
    }
}
