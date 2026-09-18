<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('sensus_kk', function (Blueprint $table) {

        // Hapus relasi lama
        $table->dropForeign(['petugas_id']);

        // Tambah relasi ke tabel petugas
        $table->foreign('petugas_id')
              ->references('id')
              ->on('petugas')
              ->onDelete('set null');
    });
}

public function down(): void
{
    Schema::table('sensus_kk', function (Blueprint $table) {
        $table->dropForeign(['petugas_id']);

        // Balik ke relasi lama (jika dibutuhkan)
        $table->foreign('petugas_id')
              ->references('id')
              ->on('users')
              ->onDelete('set null');
    });
}

};
