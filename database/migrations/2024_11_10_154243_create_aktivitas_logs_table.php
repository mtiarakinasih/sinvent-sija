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
            $table->timestamps(0);  // Adds created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Disable foreign key checks temporarily
        Schema::disableForeignKeyConstraints();

        // Check and drop foreign key constraints if they exist
        if (Schema::hasTable('b_masuk') && Schema::hasColumn('b_masuk', 'aktivitas_log_id')) {
            Schema::table('b_masuk', function (Blueprint $table) {
                $table->dropForeign(['aktivitas_log_id']);
            });
        }

        if (Schema::hasTable('b_keluar') && Schema::hasColumn('b_keluar', 'aktivitas_log_id')) {
            Schema::table('b_keluar', function (Blueprint $table) {
                $table->dropForeign(['aktivitas_log_id']);
            });
        }

        // Drop the 'aktivitas_logs' table
        Schema::dropIfExists('aktivitas_logs');

        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();
    }
};
