<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sensus_kk', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kk', 20)->unique();
            $table->string('kepala_keluarga', 100);
            $table->string('alamat', 255);
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();
            $table->date('tanggal_pendataan')->nullable();
            $table->unsignedBigInteger('petugas_id')->nullable();
            $table->timestamps();

            // Relasi ke user (admin)
            $table->foreign('petugas_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sensus_kk');
    }
};
