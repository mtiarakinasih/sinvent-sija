<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use App\Models\Barang; // Pastikan model Barang di-import jika digunakan
use App\Models\AktivitasLog;  

class CategoryController extends Controller
{
    public function index(Request $request)
{
    // Jika ada pencarian, lakukan filter
    if ($request->search) {
        $rsKategori = DB::table('kategori')
                        ->select('id', 'deskripsi', 'kategori', DB::raw('ketKategori(kategori) as ket'))
                        ->where('id', 'like', '%' . $request->search . '%')
                        ->orWhere('deskripsi', 'like', '%' . $request->search . '%')
                        ->paginate(5);
    } else {
        // Jika tidak ada pencarian, tampilkan semua kategori
        $rsKategori = DB::table('kategori')
                        ->select('id', 'deskripsi', 'kategori', DB::raw('ketKategori(kategori) as ket'))
                        ->paginate(5);
    }

    // Kirim data kategori ke view
    return view('backend.kategori.index', compact('rsKategori'));
}

    public function create()
    {
        $listKategori = array(
            '' => 'Pilih Kategori',
            'M' => 'Modal',
            'A' => 'Alat',
            'BHP' => 'Bahan Habis Pakai',
            'BTHP' => 'Bahan Tidak Habis Pakai'
        );
        return view('backend.kategori.create', compact('listKategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required',
            'kategori' => 'required'
        ]);
        
        Kategori::create([
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori
        ]);
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id)
    {
        $rsKategori = DB::table('kategori')
                        ->select('id', 'deskripsi', 'kategori', DB::raw('ketKategori(kategori) as ket'))
                        ->where('id', $id)
                        ->get();
        return view('backend.kategori.show', compact('rsKategori'));
    }

    public function edit($id)
    {
        $rsKategori = DB::table('kategori')
                        ->select('id', 'deskripsi', 'kategori')
                        ->where('id', $id)
                        ->first(); // Mengambil satu hasil untuk edit

        if (!$rsKategori) {
            return redirect()->route('kategori.index')->with('error', 'Data tidak ditemukan.');
        }

        $listKategori = [
            '' => 'Pilih Kategori',
            'M' => 'Modal',
            'A' => 'Alat',
            'BHP' => 'Bahan Habis Pakai',
            'BTHP' => 'Bahan Tidak Habis Pakai'
        ];

        return view('backend.kategori.edit', compact('rsKategori', 'listKategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'deskripsi' => 'required',
            'kategori' => 'required'
        ]);
        
        $rsKategori = Kategori::find($id);
        $rsKategori->update($request->all());
        
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        if (DB::table('barang')->where('kategori_id', $id)->exists()) {
            return redirect()->route('kategori.index')->with(['error' => 'Data Gagal Dihapus, Terkait dengan Barang']);
        } else {
            $rseKategori = Kategori::find($id);
            $rseKategori->delete();
            return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus']);
        }
    }

    public function categoryChartData()
{
    // Fetch the latest 5 activity logs (tidak diubah, tetap seperti ini)
    $activityLogs = AktivitasLog::latest()->take(5)->get();

    // Fetch jumlah barang per kategori
    $categories = Barang::join('kategori', 'barang.kategori_id', '=', 'kategori.id')
        ->select('kategori.kategori as kategori', \DB::raw('count(*) as jumlah')) // Menggunakan 'jumlah'
        ->groupBy('kategori.kategori')
        ->get();

    // Tidak perlu menghitung persentase
    return view('backend.dashboard', compact('activityLogs', 'categories'));
}

}
