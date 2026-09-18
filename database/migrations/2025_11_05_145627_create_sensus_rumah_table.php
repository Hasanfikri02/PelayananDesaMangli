<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sensus_rumah', function (Blueprint $table) {
            $table->id();
            $table->string('kode_rumah', 30)->unique();
            $table->string('alamat', 255);
            $table->integer('jumlah_penghuni')->default(0);
            $table->enum('kepemilikan_rumah', ['milik sendiri', 'sewa', 'kontrak', 'lainnya'])->default('milik sendiri');
            $table->string('bahan_bangunan', 100)->nullable();
            $table->string('sumber_air', 100)->nullable();
            $table->string('sumber_listrik', 100)->nullable();
            $table->unsignedBigInteger('kk_id');
            $table->timestamps();

            // Relasi ke sensus_kk
            $table->foreign('kk_id')->references('id')->on('sensus_kk')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sensus_rumah');
    }
};
