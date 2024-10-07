<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;  // Pastikan model BarangMasuk diimpor
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BarangKeluarController extends Controller
{
    // Menampilkan data barang keluar
    public function index(Request $request)
{
    $search = $request->search;

    // Query to fetch data from b_keluar
    $query = DB::table('b_keluar')
        ->select('b_keluar.id', 'b_keluar.tgl_keluar', 'b_keluar.qty_keluar', 'b_keluar.barang_id', 'barang.merk')
        ->leftJoin('barang', 'b_keluar.barang_id', '=', 'barang.id');

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('barang.id', 'like', '%' . $search . '%')
              ->orWhere('barang.merk', 'like', '%' . $search . '%')
              ->orWhere('b_keluar.tgl_keluar', 'like', '%' . $search . '%')
              ->orWhere('b_keluar.qty_keluar', 'like', '%' . $search . '%');
        });
    }

    // Fetching the barang keluar data
    $rsetBarangKeluar = $query->paginate(5);
    Paginator::useBootstrap();

    // Only pass the relevant data to the view
    return view('backend.b_keluar.index', compact('rsetBarangKeluar'));
}

    // Menyimpan data barang keluar baru
    public function store(Request $request)
{
    // Validasi input yang diterima
    $request->validate([
        'barang_id' => 'required|exists:barang,id', // Pastikan barang ada di database
        'tgl_keluar' => 'required|date', // Validasi tanggal keluar
        'qty_keluar' => 'required|integer|min:1', // Validasi jumlah keluar
    ]);

    // Dapatkan barang masuk paling awal dari database
    $barangMasuk = BarangMasuk::where('barang_id', $request->barang_id)
        ->orderBy('tgl_masuk', 'asc')
        ->first(); // Ambil tanggal barang masuk paling awal

    if (!$barangMasuk) {
        return back()->withErrors(['barang_id' => 'Barang tidak ditemukan dalam data barang masuk.']);
    }

    // Validasi tanggal keluar tidak boleh lebih awal dari tanggal masuk
    if ($request->tgl_keluar < $barangMasuk->tgl_masuk) {
        return back()->withErrors(['tgl_keluar' => 'Tanggal keluar tidak boleh kurang dari tanggal masuk.']);
    }

    // Proses penyimpanan jika validasi berhasil
    BarangKeluar::create([
        'barang_id' => $request->barang_id,
        'tgl_keluar' => $request->tgl_keluar,
        'qty_keluar' => $request->qty_keluar,
    ]);

    return redirect()->route('barangkeluar.index')->with('success', 'Data barang keluar berhasil disimpan.');
}


    public function create()
{
    // Get all barang to populate the dropdown
    $rsetBarang = Barang::all(); // Fetch all items from the barang table

    return view('backend.b_keluar.create', compact('rsetBarang')); // Pass the variable to the view
}



    // Hapus data barang keluar
    public function destroy(string $id)
    {
        try {
            $rsetBarangKeluar = BarangKeluar::find($id);
        
            if (!$rsetBarangKeluar) {
                throw new \Exception('Barang keluar tidak ditemukan');
            }

            // Tambahkan kembali stok barang terkait
            $rsetBarang = Barang::find($rsetBarangKeluar->barang_id);
            $rsetBarang->stok += $rsetBarangKeluar->qty_keluar;
            $rsetBarang->save();

            $rsetBarangKeluar->delete();

            return redirect()->route('barangkeluar.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            return redirect()->route('barangkeluar.index')->with(['error' => $e->getMessage()]);
        }
    }
}
