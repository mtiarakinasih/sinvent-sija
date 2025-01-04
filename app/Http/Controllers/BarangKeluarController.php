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
    // Find the Barang record based on barang_id from the request
    $rsetBarang = Barang::find($request->barang_id);

    $validator = Validator::make($request->all(), [
        'tgl_keluar' => 'required|date|after_or_equal:tgl_masuk',
        'qty_keluar' => 'nullable|integer',
        'barang_id' => 'required|exists:barang,id',
    ], [
        'tgl_keluar.after_or_equal' => 'Tanggal keluar harus setelah atau sama dengan tanggal masuk.',
    ]);

    // Get the earliest tgl_masuk for the given barang_id
    $tgl_masuk = BarangMasuk::where('barang_id', $request->barang_id)->value('tgl_masuk');
    $tgl_keluar = $request->input('tgl_keluar'); // Get tgl_keluar from the request

    // Check if tgl_keluar is before tgl_masuk
    if ($tgl_keluar < $tgl_masuk) {
        return redirect()->route('barangkeluar.create')->with(['Gagal' => 'Tanggal Keluar Tidak Boleh Lebih Awal Dari Tanggal Masuk']);
    }

    // Validate request data
    if ($validator->fails()) {
        return redirect()->route('barangkeluar.create')
            ->withErrors($validator)
            ->withInput();
    }

    // Additional validation to check if stok is sufficient
    $validator->after(function ($validator) use ($rsetBarang, $request) {
        if ($rsetBarang->stok < $request->qty_keluar) {
            $validator->errors()->add('qty_keluar', 'Stok tidak mencukupi.');
        }
    });

    if ($validator->fails()) {
        return redirect()->route('barangkeluar.create')
                         ->withErrors($validator)
                         ->withInput();
    }

    // Begin the database transaction
    DB::beginTransaction();

    try {
        // Create a new BarangKeluar entry
        BarangKeluar::create([
            'tgl_keluar' => $request->tgl_keluar,
            'qty_keluar' => $request->qty_keluar,
            'barang_id' => $request->barang_id,
        ]);

        // Update the stok for the Barang
        $rsetBarang->stok -= $request->qty_keluar;
        $rsetBarang->save();

        // Commit the transaction
        DB::commit();

        return redirect()->route('barangkeluar.index')->with(['success' => 'Data Berhasil Disimpan!']);
    } catch (QueryException $e) {
        // Rollback the transaction if any error occurs
        DB::rollBack();

        return redirect()->route('barangkeluar.create')
                         ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.'])
                         ->withInput();
    }
}


public function show(string $id)
{
    $rsetBarangKeluar = BarangKeluar::find($id); // Find the specific BarangKeluar record by ID

    return view('backend.b_keluar.show', compact('rsetBarangKeluar'));
}


    public function create()
{
    // Get all barang to populate the dropdown
    $rsetBarang = Barang::all(); // Fetch all items from the barang table

    return view('backend.b_keluar.create', compact('rsetBarang')); // Pass the variable to the view
}

public function edit(string $id)
{
    $rsetBarangKeluar = BarangKeluar::find($id); // Find the specific BarangKeluar record by ID
    $rsetBarang = Barang::all(); // Fetch all Barang records to populate dropdown options

    return view('backend.b_keluar.edit', compact('rsetBarangKeluar', 'rsetBarang'));
}

public function update(Request $request, string $id)
{
    // Validate the incoming data
    $validator = Validator::make($request->all(), [
        'barang_id' => 'required|exists:barang,id',
        'tgl_keluar' => 'required|date',
        'qty_keluar' => 'required|integer|min:1',
    ]);

    if ($validator->fails()) {
        return redirect()->route('barangkeluar.edit', $id)
                         ->withErrors($validator)
                         ->withInput();
    }

    // Start a transaction
    DB::beginTransaction();

    try {
        // Find the specific BarangKeluar record
        $rsetBarangKeluar = BarangKeluar::find($id);
        
        // Update the stock in Barang if qty_keluar changes
        if ($request->qty_keluar != $rsetBarangKeluar->qty_keluar) {
            $barang = Barang::find($request->barang_id);
            // Adjust stock based on the new qty_keluar
            $barang->stok += $rsetBarangKeluar->qty_keluar - $request->qty_keluar;
            $barang->save();
        }

        // Update the BarangKeluar record
        $rsetBarangKeluar->update([
            'barang_id' => $request->barang_id,
            'tgl_keluar' => $request->tgl_keluar,
            'qty_keluar' => $request->qty_keluar,
        ]);

        // Commit the transaction
        DB::commit();

        return redirect()->route('barangkeluar.index')->with('success', 'Data Berhasil Diperbarui!');
    } catch (QueryException $e) {
        // Rollback transaction if an error occurs
        DB::rollBack();
        return redirect()->route('barangkeluar.edit', $id)
                         ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data.'])
                         ->withInput();
    }
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
