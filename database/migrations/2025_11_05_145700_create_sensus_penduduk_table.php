<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sensus_penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 20)->unique();
            $table->string('nama', 100);
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama', 50)->nullable();
            $table->string('pendidikan', 100)->nullable();
            $table->string('pekerjaan', 100)->nullable();
            $table->string('status_perkawinan', 50)->nullable();
            $table->string('hubungan_keluarga', 50)->nullable();
            $table->unsignedBigInteger('kk_id');
            $table->timestamps();

            // Relasi ke sensus_kk
            $table->foreign('kk_id')->references('id')->on('sensus_kk')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sensus_penduduk');
    }
};
