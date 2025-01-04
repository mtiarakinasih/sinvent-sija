<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('b_keluar', function (Blueprint $table) {
        $table->foreignId('aktivitas_log_id')
            ->nullable()
            ->constrained('aktivitas_logs')
            ->onDelete('cascade');
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bkeluar', function (Blueprint $table) {
            //
        });
    }
};
