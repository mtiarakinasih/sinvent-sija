<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BarangMasukController extends Controller
{
    // Menampilkan data barang masuk
    public function index(Request $request)
    {
        $search = $request->search;

        // Menggunakan tabel b_masuk
        $query = DB::table('b_masuk')
            ->select('b_masuk.id', 'b_masuk.tgl_masuk', 'b_masuk.qty_masuk', 'b_masuk.barang_id', 'barang.merk', 'kategori.kategori as kategori')
            ->leftJoin('barang', 'b_masuk.barang_id', '=', 'barang.id')
            ->leftJoin('kategori', 'barang.kategori_id', '=', 'kategori.id');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('b_masuk.id', 'like', '%' . $search . '%')
                ->orWhere('barang.merk', 'like', '%' . $search . '%')
                ->orWhere('b_masuk.tgl_masuk', 'like', '%' . $search . '%')
                ->orWhere('b_masuk.qty_masuk', 'like', '%' . $search . '%');
            });
        }

        $rsetBarangMasuk = $query->paginate(5);
        Paginator::useBootstrap();

        return view('backend.b_masuk.index', compact('rsetBarangMasuk'));
    }

    // Menampilkan form untuk menambah data barang masuk
    public function create()
    {
        $rsetBarang = Barang::all(); // Ambil semua data barang untuk dropdown
        return view('backend.b_masuk.create', compact('rsetBarang'));
    }

    // Menyimpan data barang masuk baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tgl_masuk' => 'required|date',
            'qty_masuk' => 'nullable|integer',
            'barang_id' => 'required|exists:barang,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('barangmasuk.create')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {
            $qtyMasuk = $request->qty_masuk ?? 0; // Jika qty_masuk null, maka set ke 0

            // Simpan data barang masuk
            BarangMasuk::create([
                'tgl_masuk' => $request->tgl_masuk,
                'qty_masuk' => $qtyMasuk,
                'barang_id' => $request->barang_id,
            ]);

            // Update stok barang terkait
            $barang = Barang::find($request->barang_id);
            $barang->stok += $qtyMasuk;
            $barang->save();

            DB::commit();
            return redirect()->route('barangmasuk.index')->with(['success' => 'Data Barang Masuk Berhasil Disimpan!']);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['message' => 'Terjadi kesalahan saat menyimpan data.'])->withInput();
        }
    }

    // Menampilkan detail barang masuk
    public function show($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id); // Mengambil data berdasarkan ID
        return view('backend.b_masuk.show', compact('barangMasuk'));
    }

    // Menampilkan form edit
    public function edit($id)
    {
    // Mengambil data barang masuk berdasarkan ID
        $barangMasuk = BarangMasuk::with('barang.kategori')->findOrFail($id); 
    
    // Mengambil semua data barang untuk dropdown
        $rsetBarang = Barang::all(); 
    
        return view('backend.b_masuk.edit', compact('barangMasuk', 'rsetBarang'));
    }


    // Mengupdate data barang masuk
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tgl_masuk' => 'required|date',
            'qty_masuk' => 'nullable|integer',
            'barang_id' => 'required|exists:barang,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('barangmasuk.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {
            $barangMasuk = BarangMasuk::findOrFail($id);
            $qtySebelumnya = $barangMasuk->qty_masuk;

            // Update data barang masuk
            $barangMasuk->update([
                'tgl_masuk' => $request->tgl_masuk,
                'qty_masuk' => $request->qty_masuk,
                'barang_id' => $request->barang_id,
            ]);

            // Update stok barang terkait
            $barang = Barang::find($request->barang_id);
            $barang->stok += ($request->qty_masuk - $qtySebelumnya); // Update stok sesuai perubahan
            $barang->save();

            DB::commit();
            return redirect()->route('barangmasuk.index')->with(['success' => 'Data Barang Masuk Berhasil Diupdate!']);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['message' => 'Terjadi kesalahan saat mengupdate data.'])->withInput();
        }
    }

    // Hapus data barang masuk
    public function destroy(string $id)
    {
        try {
            $rsetBarangMasuk = BarangMasuk::find($id);
        
            if (!$rsetBarangMasuk) {
                throw new \Exception('Barang masuk tidak ditemukan');
            }

            // Cek stok barang terkait
            $rsetBarang = Barang::find($rsetBarangMasuk->barang_id);

            if ($rsetBarang->stok < $rsetBarangMasuk->qty_masuk) {
                throw new \Exception('Stok barang tidak mencukupi untuk menghapus entri barang masuk ini');
            }

            // Update stok setelah penghapusan
            $rsetBarang->stok -= $rsetBarangMasuk->qty_masuk;
            $rsetBarang->save();

            $rsetBarangMasuk->delete();

            return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            return redirect()->route('barangmasuk.index')->with(['error' => $e->getMessage()]);
        }
    }
}
