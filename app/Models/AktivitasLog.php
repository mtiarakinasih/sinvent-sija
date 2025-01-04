<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivitasLog extends Model
{
    use HasFactory;

    protected $fillable = ['activity_type', 'description', 'created_at'];

    // Relasi ke barang_masuk
    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'aktivitas_log_id');
    }

    // Relasi ke barang_keluar
    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'aktivitas_log_id');
    }
}

