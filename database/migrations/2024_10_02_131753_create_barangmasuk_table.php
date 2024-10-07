<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('b_masuk', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_masuk');
            $table->unsignedSmallInteger('qty_masuk')->default(1); // Pastikan kuantitas positif
            $table->foreignId('barang_id')->constrained('barang')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Kembalikan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('b_masuk'); // Nama tabel sesuai
    }
};
