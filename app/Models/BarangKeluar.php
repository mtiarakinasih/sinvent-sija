<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'b_keluar'; // Nama tabel
    protected $fillable = ['tgl_keluar', 'qty_keluar', 'barang_id']; // Kolom yang dapat diisi

    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
