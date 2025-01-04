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
        Schema::create('aktivitas_logs', function (Blueprint $table) {
            $table->id();
            $table->string('activity_type'); // e.g., 'Barang Masuk', 'Barang Keluar'
            $table->string('description');   // e.g., 'Printer, Kategori: Elektronik'
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Nonaktifkan pemeriksaan foreign key sementara
        Schema::disableForeignKeyConstraints();

        // Drop foreign key constraints dari tabel terkait jika tabel tersebut ada
        if (Schema::hasTable('b_masuk')) {
            Schema::table('b_masuk', function (Blueprint $table) {
                $table->dropForeign(['aktivitas_log_id']);
            });
        }

        if (Schema::hasTable('b_keluar')) {
            Schema::table('b_keluar', function (Blueprint $table) {
                $table->dropForeign(['aktivitas_log_id']);
            });
        }

        // Hapus tabel aktivitas_logs
        Schema::dropIfExists('aktivitas_logs');

        // Aktifkan kembali pemeriksaan foreign key
        Schema::enableForeignKeyConstraints();
    }
};
