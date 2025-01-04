<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddAktivitasToBkeluar extends Migration
{
    public function up()
    {
        // Disable foreign key checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        // Drop the foreign key if it exists by checking the key manually
        $foreignKeyExists = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_NAME = 'b_keluar' 
            AND TABLE_SCHEMA = DATABASE()
            AND CONSTRAINT_NAME = 'b_keluar_aktivitas_log_id_foreign'
        ");

        if ($foreignKeyExists) {
            DB::statement('ALTER TABLE b_keluar DROP FOREIGN KEY b_keluar_aktivitas_log_id_foreign');
        }

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        // Add new column and foreign key constraint
        Schema::table('b_keluar', function (Blueprint $table) {
            $table->unsignedBigInteger('aktivitas_log_id')->nullable()->after('barang_id');
            $table->foreign('aktivitas_log_id')->references('id')->on('aktivitas_logs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('b_keluar', function (Blueprint $table) {
            // Drop the foreign key and column
            $table->dropForeign(['aktivitas_log_id']);
            $table->dropColumn('aktivitas_log_id');
        });
    }
}
