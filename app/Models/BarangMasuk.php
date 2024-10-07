<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'b_masuk'; // Nama tabel
    protected $fillable = ['tgl_masuk', 'qty_masuk', 'barang_id']; // Kolom yang dapat diisi

    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
