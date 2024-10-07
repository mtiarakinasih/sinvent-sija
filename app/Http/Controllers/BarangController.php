<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori; // Pastikan untuk mengimpor model Kategori
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    // Menampilkan daftar barang dengan opsi pencarian
    public function index(Request $request)
    {
        $search = $request->search;

        $query = DB::table('barang')
                    ->select('barang.id', 'barang.merk', 'barang.seri', 'barang.spesifikasi', 'barang.stok', 'barang.kategori_id', 'kategori.deskripsi');

        $query->leftJoin('kategori', 'barang.kategori_id', '=', 'kategori.id');

        // Jika ada pencarian, filter hasil
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('barang.merk', 'like', '%' . $search . '%')
                  ->orWhere('barang.seri', 'like', '%' . $search . '%')
                  ->orWhere('barang.spesifikasi', 'like', '%' . $search . '%')
                  ->orWhere('kategori.deskripsi', 'like', '%' . $search . '%'); // Pencarian di nama kategori
            });
        }

        $rsetBarang = $query->paginate(5);
        Paginator::useBootstrap();

        return view('backend.barang.index', compact('rsetBarang'));
    }

    // Menampilkan form untuk membuat barang baru
    public function create()
    {
        $rsetKategori = Kategori::all();
        return view('backend.barang.create', compact('rsetKategori'));
    }

    // Menyimpan data barang baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'merk' => 'required|string|max:50|unique:barang,merk',
            'seri' => 'nullable|string|max:50',
            'spesifikasi' => 'nullable|string',
            'stok' => 'nullable|numeric',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        // Jika validasi gagal, kembalikan ke form
        if ($validator->fails()) {
            return redirect()->route('barang.create')
                ->withErrors($validator)
                ->withInput();
        }

        $stok = $request->input('stok', 0) ?? 0;

        // Menyimpan barang ke database
        Barang::create([
            'merk' => $request->merk,
            'seri' => $request->seri,
            'spesifikasi' => $request->spesifikasi,
            'stok' => $stok,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('barang.index')->with(['success' => 'Data Barang Berhasil Disimpan!']);
    }

    // Menampilkan detail barang
    public function show(string $id)
{
    // Mengambil data barang dengan join ke kategori
    $rsetBarang = DB::table('barang')
        ->leftJoin('kategori', 'barang.kategori_id', '=', 'kategori.id')
        ->select('barang.*', 'kategori.deskripsi', DB::raw('ketKategori(kategori.kategori) as ket'))
        ->where('barang.id', $id)
        ->first(); // Mengambil satu data barang

    return view('backend.barang.show', compact('rsetBarang'));
}



    // Menampilkan form untuk mengedit barang
    public function edit(string $id)
    {
        $rsetBarang = Barang::find($id);
        $rsKategori = Kategori::all();
        return view('backend.barang.edit', compact('rsetBarang', 'rsKategori'));
    }

    // Mengupdate data barang
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'merk' => 'required|string|max:50',
            'seri' => 'nullable|string|max:50',
            'spesifikasi' => 'nullable|string',
            'stok' => 'nullable|numeric',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('barang.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $barang = Barang::find($id);
        $barang->update([
            'merk' => $request->merk,
            'seri' => $request->seri,
            'spesifikasi' => $request->spesifikasi,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('barang.index')->with(['success' => 'Data Barang Berhasil Diubah!']);
    }

    // Menghapus barang
    public function destroy($id)
    {
        //Mengecek apakah barang masih digunakan dalam tabel lain
        if (DB::table('b_masuk')->where('barang_id', $id)->exists() || DB::table('b_keluar')->where('barang_id', $id)->exists()) {
            return redirect()->route('barang.index')->with(['Gagal' => 'Data Gagal Dihapus!']);
        } else {
            $barang = Barang::find($id);
            $barang->delete();
            return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
        
    }
}
