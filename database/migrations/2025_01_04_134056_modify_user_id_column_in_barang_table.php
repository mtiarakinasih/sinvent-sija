<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUserIdColumnInBarangTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('barang', function (Blueprint $table) {
            if (Schema::hasColumn('barang', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->change(); // Mengubah kolom user_id menjadi nullable
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            } else {
                // Jika kolom tidak ada, tambahkan kolom baru
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('barang', function (Blueprint $table) {
            if (Schema::hasColumn('barang', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id'); // Hapus kolom jika ada
            }
        });
    }
}
