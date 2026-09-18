<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensusPenduduk extends Model
{
    // Nama tabel sesuai migration
    protected $table = 'sensus_penduduk';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'pendidikan',
        'pekerjaan',
        'status_perkawinan',
        'hubungan_keluarga',
        'kk_id', // foreign key ke sensus_kk
    ];

    // Relasi ke tabel KK
    public function kk()
    {
        return $this->belongsTo(SensusKK::class, 'kk_id');
    }

    // Contoh accessor untuk ambil alamat lengkap dari KK
    public function getAlamatLengkapAttribute()
    {
        if($this->kk) {
            return $this->kk->alamat . ' RT ' . $this->kk->rt . ' RW ' . $this->kk->rw;
        }
        return '-';
    }
}
