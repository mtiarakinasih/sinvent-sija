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
    Schema::table('barang', function (Blueprint $table) {
        $table->integer('stok')->default(0)->change(); // Mengatur default 0 untuk stok
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
